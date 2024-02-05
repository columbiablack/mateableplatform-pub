<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

use mateable\core\Platform;

class Wallet extends DB
{
    public string $user_id = '';
    public string $address = '';

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
            'address'
        ];
    }

    public function rules(): array
    {
        return [];// TODO: Implement rules() method.
    }

    public function makeNewWallet(RegisterForm $user)
    {
        $this->uid = $user->displayUserID();
        $this->wallet_address =  Platform::$app->bitcoin->createwallet($user->email, false, false, "", false, false, false);
    }
}