<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

class m09_PostModeration
{
    public function up(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $SQL = "ALTER TABLE posts ADD moderation_status VARCHAR(20) NOT NULL DEFAULT 'pending'";
        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \mateable\core\Platform::$app->db;
        $db->pdo->exec('ALTER TABLE posts DROP COLUMN moderation_status');
    }
}