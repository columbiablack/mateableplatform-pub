<?php

/**
 * Copyright (c) 2024. Mateable LLC
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
            '/admdash/moderation' => [AdminController::class, 'moderationQueue'],


            '/signin' => [AuthController::class, 'login'],
            '/signout' => [AuthController::class, 'logout'],
            '/signup' => [AuthController::class, 'register'],
            '/dashboard' => [AuthController::class, 'dashboard'],
            '/downloads' => [AuthController::class, 'downloads'],

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
            '/pwdrec' => [SiteController::class, 'passwordRecovery'],
            '/tournaments' => [SiteController::class, 'tournaments'],

            '/search' => [SearchController::class, 'find'],

            '/videos' => [VidGigglesController::class, 'vidGiggles'],

            '/feed' => [FeedController::class, 'getFeedIndex'],
            '/apifeed', [FeedController::class, 'api'],
            '/gov', [FeedController::class, 'api'],
            ]
        ];
    }

    public static function postAllowedRoutes(): array
    {
        $routesPOST['post'] = [
            '/signin' => [AuthController::class, 'login'],
            '/signup' => [AuthController::class, 'register'],

            '/search' => [SearchController::class, 'find'],

            '/contactus' => [SiteController::class, 'contact'],
            '/verify-us' => [SiteController::class, 'verifyUs'],
            '/contact' => [SiteController::class, 'contact'],
            '/pwdrec' => [SiteController::class, 'passwordRecovery'],
        ];
        return $routesPOST;
    }
}