<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\Platform;
use mateable\core\http\Request;
use mateable\core\http\Response;
use mateable\core\routes\Routes;
use mateable\core\models\UserModel;
use mateable\core\models\UserLoginModel;
use mateable\core\middlewares\AuthMiddleware;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(Routes::authAllowedRoutes()));
    }

    public function login(Request $request): string
    {
        $loginForm = new UserLoginModel();
        if($request->isPost())
        {
            $loginForm->loadData($request->getBody());

            if($loginForm->validate() && $loginForm->doLogin()){
                $rememberMe = $request->getBody()['remember_me'] ?? "off";

                if($rememberMe == "on"){
                    Platform::$app->session->rememberMe(30);
                }elseif($rememberMe == "off"){
                    Platform::$app->session->setLifetime(3600);
                }

                Platform::$app->activity::log(Platform::$app->user->id, "logged in", "You have successfully signed in!");
                Platform::$app->session->regenerateOnLogin();
                Platform::$app->session->setFlash('success','You have successfully signed in!');
                Platform::$app->response->redirect('/dashboard');
            }
        }
        $this->setLayout('auth');
        return $this->renderView('login', ['model' => $loginForm]);
    }

    public function logout()
    {
        Platform::$app->activity::log(Platform::$app->user->id, "logged out","You've successfully signed out!");
        Platform::$app->user = null;
        Platform::$app->session->remove('user');
        Platform::$app->session->setFlash('success', "You have successfully signed out!");
        Platform::$app->response->redirect('/home');
    }

    public function register(Request $request): string
    {
        $registerForm = new UserModel();
        if($request->isPost())
        {
            $registerForm->loadData($request->getBody());

            if($registerForm->validate() && $registerForm->save()){
                Platform::$app->session->setFlash('success','You have successfully registered!');
                Platform::$app->response->redirect('/signin');
            }
        }
        //$this->setLayout('auth');
        return $this->renderView('register', ['model' => $registerForm]);
    }

    public function dashboard(Request $request): string
    {
        return $this->renderView('profile/dashboard', [
            'accstat' => Platform::$app->user->account_status,
            'followerc' => number_format(Platform::$app->follower::followersCount(Platform::$app->user->id)),
            'followingc' => number_format(Platform::$app->follower::followingCount(Platform::$app->user->id)),
            'postsc' => number_format(Platform::$app->post::postCount(Platform::$app->user->id)),
            'unreadc' => number_format(Platform::$app->message::unreadCount(Platform::$app->user->id)),
            'messagec' => number_format(Platform::$app->message::messageCount(Platform::$app->user->id)),
            'activities' => Platform::$app->activity::findAll(['user_id' => Platform::$app->user->id], 'created_at DESC', 3),
        ]);
    }

    public function downloads(): string
    {
        return $this->renderView('downloads');
    }
}