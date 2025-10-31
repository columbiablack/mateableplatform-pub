<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

class Post extends \mateable\core\models\DB
{
    public int $id;
    public int $user_id;
    public string $title = '';
    public string $message = '';
    public string $post_date = '';

    public static function tableName(): string
    {
        return 'posts';
    }

    public function attributes(): array
    {
        return [];
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