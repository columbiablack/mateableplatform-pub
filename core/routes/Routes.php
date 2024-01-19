<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\routes;

use mateable\core\controllers\AuthController;
use mateable\core\controllers\SiteController;

class Routes
{
    public static function authAllowedRoutes(): array
    {
        return [
            'profile',
            'dashboard'
        ];
    }

    public static function getAllowedRoutes(): array
    {
        $routesGET['get'] = [
            '/' => [SiteController::class, 'home'],
            '/login' => [AuthController::class, 'login'],
            '/register' => [AuthController::class, 'register'],
            '/about-us' => [SiteController::class, 'aboutUs'],
            '/contact' => [SiteController::class, 'contact'],
            '/downloads' => [SiteController::class, 'downloads'],
            '/marketplace' => [SiteController::class, 'marketplace'],
            '/legal' => [SiteController::class, 'legal'],
            '/profile' => [AuthController::class, 'profile']
        ];
        return $routesGET;
    }

    public static function postAllowedRoutes(): array
    {
        $routesPOST['post'] = [
            '/login' => [AuthController::class, 'login'],
            '/register' => [AuthController::class, 'register'],
            '/contact' => [SiteController::class, 'contact'],
        ];
        return $routesPOST;
    }
}