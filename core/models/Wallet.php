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
    public string $user_email = '';

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

    public function createNewWallet(RegisterForm $user): bool
    {
        $this->user_id = $user->id;
        $this->user_email = $user->email;

        if($this->user_email && $this->user_id){
            $this->address = Platform::$app->mateablecoin->getnewaddress("$user->email");
        }

        if(Platform::$app->mateablecoin->status == 200){
            return true;
        }else{
            return false;
        }
    }
}