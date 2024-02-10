<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\Platform;

class MessageController extends Controller
{
    public static function chat(): string
    {
        return Platform::$app->controller->render('messaging');
    }
}