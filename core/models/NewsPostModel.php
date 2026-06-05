<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
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
            'post_date',
            'content',
            'user_id',
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

    public function postContent(): string
    {
        return $this->content;
    }

    public function postUserID(): int
    {
        return $this->user_id;
    }

    public function postDate(): string
    {
        return $this->post_date;
    }
}