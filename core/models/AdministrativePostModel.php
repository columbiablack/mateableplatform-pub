<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

class AdministrativePostModel extends DB
{
    public string $author;
    public string $post;
    public int $id;

    public static function tableName(): string
    {
        // TODO: Implement tableName() method.
    }

    public function attributes(): array
    {
        // TODO: Implement attributes() method.
    }

    public function primaryKey(): string
    {
        // TODO: Implement primaryKey() method.
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
    }
}