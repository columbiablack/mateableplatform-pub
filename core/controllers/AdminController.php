<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\middlewares\AdminMiddleware;
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
        return $this->renderView('admin/adminpanel', [
            'totalu'=> Platform::$app->user::countAll(),
        ]);
    }

    public function webMigrate()
    {
        return include(Platform::$ROOT_DIR.'/Migrations.php');
    }
}