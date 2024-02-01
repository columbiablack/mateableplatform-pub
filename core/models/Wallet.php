<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

use mateable\core\Platform;
use mateable\core\models\DBModel;

class Wallet extends DBModel
{
    public string $uid = '';
    public string $wallet_address = '';

    public function tableName(): string
    {
        return 'mtb_wallets';
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
        return ['uid', 'wallet_address'];
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