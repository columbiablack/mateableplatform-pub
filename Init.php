<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable;

use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Init
{
    public function __construct()
    {
        $maintenance = $_ENV['WEBSITE_UPGRADE'];
        $config = [
            'db' => [
                'dbname' => $_ENV['DB_NAME'],
                'dsn' => $_ENV['DB_DSN'],
                'port' => $_ENV['DB_PORT'],
                'host' => $_ENV['DB_HOST'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],
            ],
            'MTBC' => [
                'MTBC_USER' => $_ENV['MTBC_USER'],
                'MTBC_PASSWORD' => $_ENV['MTBC_PASSWORD'],
                'MTBC_HOST' => $_ENV['MTBC_HOST'],
                'MTBC_PORT' => $_ENV['MTBC_PORT'],
                'MTBC_URL' => $_ENV['MTBC_URL'],
            ],
            'vg' => [
                'dbname' => $_ENV['VG_NAME'],
                'dsn' => $_ENV['VG_DSN'],
                'host' => $_ENV['VG_HOST'],
                'port' => $_ENV['VG_PORT'],
                'user' => $_ENV['VG_USER'],
                'password' => $_ENV['VG_PASSWORD'],
            ]
        ];
        $mateable = new Platform(__DIR__, $config);

        if($maintenance == 1 || $maintenance == 01){
            $mateable->runMaintenance();
        }elseif($maintenance == 0 || $maintenance == 00){
            $mateable->run();
        }
    }
}
