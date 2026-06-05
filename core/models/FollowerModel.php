<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models;

use mateable\core\Platform;

class FollowerModel extends DB
{
    public int $id;
    public string $follower_id = '';
    public string $following_id = '';
    public string $created_at = '';

    public function rules(): array
    {
       return [];
    }

    public static function tableName(): string
    {
        return 'followers';
    }

    public function attributes(): array
    {
        return [
            'follower_id',
            'following_id',
            'created_at',
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public static function followersCount(int $user_Id): int
    {
        return static::countAll(['follower_id' => $user_Id]);
    }

    public static function followingCount(int $user_Id): int
    {
        return static::countAll(['following_id' => $user_Id]);
    }
}