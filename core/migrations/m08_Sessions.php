<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

class m08_Sessions {
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS sessions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                session_id VARCHAR(128) NOT NULL,
                user_id INT NULL,
                ip_address VARCHAR(45) NOT NULL,
                user_agent TEXT NOT NULL,
                created_at DATETIME NOT NULL,
                last_activity DATETIME NOT NULL,
                expires_at DATETIME NOT NULL,
                UNIQUE KEY session_unique (session_id)
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $db->pdo->exec("DROP TABLE IF EXISTS sessions;");
    }
}
