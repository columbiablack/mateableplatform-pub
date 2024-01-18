<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

use mateable\core\Platform;
use mateable\core\models\Users;


class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [
                    self::RULE_MIN,
                    'min' => 2
                ]
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 2]
            ]
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function doLogin(): bool
    {
        $user = Users::findOne(['email' => $this->email]);

        if(!$user)
        {
            $this->addError('email','The user does not exist with this email.');
            return false;
        }

        if(!password_verify($this->password, $user->password))
        {
            $this->addError('password','The password is incorrect.');
            return false;
        }

        return Platform::$app->login($user);
    }

}