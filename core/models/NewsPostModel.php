<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\models;

class NewsPostModel extends DB
{
    public int $id;
    public int $user_id = 0;
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
        return [
            'content' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 10000]],
        ];
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