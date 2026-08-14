<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

class m12_TournamentEntries
{
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE tournament_entries (
                id INT AUTO_INCREMENT PRIMARY KEY,
                tournament_id INT NOT NULL,
                user_id INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY unique_tournament_user (tournament_id, user_id),
                INDEX idx_entry_tournament (tournament_id),
                INDEX idx_entry_user (user_id)
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $db->pdo->exec('DROP TABLE tournament_entries;');
    }
}