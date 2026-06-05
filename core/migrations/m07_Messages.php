<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\migrations;

use mateable\core\Platform;

class m07_Messages
{
    public function up(): void
    {
        $db = Platform::$app->db;
        $SQL = "CREATE TABLE messages (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    sender_id INT NOT NULL,
                    receiver_id INT NOT NULL,
                    body TEXT NOT NULL,
                    is_read TINYINT(1) DEFAULT 0,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            
                    INDEX idx_receiver (receiver_id),
                    INDEX idx_sender (sender_id),
                    INDEX idx_read (is_read)
                )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "DROP TABLE messages;";
        $db->pdo->exec($SQL);
    }
}