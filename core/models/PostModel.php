<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

class PostModel extends DB
{
    public int $id;
    public int $user_id;
    public string $content = '';
    public string $post_date = '';

    public static function tableName(): string
    {
        return 'posts';
    }

    public function attributes(): array

    {
        return [
            'postContent',
            'fileInput',
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
            'postContent' => '',
            'fileInput' => '',
        ];
    }
}