<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core;

use mateable\core\controllers\Controller;
use mateable\core\db\Database;
use mateable\core\exceptions\Exception;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\models\Users;
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
    /** The default template for
     the layout is always 'main' */
    public string $layout = 'main';
    public Request $request;
    public Response $response;
    public Router $router;
    public ?Users $user;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public View $view;

    public function __construct(string $root, array $config)
    {
        self::$ROOT_DIR = $root;
        self::$app = $this;

        $this->db = new Database($config['db']);
        $this->user = null;
        $this->view = new View();
        $this->session = new Session();
        $this->request = new Request();
        $this->response = new Response();
        $this->controller = new Controller();
        $this->router = new Router($this->request, $this->response, $this->controller);
    }

    public static function isGuest(): bool
    {
        return !Platform::$app->user;
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        try{
            echo self::$app->router->resolve();
        }catch(exceptions\Exception|exceptions\NotFoundException $e) {
            echo $this->view->renderview('_error',[
                'exception' => $e->getMessage(),
                'exceptiontitle' => $e->getCode()
            ]);
        }
    }
}