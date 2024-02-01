<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

class m02_Comments {
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(25) NULL,
                comment VARCHAR(1024) NULL,
                comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "DROP TABLE comments;";
        $db->pdo->exec($SQL);
    }
}