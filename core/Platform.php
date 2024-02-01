<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core;

use mateable\core\controllers\Controller;
use mateable\core\db\Database;
use mateable\core\exceptions\NotFoundException;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\models\RegisterForm;
use mateable\core\routes\Router;
use mateable\core\session\Session;
use mateable\core\views\View;
use PDOException;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Platform
{
    public static Platform $app;
    public static string $ROOT_DIR;
    public static string $layout = 'main';
    public Request $request;
    public Response $response;
    public Router $router;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public View $view;
    public ?RegisterForm $user;

    public function __construct(string $root, array $config)
    {
        self::$ROOT_DIR = $root;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();

        try {
            $this->db = new Database($config['db']);
        } catch (PDOException $e) {
            self::$app->response->statusCode(400);
            echo self::$app->view->renderView('_error', ['exception' => 'Constructor error: ' . $e->getMessage(), 'exceptiontitle' => $e->getCode()]);
        }

        $this->session = new Session();
        $this->view = new View();

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $this->user = Registerform::findOne(['id' => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

    public function logout(): bool
    {
        $this->user = null;
        $this->session->remove('user');
        return true;
    }

    public function run(): void
    {
        try {
            echo self::$app->router->resolve();
        } catch (NotFoundException $e){
            self::$app->response->statusCode(404);
            echo self::$app->view->renderview('_error',['exception' => $e->getMessage(),'exceptiontitle' => $e->getCode()]);
        }
    }
}