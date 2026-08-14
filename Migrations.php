        <?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

require_once __DIR__.'/vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dbname' => $_ENV['DB_NAME'] ?? '',
        'dsn' => $_ENV['DB_DSN'],
        'port' => $_ENV['DB_PORT'] ?? '',
        'host' => $_ENV['DB_HOST'] ?? '',
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
    'vg' => [
        'dbname' => $_ENV['VG_NAME'] ?? '',
        'dsn' => $_ENV['VG_DSN'] ?? $_ENV['DB_DSN'],
        'host' => $_ENV['VG_HOST'] ?? '',
        'port' => $_ENV['VG_PORT'] ?? '',
        'user' => $_ENV['VG_USER'] ?? $_ENV['DB_USER'],
        'password' => $_ENV['VG_PASSWORD'] ?? $_ENV['DB_PASSWORD'],
    ]
];

try {
    $app = new Platform(__DIR__, $config);
    $app->db->applyMigrations();
}catch (\Exception|PDOException $e){
    http_response_code(500);
    echo '<h1>Migration failed</h1><pre>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</pre>';
}
