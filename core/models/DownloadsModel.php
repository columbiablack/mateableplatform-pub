<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\models;

class DownloadsModel extends DB
{
    public string $name;
    public string $url;
    public string $description;

    public static function tableName(): string
    {
        return 'downloads';
    }

    public function attributes(): array
    {
        return [
            'name',
            'url',
            'description',
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

    public function upload(): bool
    {
        return false;
    }
}