<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

class m10_UserAccountFields
{
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "ALTER TABLE users
            ADD nickname VARCHAR(75) NULL,
            ADD account_status VARCHAR(20) NOT NULL DEFAULT 'pending'";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $db->pdo->exec('ALTER TABLE users DROP COLUMN nickname, DROP COLUMN account_status');
    }
}
