<?php

/**
 * Copyright (c) 2025-2026. Mateable LLC
 */

namespace mateable\core\models;

class SearchModel extends Model
{
    public string $q = '';

    public function tableName(): string
    {
        return 'downloads,posts,comments,news_posts';
    }

    public function rules(): array
    {
        return [
            'q' => [
                self::RULE_REQUIRED,
                [
                    self::RULE_MIN,
                    'min' => 1
                ]
            ]
        ];
    }

    public function labels(): array
    {
        return [
            'q' => '',
        ];
    }

    public function search(): array
    {
        // Replace with your real search logic
        if (!$this->validate()) {
            return [];
        }

        $q = $this->q;

        return [
            "Posts Results for {$q}",
            "Video Results for {$q}",
            "Download Results for {$q}"
        ];
    }
}
