<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

class m05_Wallets
{
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE wallets (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(25) NULL,
                address VARCHAR(56) NULL,
                user_email VARCHAR(75) NULL,
                creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "DROP TABLE wallets;";
        $db->pdo->exec($SQL);
    }
}