<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

namespace mateable\core\models;

class UserVideoSearchModel extends DB
{
    public static function tableName(): string
    {
        return "users";
    }

    public function attributes(): array
    {
       return [];
    }

    public function primaryKey(): string
    {
        return "id";
    }

    public function rules(): array
    {
        return [];
    }
}