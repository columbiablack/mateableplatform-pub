<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models;

use mateable\core\Platform;

class MessageModel extends DB
{
    public int $id;
    public int $sender_id;
    public int $receiver_id;
    public string $body;
    public int $is_read;
    public string $created_at;

    public static function tableName(): string
    {
        return 'messages';
    }

    public function attributes(): array
    {
        return [
            'sender_id',
            'receiver_id',
            'body',
            'is_read'
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public static function unreadCount(int $userId): int
    {
        return self::countAll(["receiver_id" => Platform::$app->user->id, "is_read" => false]);
    }

    public static function messageCount(int $userId): int
    {
        return self::countAll(['receiver_id' => Platform::$app->user->id]);
    }

    public function rules(): array
    {
        return [];
    }
}