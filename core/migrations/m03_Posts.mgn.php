<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

class m03_Posts
{
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(25) NULL,
                message VARCHAR(1024) NULL,
                post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "DROP TABLE posts;";
        $db->pdo->exec($SQL);
    }
}