<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\migrations;

class m06_ServiceMessages
{
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE service_messages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_email VARCHAR(65) NULL,
                user_subject VARCHAR(75) NULL,
                user_message TEXT NULL,
                creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "DROP TABLE service_messages;";
        $db->pdo->exec($SQL);
    }
}