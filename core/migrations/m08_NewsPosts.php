<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

class m08_NewsPosts
{
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE news_posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                content TEXT NOT NULL,
                post_date DATETIME NOT NULL
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $db->pdo->exec('DROP TABLE news_posts;');
    }
}
