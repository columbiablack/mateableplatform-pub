<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\middlewares\AuthMiddleware;
use mateable\core\models\user\account\UserLoginModel;
use mateable\core\models\user\account\UserModel;
use mateable\core\models\user\recovery\RecoveryByEmailModel;
use mateable\core\Platform;
use mateable\core\routes\Routes;

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
        // Platform::$app->activity::log(Platform::$id, "logged out","You've successfully signed out!");
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

        $this->setLayout('auth');
        return $this->renderView('register', ['model' => $registerForm]);
    }

    public function dashboard(Request $request): string
    {
        Platform::$app->activity::log(Platform::$app->user->id, "dashboard", "You viewed your Dashboard!");

        return $this->renderView('profile/dashboard', [
            'accstat' => Platform::$app->user->account_status,
            'followerc' => number_format(Platform::$app->follower::followersCount(Platform::$app->user->id)),
            'followingc' => number_format(Platform::$app->follower::followingCount(Platform::$app->user->id)),
            'postsc' => number_format(Platform::$app->post::postCount(Platform::$app->user->id)),
            'unreadc' => number_format(Platform::$app->message::unreadCount(Platform::$app->user->id)),
            'messagec' => number_format(Platform::$app->message::messageCount(Platform::$app->user->id)),
            'activities' => Platform::$app->activity::findAll(['user_id' => Platform::$app->user->id], 'created_at DESC', 6),
        ]);
    }

    public function edit(Request $request): string
    {
        if($request->isGet())
        {
            $action = $_GET['action'];
            if(!empty($action))
            {

            }
        }

        Platform::$app->activity::log(Platform::$app->user->id, "dashboard", "You viewed your Dashboard!");

        return $this->renderView('profile/dashboard', [
            'accstat' => Platform::$app->user->account_status,
            'followerc' => number_format(Platform::$app->follower::followersCount(Platform::$app->user->id)),
            'followingc' => number_format(Platform::$app->follower::followingCount(Platform::$app->user->id)),
            'postsc' => number_format(Platform::$app->post::postCount(Platform::$app->user->id)),
            'unreadc' => number_format(Platform::$app->message::unreadCount(Platform::$app->user->id)),
            'messagec' => number_format(Platform::$app->message::messageCount(Platform::$app->user->id)),
            'activities' => Platform::$app->activity::findAll(['user_id' => Platform::$app->user->id], 'created_at DESC', 6),
        ]);
    }

    public function downloads(): string
    {
        return $this->renderView('downloads');
    }

    public function passwordRecovery(Request $request): string
    {
        $recForm = new RecoveryByEmailModel();

        if($request->isPost())
        {
            $recForm->loadData($request->getBody());

            if($recForm->validate() && $recForm->doRecoveryByEmail())
            {
                Platform::$app->session->setFlash('success','We have successfully found your account!');
                Platform::$app->session->setFlash('success','Check your email for the verification link.');
                Platform::$app->response->redirect('/news');
            }else{
                Platform::$app->session->setFlash('warning', 'We failed at finding the account with those credentials.');
            }

        }

        $this->setLayout('auth');
        return $this->renderview('recovery', ['recModel' => new UserLoginModel()]);
    }
}