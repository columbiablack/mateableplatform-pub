<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

class m11_Tournaments
{
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE tournaments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                creator_id INT NOT NULL,
                title VARCHAR(120) NOT NULL,
                game VARCHAR(120) NOT NULL,
                description TEXT NOT NULL,
                starts_at DATETIME NOT NULL,
                max_players INT NOT NULL DEFAULT 16,
                status VARCHAR(20) NOT NULL DEFAULT 'open',
                moderation_status VARCHAR(20) NOT NULL DEFAULT 'pending',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_tournament_moderation (moderation_status),
                INDEX idx_tournament_start (starts_at)
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $db->pdo->exec('DROP TABLE tournaments;');
    }
}
