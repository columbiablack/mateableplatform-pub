<?php

/**
 * Copyright (c) 2024 Mateable LLC
 */

namespace mateable\core\routes;

use mateable\core\controllers\Controller;
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
    protected array $routemap = [];

    public function __construct(Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
        $this->routemap = Routes::getAllowedRoutes();
    }

    public function get($url, $callback): void
    {
        $this->routemap['get'][$url] = $callback;
    }

    public function post($url, $callback): void
    {
        $this->routemap['post'][$url] = $callback;
    }

    public function getRouteMap($method): array
    {
        return $this->routeMap[$method] ?? [];
    }

    public function getCallback()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        // Trim slashes
        $url = trim($url, '/');

        // Get all routes for current request method
        $routes = $this->getRouteMap($method);

        $routeParams = false;

        // Start iterating registed routes
        foreach ($routes as $route => $callback) {
            // Trim slashes
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }

            // Find all route names from route and save in $routeNames
            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }

            // Convert route name into regex pattern
            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            // Test and match current route against $routeRegex
            if (preg_match_all($routeRegex, $url, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);

                $this->request->setRouteParams($routeParams);
                return $callback;
            }
        }

        return false;

    }

    public function resolve()
    {
        $url = $this->request->getUrl();
        $method = $this->request->getMethod();
        $callback = $this->routeMap[$method][$url] ?? false;

        //$callback = $this->getCallback();

        if($callback === false) {
            return Platform::$app->view->renderView('_error',['exception' => 'I\'m not sure what happened, but something went terribly wrong.<br> Please try again!', 'exceptiontitle' => 'Error']);
        }

        if (is_string($callback)) {
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
        return call_user_func($callback, $this->request, $this->response);
    }

}