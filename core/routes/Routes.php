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
            'manageUsers',
            'moderationQueue',
        ];
    }

    public static function getAllowedRoutes(): array
    {
        return ['get' => [
            '/admdash' => [AdminController::class, 'adminDash'],
            '/admdash/portal/webmigrate' => [AdminController::class, 'webMigrate'],
            '/admdash/usrmgmt' => [AdminController::class, 'manageUsers'],
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
            '/marketplace' => [SiteController::class, 'marketplace'],
            '/legal' => [SiteController::class, 'legal'],
            '/verify-us' => [SiteController::class, 'verifyUs'],
            '/tournaments' => [SiteController::class, 'tournaments'],

            '/search' => [SearchController::class, 'find'],

            '/videos' => [VidGigglesController::class, 'vidGiggles'],

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