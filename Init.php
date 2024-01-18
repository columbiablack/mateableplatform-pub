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
        $maintenance = $_ENV['MAINTENANCE'];
        if($maintenance === "true"){
            // TODO Switch to maintenance mode
            echo "<h2>Site Down for maintenance</h2>";
        }elseif($maintenance === "false"){
            $config = [
                'db' => [
                    'dbname' => $_ENV['DB_NAME'],
                    'dsn' => $_ENV['DB_DSN'],
                    'port' => $_ENV['DB_PORT'],
                    'host' => $_ENV['DB_HOST'],
                    'user' => $_ENV['DB_USER'],
                    'test' => $_ENV['DB_TEST']
                ]
            ];

            $mateable = new Platform(__DIR__, $config);
            $mateable->run();
        }
    }
}
