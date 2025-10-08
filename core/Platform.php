<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core;

use mateable\core\coin\MTBCRPC;
use mateable\core\coin\XeggeX;
use mateable\core\controllers\Controller;
use mateable\core\db\Database;
use mateable\core\exceptions\ForbiddenException;
use mateable\core\exceptions\InternalErrorException;
use mateable\core\exceptions\NotFoundException;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\models\UserModel;
use mateable\core\models\Wallet;
use mateable\core\routes\Router;
use mateable\core\session\Session;
use mateable\core\views\View;
use mateable\core\views\ViewManager;
use PDOException;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Platform
{
    public static Platform $app;
    public static array $config;
    public static string $ROOT_DIR;
    public Request $request;
    public Response $response;
    public Router $router;
    public Controller $controller;
    public Database $db;
    public Session $session;
    public View $view;
    public ViewManager $viewManager;
    public ?UserModel $user;

    public function __construct(string $root, array $config)
    {
        self::$config = $config;
        self::$ROOT_DIR = $root;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();
        $this->viewManager = new ViewManager();

        try {
            $this->db = new Database($config['db']);
        } catch (PDOException $e) {
            self::$app->response->statusCode(400);
            //echo self::$app->view->renderView('_error', ['exception' => 'Constructor error: ' . $e->getMessage(), 'exceptiontitle' => $e->getCode()]);
            throw new PDOException("There is a problem with the database. Try again later or go the <a href=\"{{site_url}}\">homepage</a>.", $e->getCode());
        }

        $this->session = new Session();
        $primaryValue = $this->session->get('user');
        $primaryKey = (new UserModel)->primaryKey();
        if($primaryValue) {
            // Find user and load information
            $this->user = UserModel::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }

        $this->view = new View();
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
            self::$app->response->statusCode(200);
            echo self::$app->router->resolve();
        } catch(PDOException $e) {
            self::$app->response->statusCode(400);
            echo self::$app->view->renderview('_error', ['exception' => '{{app_name}} <br />' . $e->getMessage(), 'exceptiontitle' => $e->getCode()]);
        } catch(ForbiddenException $e){
            self::$app->response->statusCode(403);
            echo self::$app->view->renderview('_error',['exception' => '{{app_name}} <br />'.$e->getMessage(),'exceptiontitle' => $e->getCode()]);
        } catch(NotFoundException $e){
            self::$app->response->statusCode(404);
            echo self::$app->view->renderview('_error',['exception' => '{{app_name}} <br />'.$e->getMessage(),'exceptiontitle' => $e->getCode()]);
        } catch(InternalErrorException $e){
            self::$app->response->statusCode(500);
            echo self::$app->view->renderview('_error',['exception' => '{{app_name}} <br />'.$e->getMessage(),'exceptiontitle' => $e->getCode()]);
        }
    }
}