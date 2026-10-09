<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models;

use mateable\core\Platform;
use PDO;

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
            'is_read',
            'created_at',
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public static function unreadCount(int $userId): int
    {
        $stmt = self::prepare("SELECT COUNT(*) FROM messages WHERE receiver_id = :receiver_id AND is_read = 0");
        $stmt->bindValue(':receiver_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public static function messageCount(int $userId): int
    {
        $stmt = self::prepare("SELECT COUNT(*) FROM messages WHERE receiver_id = :receiver_id");
        $stmt->bindValue(':receiver_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function rules(): array
    {
        return [];
    }
}