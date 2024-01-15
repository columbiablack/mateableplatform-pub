<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core;

use mateable\core\controllers\Controller;
use mateable\core\exceptions\NotFoundException;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\routes\Router;
use mateable\core\session\Session;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Platform
{
    public static Platform $app;
    public static string $ROOT_DIR;
    public Request $request;
    public Response $response;
    public Router $router;
    public ?string $user;

    public string $layout = 'main';
    public ?Controller $controller = null;
    public Session $session;

    public function __construct(string $root)
    {
        self::$ROOT_DIR = $root;
        self::$app = $this;
        $this->user = '';
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
    }

    public static function isGuest(): bool
    {
       return !Platform::$app->user;
    }

    public function run(): void
    {
        try{
            echo self::$app->router->resolve();
        }catch(NotFoundException $exception){
            self::$app->response->statusCode($exception->getCode());
            echo self::$app->router->renderView('_error', ['exception' => $exception]);
        }
    }
}