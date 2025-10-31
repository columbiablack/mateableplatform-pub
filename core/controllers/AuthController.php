<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\Platform;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\routes\Routes;
use mateable\core\models\PostModel;
use mateable\core\models\UserModel;
use mateable\core\models\UserLoginModel;
use mateable\core\middlewares\AuthMiddleware;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(Routes::authAllowedRoutes()));
    }

    public function login(Request $request, Response $response): string
    {
        $loginForm = new UserLoginModel();
        if($request->isPost())
        {
            $loginForm->loadData($request->getBody());

            if($loginForm->validate() && $loginForm->doLogin()){
                Platform::$app->session->setFlash('success','You have signed in successfully!!!');
                Platform::$app->response->redirect('/dashboard');
            }
        }
        $this->setLayout('auth');
        return $this->renderView('login', ['model' => $loginForm]);
    }

    public function register(Request $request, Response $response): string
    {
        $registerForm = new UserModel();
        if($request->isPost())
        {
            $registerForm->loadData($request->getBody());

            if($registerForm->validate() && $registerForm->save()){
                Platform::$app->session->setFlash('success','You have registered successfully!!!');
                Platform::$app->response->redirect('/mylogin');
            }
        }
        $this->setLayout('auth');
        return $this->renderView('register', ['model' => $registerForm]);
    }

    public function dashboard(Request $request): string
    {
        $postModel = new PostModel;
        return $this->renderView('dashboard', ['postModel' => $postModel]);
    }

}