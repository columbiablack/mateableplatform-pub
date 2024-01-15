<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable;

use mateable\core\controllers\SiteController;
use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Init
{
    public function __construct()
    {
        if($_ENV['MAINTENANCE'] === true){
            // TODO Switch to maintenance mode
        }else{
            $mateable = new Platform(__DIR__);
            $mateable::$app->router->get('/', [SiteController::class, 'home']);
            $mateable::$app->router->get('/aboutus', [SiteController::class, 'aboutUs']);
            $mateable->run();
        }
    }
}
