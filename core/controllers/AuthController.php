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
use mateable\core\models\PostModel;
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
            'activities' => Platform::$app->activity::findAll(['user_id' => Platform::$app->user->id], 'created_at DESC', 16),
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

    public function createPost(Request $request): string
    {
        if ($request->isPost()) {
            $content = trim((string) ($request->getBody()['content'] ?? ''));

            if (empty($content)) {
                Platform::$app->session->setFlash('warning', 'Post content cannot be empty.');
                Platform::$app->response->redirect('/dashboard');
                return '';
            }

            if (strlen($content) > 5000) {
                Platform::$app->session->setFlash('warning', 'Post content exceeds maximum length of 5000 characters.');
                Platform::$app->response->redirect('/dashboard');
                return '';
            }

            $post = new PostModel();
            $post->user_id = (int) Platform::$app->user->id;
            $post->content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
            $post->created_at = date('Y-m-d H:i:s');
            $post->moderation_status = 'pending';

            if ($post->save()) {
                Platform::$app->activity::log(Platform::$app->user->id, 'created_post', 'You created a new post!');
                Platform::$app->session->setFlash('success', 'Your post has been created and is awaiting moderation.');
            } else {
                Platform::$app->session->setFlash('warning', 'Your post could not be created. Please try again.');
            }

            Platform::$app->response->redirect('/dashboard');
            return '';
        }

        // GET: Show post editor
        return $this->renderView('profile/post-editor', []);
    }

    public function createEvent(Request $request): string
    {
        if ($request->isPost()) {
            $eventData = $request->getBody();
            $title = trim((string) ($eventData['title'] ?? ''));
            $description = trim((string) ($eventData['description'] ?? ''));
            $eventDate = trim((string) ($eventData['event_date'] ?? ''));

            if (empty($title) || empty($description) || empty($eventDate)) {
                Platform::$app->session->setFlash('warning', 'All event fields are required.');
                Platform::$app->response->redirect('/dashboard');
                return '';
            }

            // Validate event date is in the future
            $eventTime = strtotime($eventDate);
            if ($eventTime === false || $eventTime < time()) {
                Platform::$app->session->setFlash('warning', 'Event date must be in the future.');
                Platform::$app->response->redirect('/dashboard');
                return '';
            }

            // TODO: Implement event storage (create events table/model if needed)
            // For now, just log the action and redirect
            Platform::$app->activity::log(Platform::$app->user->id, 'created_event', 'You created a new event!');
            Platform::$app->session->setFlash('success', 'Your event has been created and is pending approval.');
            Platform::$app->response->redirect('/dashboard');
            return '';
        }

        // GET: Show event editor
        return $this->renderView('profile/event-editor', []);
    }
}