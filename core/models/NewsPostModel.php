<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

class NewsPostModel extends DBModel
{
    public int $id;
    public int $user_id;
    public string $content = '';
    public string $post_date = '';

    public static function tableName(): string
    {
        return 'news_posts';
    }

    public function attributes(): array

    {
        return [
            'content',
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
            'content' => 'Message',
            'post_date' => 'Date'
        ];
    }

}