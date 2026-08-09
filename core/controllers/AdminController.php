<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\http\Request;
use mateable\core\middlewares\AdminMiddleware;
use mateable\core\models\NewsPostModel;
use mateable\core\models\PostModel;
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

    public function managePosts(): string
    {
        $posts = PostModel::findAll([], 'created_at DESC');
        $postAuthors = [];

        foreach ($posts as $post) {
            $author = UserModel::findOne(['id' => (int) $post->user_id]);
            $postAuthors[$post->id] = $author?->displayName() ?: 'Unknown user';
        }

        return $this->renderView('admin/postmgmt', [
            'posts' => $posts,
            'postAuthors' => $postAuthors,
        ]);
    }

    public function deletePost(Request $request): string
    {
        $id = (int) ($request->getBody()['id'] ?? 0);
        $post = $id > 0 ? PostModel::findOne(['id' => $id]) : null;

        if ($post && $post->remove()) {
            Platform::$app->session->setFlash('success', 'The post was deleted successfully.');
        } else {
            Platform::$app->session->setFlash('warning', 'The post could not be deleted.');
        }

        Platform::$app->response->redirect('/admdash/postmgmt');
        return '';
    }

    public function userMenu(Request $request): string
    {
        $id = (int) ($request->getBody()['id'] ?? 0);
        $userAccount = $id > 0 ? UserModel::findOne(['id' => $id]) : null;

        if (!$userAccount) {
            Platform::$app->session->setFlash('warning', 'The requested user could not be found.');
            Platform::$app->response->redirect('/admdash/usrmgmt');
            return '';
        }

        return $this->renderView('admin/usermenu', [
            'userAccount' => $userAccount,
        ]);
    }

    public function addUser(Request $request): string
    {
        $userAccount = new UserModel();

        if ($request->isPost()) {
            $userAccount->loadData($request->getBody());

            if ($userAccount->validate() && $userAccount->save()) {
                Platform::$app->session->setFlash('success', 'The user was added successfully.');
                Platform::$app->response->redirect('/admdash/usrmgmt');
                return '';
            }

            Platform::$app->session->setFlash('warning', 'The user could not be added. Check the submitted information.');
        }

        return $this->renderView('admin/adduser', [
            'userAccount' => $userAccount,
        ]);
    }

    public function deleteUser(Request $request): string
    {
        $id = (int) ($request->getBody()['id'] ?? 0);

        if ($id > 0 && $id !== (int) Platform::$app->user->id) {
            $userAccount = UserModel::findOne(['id' => $id]);
            if ($userAccount && $userAccount->delete()) {
                Platform::$app->session->setFlash('success', 'The user was deleted successfully.');
            } else {
                Platform::$app->session->setFlash('warning', 'The user could not be deleted.');
            }
        } else {
            Platform::$app->session->setFlash('warning', 'You cannot delete the current administrator account.');
        }

        Platform::$app->response->redirect('/admdash/usrmgmt');
        return '';
    }

    public function updateUserStatus(Request $request): string
    {
        $body = $request->getBody();
        $id = (int) ($body['id'] ?? 0);
        $userAccount = $id > 0 ? UserModel::findOne(['id' => $id]) : null;

        if (!$userAccount) {
            Platform::$app->session->setFlash('warning', 'The requested user could not be found.');
        } elseif ($id === (int) Platform::$app->user->id) {
            Platform::$app->session->setFlash('warning', 'You cannot change your own administrative status.');
        } elseif ($userAccount->updateAdministrativeStatus(
            (int) ($body['role'] ?? UserModel::ROLE_MEMBER),
            (string) ($body['account_status'] ?? UserModel::ACCOUNT_STATUS_PENDING)
        )) {
            Platform::$app->session->setFlash('success', 'The user role and account status were updated.');
        } else {
            Platform::$app->session->setFlash('warning', 'The user status could not be updated.');
        }

        Platform::$app->response->redirect('/admdash/usrmgmt');
        return '';
    }

    public function newsManagement(): string
    {
        $newsPosts = NewsPostModel::findAll([], 'post_date DESC');

        return $this->renderView('admin/newsmgmt', [
            'newsPosts' => $newsPosts,
        ]);
    }

    public function createNewsPost(Request $request): string
    {
        $newsPost = new NewsPostModel();

        if ($request->isPost()) {
            $newsPost->loadData($request->getBody());
            $newsPost->user_id = (int) Platform::$app->user->id;
            $newsPost->post_date = date('Y-m-d H:i:s');

            if ($newsPost->validate() && $newsPost->save()) {
                Platform::$app->session->setFlash('success', 'The news post was published successfully.');
                Platform::$app->response->redirect('/admdash/newsmgmt');
                return '';
            }

            Platform::$app->session->setFlash('warning', 'The news post could not be published.');
        }

        return $this->renderView('admin/newsmgmt', [
            'newsPosts' => NewsPostModel::findAll([], 'post_date DESC'),
            'newsPost' => $newsPost,
        ]);
    }

    public function deleteNewsPost(Request $request): string
    {
        $id = (int) ($request->getBody()['id'] ?? 0);
        $newsPost = $id > 0 ? NewsPostModel::findOne(['id' => $id]) : null;

        if ($newsPost && $newsPost->remove()) {
            Platform::$app->session->setFlash('success', 'The news post was deleted successfully.');
        } else {
            Platform::$app->session->setFlash('warning', 'The news post could not be deleted.');
        }

        Platform::$app->response->redirect('/admdash/newsmgmt');
        return '';
    }

    public function settings(): string
    {
        return $this->renderView('admin/settings', [
            'systemStatus' => 'Operational',
        ]);
    }

    public function tournamentModeration(): string
    {
        return $this->renderView('admin/tournaments', [
            'a_tournaments' => [],
        ]);
    }

    public function moderation(Request $request): string
    {
        Platform::$app->session->setFlash('warning', 'User moderation is handled from User Management.');
        Platform::$app->response->redirect('/admdash/usrmgmt');
        return '';
    }

    public function webMigrate(): string
    {
        return $this->renderView(Platform::$ROOT_DIR.'/Migrations.php', []);
    }
}