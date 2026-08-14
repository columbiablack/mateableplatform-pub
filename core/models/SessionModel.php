<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models;

use PDO;

class SessionModel extends DB
{
    public int $id = 0;
    public ?int $user_id = null;
    public string $session_id = '';
    public string $ip_address = '';
    public string $user_agent = '';
    public string $created_at = '';
    public string $last_activity = '';
    public string $expires_at = '';

    public static function tableName(): string
    {
        return 'sessions';
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'session_id',
            'ip_address',
            'user_agent',
            'created_at',
            'last_activity',
            'expires_at',
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [];
    }

    public static function countActiveSessions(int $seconds = 900): int
    {
        try {
            $table = static::tableName();
            $cutoff = time() - $seconds;
            $sql = "SELECT COUNT(*) FROM {$table} WHERE UNIX_TIMESTAMP(last_activity) >= :cutoff";
            $stmt = self::prepare($sql);
            $stmt->bindValue(':cutoff', $cutoff, PDO::PARAM_INT);
            $stmt->execute();
            return (int) $stmt->fetchColumn();
        } catch (\Throwable $e) {
            return 0;
        }
    }
}