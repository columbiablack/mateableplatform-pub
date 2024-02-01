<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Response;
use mateable\core\middlewares\AuthMiddleware;
use mateable\core\http\Request;
use mateable\core\models\LoginForm;
use mateable\core\models\RegisterForm;
use mateable\core\Platform;
use mateable\core\routes\Routes;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(Routes::authAllowedRoutes()));
    }

    public function login(Request $request, Response $response): string
    {
        $loginForm = new LoginForm();
        if($request->isPost())
        {
            $loginForm->loadData($request->getBody());

            if($loginForm->validate() && $loginForm->doLogin()){
                Platform::$app->session->setFlash('success','You have signed in successfully!!!');
                Platform::$app->response->redirect('./dashboard');
            }
        }
        return $this->render('login', ['model' => $loginForm]);
    }

    public function register(Request $request, Response $response): string
    {
        $registerForm = new RegisterForm();
        if($request->isPost())
        {
            $registerForm->loadData($request->getBody());

            if($registerForm->validate() && $registerForm->save()){
                Platform::$app->session->setFlash('success','You have registered successfully!!!');
                $response->redirect('./login');
            }
        }
        return $this->render('register', ['model' => $registerForm]);
    }

    public function profile(): string
    {
        return $this->render('profile');
    }
}