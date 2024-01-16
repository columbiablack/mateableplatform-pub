<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\routes;

use mateable\core\controllers\SiteController;

class Routes
{
    public static function getAllowedRoutes(): array
    {
        return[
            '/' => [SiteController::class, 'home'],
            '/login' => [SiteController::class, 'home'],
            '/register' => [SiteController::class, 'home'],
            '/aboutus' => [SiteController::class, 'aboutUs'],
            '/contact' => [SiteController::class, 'contact']
        ];
    }
}