<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable;

use mateable\core\exceptions\Exception;
use mateable\core\exceptions\InternalServerException;
use mateable\core\models\RegisterForm;
use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Init
{
    public function __construct()
    {
        try{
            $maintenance = $_ENV['MAINTENANCE'];
            if($maintenance === "true"){
                // TODO Switch to maintenance mode
                include_once(__DIR__ . '/core/views/maintenance.mtb.php');
            }elseif($maintenance === "false"){
                $config = [
                    'db' => [
                        'dbname' => $_ENV['DB_NAME'],
                        'dsn' => $_ENV['DB_DSN'],
                        'port' => $_ENV['DB_PORT'],
                        'host' => $_ENV['DB_HOST'],
                        'user' => $_ENV['DB_USER'],
                        'password' => $_ENV['DB_PASSWORD'],
                    ]
                ];
                $mateable = new Platform(__DIR__, $config);
                $mateable->run();
            }
        }catch(Exception $exception){

        }
    }
}
