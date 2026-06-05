<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models;

class SessionModel extends DB
{
    public string $user_id = '';
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
}