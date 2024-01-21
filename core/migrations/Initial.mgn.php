<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

class Initial {
    public function up()
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(75) NOT NULL,
                firstname VARCHAR(75) NOT NULL,
                lastname VARCHAR(75) NOT NULL,
                status TINYINT DEFAULT 0,
                address1 VARCHAR(255) NOT NULL ,
                address2 VARCHAR(55) NULL,
                phone VARCHAR(25) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }
}