<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\routes;

use mateable\core\controllers\AuthController;
use mateable\core\controllers\AdminController;
use mateable\core\controllers\FeedController;
use mateable\core\controllers\SearchController;
use mateable\core\controllers\SiteController;
use mateable\core\controllers\MessageController;
use mateable\core\controllers\VidGigglesController;

class Routes
{
    public static function authAllowedRoutes(): array
    {
        return [
            'dashboard',
            'walletmanager',
            'vidGiggles',
            'index',
            'downloads',
        ];
    }

    public static function adminAllowedRoutes(): array
    {
        return [
            'adminDash',
            'webMigrate',
            'managePosts',
            'moderatePost',
            'deletePost',
            'manageUsers',
            'newsManagement',
            'createNewsPost',
            'deleteNewsPost',
            'settings',
            'tournamentModeration',
            'moderateTournament',
            'deleteTournament',
            'moderation',
        ];
    }

    public static function getAllowedRoutes(): array
    {
        return ['get' => [
            '/admdash' => [AdminController::class, 'adminDash'],
            '/admdash/portal/webmigrate' => [AdminController::class, 'webMigrate'],
            '/admdash/postmgmt' => [AdminController::class, 'managePosts'],
            '/admdash/usrmgmt' => [AdminController::class, 'manageUsers'],
            '/admdash/usrmgmt/menu' => [AdminController::class, 'userMenu'],
            '/admdash/usrmgmt/add' => [AdminController::class, 'addUser'],
            '/admdash/newsmgmt' => [AdminController::class, 'newsManagement'],
            '/admin/settings' => [AdminController::class, 'settings'],
            '/admdash/tournaments' => [AdminController::class, 'tournamentModeration'],
            '/admdash/moderation' => [AdminController::class, 'moderation'],

            '/downloads' => [AuthController::class, 'downloads'],
            '/dashboard' => [AuthController::class, 'dashboard'],
            '/dashboard/edit/account' => [AuthController::class, 'dashboard'],
            '/dashboard/edit/profile' => [AuthController::class, 'dashboard'],
            '/dashboard/edit/events' => [AuthController::class, 'dashboard'],
            '/pwdrec' => [AuthController::class, 'passwordRecovery'],
            '/signin' => [AuthController::class, 'login'],
            '/signout' => [AuthController::class, 'logout'],
            '/signup' => [AuthController::class, 'register'],

            '/messages' => [MessageController::class, 'chat'],

            '/' => [SiteController::class, 'home'],
            '/home' => [SiteController::class, 'home'],
            '/news' => [SiteController::class, 'home'],

            '/about' => [SiteController::class, 'aboutUs'],
            '/contactus' => [SiteController::class, 'contact'],
            '/contact' => [SiteController::class, 'contact'],
            '/marketplace' => [SiteController::class, 'store'],
            '/store' => [SiteController::class, 'store'],
            '/legal' => [SiteController::class, 'legal'],
            '/verify-us' => [SiteController::class, 'verifyUs'],
            '/tournaments' => [SiteController::class, 'tournaments'],
            '/browse-tournaments' => [SiteController::class, 'tournaments'],
            '/my-tournaments' => [SiteController::class, 'tournaments'],
            '/create-tournament' => [SiteController::class, 'tournaments'],
            '/leaderboards' => [SiteController::class, 'tournaments'],
            '/creators-streams' => [SiteController::class, 'creatorsStreams'],
            '/featured-creators' => [SiteController::class, 'creatorsStreams'],
            '/live-streams' => [SiteController::class, 'creatorsStreams'],
            '/become-creator' => [SiteController::class, 'creatorsStreams'],
            '/gaming-clips' => [SiteController::class, 'creatorsStreams'],
            '/streams' => [SiteController::class, 'creatorsStreams'],
            '/payments' => [SiteController::class, 'store'],
            '/subscriptions' => [SiteController::class, 'store'],
            '/search' => [SearchController::class, 'find'],

            // '/videos' => [VidGigglesController::class, 'vidGiggles'],

            '/feeds' => [FeedController::class, 'getFeedIndex'],
            '/apifeed', [FeedController::class, 'api'],
            '/gov', [FeedController::class, 'api'],
            ]
        ];
    }

    public static function postAllowedRoutes(): array
    {
        $routesPOST['post'] = [
            '/admdash/moderation' => [AdminController::class, 'moderation'],
            '/admdash/postmgmt/delete' => [AdminController::class, 'deletePost'],
            '/admdash/postmgmt/moderate' => [AdminController::class, 'moderatePost'],
            '/admdash/newsmgmt/create' => [AdminController::class, 'createNewsPost'],
            '/admdash/newsmgmt/delete' => [AdminController::class, 'deleteNewsPost'],
            '/admdash/usrmgmt/add' => [AdminController::class, 'addUser'],
            '/admdash/usrmgmt/delete' => [AdminController::class, 'deleteUser'],
            '/admdash/usrmgmt/status' => [AdminController::class, 'updateUserStatus'],
            '/admdash/tournaments/moderate' => [AdminController::class, 'moderateTournament'],
            '/admdash/tournaments/delete' => [AdminController::class, 'deleteTournament'],
            '/tournaments/create' => [SiteController::class, 'createTournament'],
            '/tournaments/join' => [SiteController::class, 'joinTournament'],

            '/signin' => [AuthController::class, 'login'],
            '/signup' => [AuthController::class, 'register'],
            '/pwdrec' => [AuthController::class, 'passwordRecovery'],

            '/search' => [SearchController::class, 'find'],

            '/contactus' => [SiteController::class, 'contact'],
            '/verify-us' => [SiteController::class, 'verifyUs'],
            '/contact' => [SiteController::class, 'contact'],
        ];
        return $routesPOST;
    }
}