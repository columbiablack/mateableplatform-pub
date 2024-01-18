<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\middlewares\AuthMiddleware;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\models\LoginForm;
use mateable\core\models\Users;
use mateable\core\Platform;
use mateable\core\session\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request): string
    {
        $loginForm = new LoginForm();
        if($request->isPost())
        {
            $loginForm->loadData($request->getBody());

            if($loginForm->validate() && $loginForm->doLogin()){
                $this->render('profile');
            }
        }
        return $this->render('login', ['model' => $loginForm]);
    }

    public function register(Response $response, Request $request): string
    {
        $registerForm = new Users();
        if($request->isPost())
        {
            $registerForm->loadData($request->getBody());

            if($registerForm->validate() && $registerForm->save()){
                Platform::$app->session->setFlash('success','You have registered successfully!!!');
                $response->redirect('./');
                //$this->render('./profile');
            }
        }
        return $this->render('register', ['model' => $registerForm]);
    }

    public function profile(): string
    {
        return $this->render('profile');
    }
}