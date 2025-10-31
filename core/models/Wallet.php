<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

class Wallet extends DB
{
    public string $user_id = '';
    public string $address = '';
    public string $user_email = '';
    public string $creation_date = '';
    public int $id;

    public static function tableName(): string
    {
        return 'wallets';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        return parent::save();
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'address',
            'user_email'
        ];
    }

    public function rules(): array
    {
        return [];
    }

    public function removeWallet(): bool
    {
        return self::remove();
    }

    public function labels(): array
    {
        return [
            'id' => ''
        ];
    }
}