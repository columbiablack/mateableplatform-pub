<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

class m04_Subscriptions
{
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE subscriptions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(25) NULL,
                subscription_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "DROP TABLE subscriptions;";
        $db->pdo->exec($SQL);
    }
}