        <?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

require_once __DIR__.'/vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'userClass' => \mateable\core\models\UserModel::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

try {
    $app = new Platform(__DIR__, $config);
    $app->db->applyMigrations();
}catch (\Exception|PDOException $e){
    return false;
}
