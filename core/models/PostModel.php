<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

use mateable\core\Platform;

class PostModel extends DB
{
    public int $id;
    public int $user_id;
    public string $content = '';
    public string $created_at = '';

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

}