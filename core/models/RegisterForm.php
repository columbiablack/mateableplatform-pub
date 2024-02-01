<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
 *  user: Mateable
 *  @author Stephon Green
 *  @package app\models
 */

namespace mateable\core\models;

use mateable\core\Platform;
use mateable\core\users\User;

class RegisterForm extends User
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    public int $status = self::STATUS_INACTIVE;

    public string $firstname = '';
    public string $lastname = '';
    public string $dob = '';
    public string $address1 = '';
    public string $address2 = '';
    public string $phone = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirm = '';
    public string $last_login = '';
    public string $ip_address = '';
    public int $id;


    public static function tableName(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->ip_address = Platform::$app->request->getClientAddress();
        $this->last_login = date("Y-m-d H:i:s",);
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2]],
            'lastname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2]],
            'dob' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2], [self::RULE_DOB, 'dob' => 12]],
            'address1' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 80]],
            'address2' => [],
            'phone' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
            'password_confirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes(): array
    {
        return [
            'firstname',
            'lastname',
            'dob',
            'address1',
            'address2',
            'phone',
            'email',
            'password',
            'status',
            'ip_address',
            'last_login',
        ];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'dob' => 'Date of birth',
            'address1' => 'Address Line(Primary)',
            'address2' => 'Address Line(Secondary)',
            'email' => 'E-mail Address',
            'phone' => 'Phone (No VOIP Numbers Allowed)',
            'password' => 'Password',
            'password_confirm' => 'Confirm Password',
        ];
    }

    public function displayName(): string
    {
        return $this->firstname .' '. $this->lastname;
    }

    public function displayFirstName(): string
    {
        return $this->firstname;
    }

    public function displayLastName(): string
    {
        return $this->lastname;
    }

    public function displayUserID(): int
    {
        return $this->id;
    }
}