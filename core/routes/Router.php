<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\routes;

use JetBrains\PhpStorm\NoReturn;
use mateable\core\exceptions\NotFoundException;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Router
{
    protected Response $response;
    protected Request $request;
    private array $routemap = [];

    public function __construct(Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
        $this->routemap = Routes::getAllowedRoutes() + Routes::postAllowedRoutes();
    }

    public function get($url, $callback): void
    {
        $this->routemap['get'][$url] = $callback;
    }

    public function post($url, $callback): void
    {
        $this->routemap['post'][$url] = $callback;
    }

    public function getCallback(string $method, string $url)
    {

        // Get all routes for the current request method
        $routes = $this->routemap[$method];

        // Start iterating over registered routes
        foreach ($routes as $route => $callback) {

            // Escape special characters in the route pattern
            $pattern = preg_quote($route, '/');

            // Convert route parameter placeholders to regex capture groups
            $pattern = preg_replace_callback('/\{(\w+)(:[^}]+)?\}/', function($matches) {
                $constraint = isset($matches[2]) ? $matches[2] : '\w+';
                return "(?P<$matches[1]>$constraint)";
            }, $pattern);

            // Add start and end delimiters to the regex pattern
            $pattern = "/^$pattern$/";

            // Test if the current route matches the URL
            if (preg_match($pattern, $url, $matches)) {
                // Remove the full match from the parameters
                unset($matches[0]);

                // Set route parameters in the request object
                $this->request->setRouteParams($matches);

                return $callback;
            }
        }

        return false;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $position = strpos($url, '?');
        if ($position !== false) {
            $url = substr($url, 0, $position);
        }

        $callback = $this->routemap[$method][$url] ?? false;

        if(!$callback){
            $callback = $this->getCallback($method, $url);
            if ($callback === false) {
                throw new NotFoundException("There is a problem with the requested url. Go to the <a href=\"{{site_url}}\">homepage</a>.");
            }
        }

        if($callback){
            if(is_string($callback)) {
                return Platform::$app->view->renderView($callback);
            }

            if (is_array($callback)) {
                $controller = new $callback[0]();
                Platform::$app->controller = $controller;
                $controller->action = $callback[1];
                $callback[0] = $controller;

                foreach ($controller->getMiddlewares() as $middleware) {
                    $middleware->execute();
                }
            }

            if(is_callable($callback)){
                return call_user_func($callback, $this->request, $this->response);
            }
        }else{
            throw new NotFoundException("The requested page cannot be found. Go to the <a href=\"{{site_url}}\">homepage</a>.");
        }
    }
}