<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\routes;

use mateable\core\controllers\AuthController;
use mateable\core\controllers\FeedController;
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
        ];
    }

    public static function getAllowedRoutes(): array
    {
        return ['get' => [
            '/login' => [AuthController::class, 'login'],
            '/messages' => [MessageController::class, 'chat'],
            '/register' => [AuthController::class, 'register'],
            '/dashboard' => [AuthController::class, 'dashboard'],

            '/' => [SiteController::class, 'home'],
            '/home' => [SiteController::class, 'home'],
            '/news' => [SiteController::class, 'home'],
            '/about-us' => [SiteController::class, 'aboutUs'],
            '/contactus' => [SiteController::class, 'contact'],
            '/contact' => [SiteController::class, 'contact'],
            '/downloads' => [SiteController::class, 'downloads'],
            '/marketplace' => [SiteController::class, 'marketplace'],
            '/legal' => [SiteController::class, 'legal'],
            '/verify-us' => [SiteController::class, 'verifyUs'],
            '/webmigrate' => [SiteController::class, 'webMigrate'],
            '/logout' => [SiteController::class, 'logout'],
            '/pwdrec' => [SiteController::class, 'passwordRecovery'],

            '/videos' => [VidGigglesController::class, 'vidGiggles'],

            '/feed' => [FeedController::class, 'getFeedIndex'],
            '/apifeed', [FeedController::class, 'api'],
            ]
        ];
    }

    public static function postAllowedRoutes(): array
    {
        $routesPOST['post'] = [
            '/login' => [AuthController::class, 'login'],
            '/register' => [AuthController::class, 'register'],
            '/register#register' => [AuthController::class, 'register'],
            '/contactus' => [SiteController::class, 'contact'],
            '/contact' => [SiteController::class, 'contact'],
            '/verify-us' => [SiteController::class, 'verifyUs'],
            '/pwdrec' => [SiteController::class, 'passwordRecovery'],
        ];
        return $routesPOST;
    }
}