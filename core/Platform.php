<?php

/**
 * Copyright (c) 2024 Mateable LLC
 */

namespace mateable\core;

use mateable\core\controllers\Controller;
use mateable\core\db\Database;
use mateable\core\exceptions\NotFoundException;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\models\DB;
use mateable\core\routes\Router;
use mateable\core\session\Session;
use mateable\core\views\View;

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
    public Database $db;
    public Session $session;
    public View $view;

    public function __construct(string $root, array $config)
    {
        self::$ROOT_DIR = $root;
        self::$app = $this;
        $this->user = '';
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->db = new Database($config['db']);
        $this->view = new View();
        $this->router = new Router($this->request, $this->response, $this->controller);

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public static function isGuest(): bool
    {
       return !Platform::$app->user;
    }

    public function run(): void
    {
        try{
            echo self::$app->router->resolve();
        }catch(\Exception $exception){
            self::$app->response->statusCode($exception->getCode());
            echo self::$app->view->renderView('_error', ['exception' => $exception]);
        }
    }
}