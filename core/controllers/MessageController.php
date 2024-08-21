<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\Platform;

class MessageController extends Controller
{
    public function chat(): string
    {
        return Platform::$app->controller->renderView('/profile/messages/chat');
    }
}