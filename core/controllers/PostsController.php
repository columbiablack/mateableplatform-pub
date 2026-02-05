<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\middlewares\AuthMiddleware;
use mateable\core\routes\Routes;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->registermiddleware(new AuthMiddleware((Routes::authAllowedRoutes())));
    }


}