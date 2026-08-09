<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core;

use mateable\core\models\ActivityModel;
use PDOException;
use mateable\core\controllers\Controller;
use mateable\core\controllers\VidGigglesController;
use mateable\core\db\Database;
use mateable\core\db\VidDatabase;
use mateable\core\exceptions\NotFoundException;
use mateable\core\exceptions\ForbiddenException;
use mateable\core\exceptions\InternalErrorException;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\routes\Router;
use mateable\core\session\Session;
use mateable\core\models\VidGigglesModel;
use mateable\core\models\FollowerModel;
use mateable\core\models\MessageModel;
use mateable\core\models\SessionModel;
use mateable\core\models\user\account\UserModel;
use mateable\core\models\PostModel;
use mateable\core\views\View;
use mateable\core\views\ViewManager;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Platform
{
    public static Platform $app;                // Application
    public static array $config;                // Configuration Information
    public static string $ROOT_DIR;             // Root Directory
    public static int $id;                      // ID

    /**
     * System Controllers
     **/
    public Request $request;                    // Request Controller
    public Response $response;                  // Response Controller
    public Router $router;                      // Router Controller

    /**
     * Controllers
     **/
    public Controller $controller;
    public VidGigglesController $vidGiggles;    // VidGiggles Controller

    /**
     * Database
     **/
    public Database $db;                        // Main Database
    public VidDatabase $dbVG;                   // VidGiggles Database

    /**
     * Sessions
     **/
    public Session $session;                    // Session

    /**
     * Views
     **/
    public View $view;                          // View (Web page)
    public ViewManager $viewManager;            // Views Manager

    /**
     * Models
     **/
    public ?UserModel $user;                    // User Model
    public FollowerModel $follower;             // Follower Model
    public PostModel $post;                     // Post Model
    public MessageModel $message;               // Message Model
    public SessionModel $sessionM;              // Session Model
    public ActivityModel $activity;             // Activity Model
    public ?VidGigglesModel $vidGigglesContent; // VidGiggles Content Model


    /**
     * Methods and Constructor
     **/
    public function __construct(string $root, array $config)
    {
        self::$config = $config;
        self::$ROOT_DIR = $root;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->controller = new Controller();
        $this->viewManager = new ViewManager();
        $this->activity = new ActivityModel();
        $this->vidGiggles = new VidGigglesController();

        /**
         * User Database
         * User data retrieval
         **/
        try {
            $this->db = new Database($config['db']);
        } catch (PDOException $e) {
            self::$app->response->statusCode(400);
            throw new PDOException("There is a problem with the database. Try again later or go to the <a href=\"{{site_url}}\">homepage</a>.", $e->getCode());
        }

        /**
         * VidGiggles Database
         * Video data retrieval
         * Video statistics
         **/
        try {
            $this->dbVG = new VidDatabase($config['vg']);
        } catch (PDOException $e) {
            self::$app->response->statusCode(400);
            throw new PDOException("There is a problem with the VidGiggles database. Go to the <a href=\"{{site_url}}\">homepage</a>.", $e->getCode());
        }

        if (!$this->session->get('user')) {
            $this->user = null;
        }else{
            $primaryValue = $this->session->get('user');
            $primaryKey = (new UserModel)->primaryKey();

            if ($primaryValue) {
                // Find user and load information
                $this->user = UserModel::findOne([$primaryKey => $primaryValue]);
                $this->message = new MessageModel();
                $this->post = new PostModel();
                $this->follower = new FollowerModel();
            } else {
                $this->user = null;
            }
        }

        $this->view = new View();
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

    public function run(): void
    {
        try {
            self::$app->response->statusCode(200);
            echo self::$app->router->resolve();
        } catch(PDOException $e) {
            self::$app->response->statusCode(400);
            echo self::$app->view->renderview('_error', ['exception' => $e->getMessage(), 'exceptiontitle' => $e->getCode()]);
        } catch(ForbiddenException $e){
            self::$app->response->statusCode(403);
            echo self::$app->view->renderview('_error',['exception' => $e->getMessage(),'exceptiontitle' => $e->getCode()]);
        } catch(NotFoundException $e){
            self::$app->response->statusCode(404);
            echo self::$app->view->renderview('_error',['exception' => $e->getMessage(),'exceptiontitle' => $e->getCode()]);
        } catch(InternalErrorException $e){
            self::$app->response->statusCode(500);
            echo self::$app->view->renderview('_error',['exception' => $e->getMessage(),'exceptiontitle' => $e->getCode()]);
        }
    }

    public function runMaintenance():void
    {
        try {
            self::$app->response->statusCode(200);
            echo self::$app->view->renderview('maintenance');
        } catch (ForbiddenException $e) {
            self::$app->response->statusCode(403);
            echo self::$app->view->renderview('_error', ['exception' => $e->getMessage(), 'exceptiontitle' => $e->getCode()]);
        } catch (NotFoundException $e) {
            self::$app->response->statusCode(404);
            echo self::$app->view->renderview('_error', ['exception' => $e->getMessage(), 'exceptiontitle' => $e->getCode()]);
        }
    }
}