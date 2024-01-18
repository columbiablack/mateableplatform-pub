<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\routes;

use mateable\core\controllers\AuthController;
use mateable\core\controllers\SiteController;

class Routes
{
    public static function getAllowedRoutes(): array
    {
        $routesGET['get'] = [
            '/' => [SiteController::class, 'home'],
            '/login' => [AuthController::class, 'login'],
            '/register' => [AuthController::class, 'register'],
            '/aboutus' => [SiteController::class, 'aboutUs'],
            '/contact' => [SiteController::class, 'contact'],
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