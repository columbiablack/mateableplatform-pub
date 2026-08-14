<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\models;

class PostModel extends DB
{
    public int $id;
    public int $user_id;
    public string $content = '';
    public string $created_at = '';
    public string $moderation_status = 'pending';

    public static function tableName(): string
    {
        return 'posts';
    }

    public function attributes(): array

    {
        return [
            'user_id',
            'content',
            'created_at',
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

    public function labels() : array
    {
        return [
            'user_id' => 'User ID',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    public static function postCount(int $user_Id): int
    {
        return static::countAll(['user_id' => $user_Id]);
    }

    public function updateModerationStatus(string $status): bool
    {
        if (!in_array($status, ['pending', 'approved', 'rejected'], true)) {
            return false;
        }

        $statement = self::prepare(
            'UPDATE ' . self::tableName() . ' SET moderation_status = :moderation_status WHERE id = :id'
        );
        $statement->bindValue(':moderation_status', $status);
        $statement->bindValue(':id', $this->id, \PDO::PARAM_INT);

        return $statement->execute();
    }

}