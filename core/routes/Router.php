<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\routes;

use mateable\core\controllers\Controller;
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
    protected array $routemap = [];

    public function __construct(Request $request, Response $response)
    {
        $this->response = $response;
        $this->request = $request;
    }

    public function get(string $url, $callback): void
    {
        $this->routemap['get'][$url] = $callback;
    }

    public function post(string $url, $callback): void
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

    /**
     * @throws NotFoundException
     */
    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = $this->routeMap[$method][$url] ?? false;

        //var_dump($callback);
        //echo '<pre>';
        //var_dump($this->routemap);
        //echo '</pre>';
        //exit();

        if($callback === false) {
            $callback = $this->getCallback();
           return $this->renderview('_error',['exception' => 'I don\'t know why but something went terribly wrong.<br> Please try again!', 'exceptiontitle' => 'Error']);
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            /**
             * @var $controller Controller
             */
            $controller = new $callback[0];
            $controller->action = $callback[1];
            Platform::$app->controller = $controller;
            $middlewares = $controller->getMiddlewares();
            foreach ($middlewares as $middleware) {
                $middleware->execute();
            }
            $callback[0] = $controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = []): array|string
    {
        $layoutcontent = $this->layoutContent();
        $viewcontent = $this->renderViewOnly($view,$params);

        $layoutcontent = str_replace('{{app_name}}','Mateable', $layoutcontent);
        $layoutcontent = str_replace('{{content}}',$viewcontent, $layoutcontent);
        $finalcontent = $layoutcontent;

        return $finalcontent;
    }

    protected function layoutContent(): string
    {
        $layout = Platform::$app->layout;

        if(Platform::$app->controller)
        {
            $layout = Platform::$app->controller->layout;
        }

        ob_start();
        include_once Platform::$ROOT_DIR."/core/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderViewOnly($view, $params = []): string
    {
        foreach($params as $key => $value)
        {
            $$key = $value;
        }

        ob_start();
        include_once Platform::$ROOT_DIR."/core/views/$view.php";
        return ob_get_clean();
    }
}