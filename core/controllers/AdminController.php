<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\middlewares\AdminMiddleware;
use mateable\core\models\user\account\UserModel;
use mateable\core\Platform;
use mateable\core\routes\Routes;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AdminMiddleware(Routes::adminAllowedRoutes()));
    }

    public function adminDash(): string
    {
        $this->setLayout('auth');
        Platform::$app->activity::log(Platform::$app->user->id, "admin dashboard", "You viewed the Administration Dashboard!");
        return $this->renderView('admin/adminpanel', [
            'totalu'=> Platform::$app->user::countAll(),
        ]);
    }

    public function manageUsers(): string
    {
        return $this->renderView('admin/usrmgmt', [
            'userAccounts' => Platform::$app->user::findAll([]),
        ]);
    }

    public function moderation(Request $request): string
    {
        $moderationAccount = new UserModel();
        if($request->isPost())
        {
            $moderationAccount->loadData($request->getBody());

            if($moderationAccount->validate() && $moderationAccount->doLogin()){

                Platform::$app->activity::log(Platform::$app->user->id, "status change", "You have changed the user permission to ");
                Platform::$app->session->regenerateOnLogin();
                Platform::$app->session->setFlash('success','You have successfully signed in!');
                Platform::$app->response->redirect('/dashboard');
            }
        }

        return $this->renderView('admin/moderation', [
            'moderationAccounts' => Platform::$app->user::findAll(['account_status' => Platform::$app->user::ACCOUNT_STATUS_PENDING]),
        ]);
    }

    public function webMigrate(): string
    {
        return $this->renderView(Platform::$ROOT_DIR.'/Migrations.php', []);
    }
}