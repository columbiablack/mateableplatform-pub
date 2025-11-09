<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core;

use PDOException;
use mateable\core\views\View;
use mateable\core\db\Database;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\routes\Router;
use mateable\core\db\VidDatabase;
use mateable\core\session\Session;
use mateable\core\models\UserModel;
use mateable\core\views\ViewManager;
use mateable\core\models\VidGigglesModel;
use mateable\core\controllers\Controller;
use mateable\core\controllers\FeedController;
use mateable\core\exceptions\NotFoundException;
use mateable\core\exceptions\ForbiddenException;
use mateable\core\controllers\DownloadsController;
use mateable\core\controllers\VidGigglesController;
use mateable\core\exceptions\InternalErrorException;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Platform
{
    public static Platform $app;                // Application
    public static array $config;                // Configuration Information
    public static string $ROOT_DIR;             // Root Directory

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
    public DownloadsController $downloads;      // Downloads Controller
    public VidGigglesController $vidGiggles;    // VidGiggles Controller
    public FeedController $rssFeeds;            // Rss Feeds

    /**
     * Database
     **/
    public Database $db;                        // Main Database
    public VidDatabase $dbVG;                      // VidGiggles Database

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
    public ?UserModel $user;
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
        $this->controller = new Controller();
        $this->viewManager = new ViewManager();
        $this->downloads = new DownloadsController();
        $this->vidGiggles = new VidGigglesController();
        $this->rssFeeds = new FeedController();

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
        }catch (PDOException $e) {
            self::$app->response->statusCode(400);
            throw new PDOException("There is a problem with the VidGiggles database. Go to the <a href=\"{{site_url}}\">homepage</a>.", $e->getCode());
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
// Take it away!!! can you go to the folder for mateable for the wallet  under the username  yup
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
}