<?php

/**
 * Copyright (c) 2024 Mateable LLC
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
        $maintenance = $_ENV['MAINTENANCE'];
        if($maintenance === "true"){
            // TODO Switch to maintenance mode
            echo "<h2>Site Down for maintenance</h2>";
        }elseif($maintenance === "false"){
            $mateable = new Platform(__DIR__);
            $mateable::$app->router->get('/', [SiteController::class, 'home']);
            $mateable::$app->router->get('/aboutus', [SiteController::class, 'aboutUs']);
            $mateable->run();
        }
    }
}
