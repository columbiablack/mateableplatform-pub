<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\middlewares\AuthMiddleware;
use mateable\core\Platform;
use mateable\core\routes\Routes;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(Routes::authAllowedRoutes()));
    }

    public function chat(): string
    {
        return Platform::$app->controller->renderView('/profile/messages/chat');
    }
}