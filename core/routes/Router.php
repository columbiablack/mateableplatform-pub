<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
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
        $this->routemap = array_merge(Routes::getAllowedRoutes(), Routes::postAllowedRoutes());
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
        $routes = $this->routemap[$method] ?? [];

        foreach ($routes as $route => $callback) {
            $regex = '';
            $offset = 0;

            preg_match_all(
                '/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/',
                $route,
                $placeholders,
                PREG_OFFSET_CAPTURE
            );

            foreach ($placeholders[0] as $i => $placeholder) {
                $token = $placeholder[0];
                $position = $placeholder[1];
                $name = $placeholders[1][$i][0];

                $regex .= preg_quote(
                    substr($route, $offset, $position - $offset),
                    '#'
                );

                $regex .= '(?P<' . $name . '>[^/]+)';
                $offset = $position + strlen($token);
            }

            $regex .= preg_quote(substr($route, $offset), '#');

            $pattern = '#^' . $regex . '$#';

            if (preg_match($pattern, $url, $matches) === 1) {
                $params = [];

                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }

                $this->request->setRouteParams($params);

                return $callback;
            }
        }

        return false;
    }

    public function resolve()
    {
        $method = strtolower($this->request->getMethod());
        $url = $this->request->getUrl();

        // Remove the query string.
        $url = strtok($url, '?') ?: '/';

        // Normalize the URL.
        if ($url === '' || $url[0] !== '/') {
            $url = '/' . $url;
        }

        // First try an exact route.
        $callback = $this->routemap[$method][$url] ?? false;

        // Then try parameterized routes.
        if ($callback === false) {
            $callback = $this->getCallback($method, $url);
        }

        if ($callback === false) {
            throw new NotFoundException(
                'The page requested cannot be found. Go to the <a href="{{site_url}}">homepage</a>.'
            );
        }

        // Render a view directly.
        if (is_string($callback)) {
            return Platform::$app->view->renderView($callback);
        }

        // Instantiate controllers and run their middleware.
        if (is_array($callback)) {
            $controllerClass = $callback[0];
            $action = $callback[1];

            $controller = new $controllerClass();

            Platform::$app->controller = $controller;
            $controller->action = $action;

            $callback = [$controller, $action];

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        if (is_callable($callback)) {
            return call_user_func(
                $callback,
                $this->request,
                $this->response
            );
        }

        throw new NotFoundException('The requested route callback is invalid.');
    }
}