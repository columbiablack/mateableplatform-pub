<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

/**
 *  user: Mateable
 *  @author Stephon Green
 *  @package app\models
 */

namespace mateable\core\models\user\account;

use mateable\core\Platform;
use mateable\core\users\User;

class UserModel extends User
{
    #
    public const STATUS_ACTIVE = 0;
    public const STATUS_INACTIVE = 1;

    public const ACCOUNT_STATUS_ACTIVE = 'active';
    public const ACCOUNT_STATUS_SUSPENDED = 'suspended';
    public const ACCOUNT_STATUS_PENDING = 'pending';

    public const ROLE_ADMINISTRATOR = 2;
    public const ROLE_MODERATOR = 1;
    public const ROLE_MEMBER = 0;

    public int $status = self::STATUS_ACTIVE;
    public int $role = self::ROLE_MEMBER;

    public string $firstname = '';
    public string $lastname = '';
    public string $dob = '';
    public string $address1 = '';
    public string $address2 = '';
    public string $city = '';
    public string $state = '';
    public string $zip = '';
    public string $phone = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirm = '';
    public string $last_login = '';
    public string $ip_address = '';
    public string $account_status = self::ACCOUNT_STATUS_PENDING;
    public string $nickname = '';

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
        $this->last_login = date("Y-m-d H:i:s");
        $this->status = self::STATUS_INACTIVE;
        $this->role = self::ROLE_MEMBER;
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        return parent::save();
    }

    public function updateUserInfo(string $id): bool
    {
        $this->ip_address = Platform::$app->request->getClientAddress();
        $this->last_login = date("Y-m-d H:i:s");
        return parent::updateUserInfo($id);
    }

    public function updateAdministrativeStatus(int $role, string $accountStatus): bool
    {
        if (!in_array($role, [self::ROLE_MEMBER, self::ROLE_MODERATOR, self::ROLE_ADMINISTRATOR], true)) {
            return false;
        }

        if (!in_array($accountStatus, [self::ACCOUNT_STATUS_ACTIVE, self::ACCOUNT_STATUS_PENDING, self::ACCOUNT_STATUS_SUSPENDED], true)) {
            return false;
        }

        $statement = self::prepare(
            'UPDATE ' . self::tableName() . ' SET role = :role, account_status = :account_status WHERE id = :id'
        );
        $statement->bindValue(':role', $role, \PDO::PARAM_INT);
        $statement->bindValue(':account_status', $accountStatus);
        $statement->bindValue(':id', $this->id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2]],
            'lastname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2]],
            'dob' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2], [self::RULE_DOB, 'dob' => 12]],
            'address1' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 80]],
            'address2' => [],
            'city' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2], [self::RULE_MAX, 'max' => 80]],
            'state' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2], [self::RULE_MAX, 'max' => 03]],
            'zip' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 20]],
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
            'city',
            'state',
            'zip',
            'phone',
            'email',
            'password',
            'status',
            'role',
            'ip_address',
            'last_login',
            'account_status',
            'nickname',
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
            'phone' => 'Phone (No VOIP Numbers)',
            'password' => 'Password',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip Code',
            'password_confirm' => 'Confirm Password',
            'nickname' => 'Nickname',
        ];
    }

    public function displayNickname(): string
    {
        return $this->nickname;
    }

    public function displayName(): string
    {
        return $this->firstname .' '. $this->lastname ?? '';
    }

    public function displayFirstName(): string
    {
        return $this->firstname ?? '';
    }

    public function displayLastName(): string
    {
        return $this->lastname ?? '';
    }

    public function displayUserID(): int
    {
        return $this->id ?? '';
    }

    public function displayEmail(): string
    {
        return $this->email ?? '';
    }

    public function displayDOB(): string
    {
        return $this->dob ?? '';
    }

    public function displayRole(): string
    {
        return $this->role ?? '';
    }

    public function displayAccountStatus(): string
    {
        return $this->account_status ?? '';
    }
}