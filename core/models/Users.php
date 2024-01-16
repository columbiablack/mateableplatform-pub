<?php

/**
 *  user: Mateable
 *  @author Stephon Green
 *  @package app\models
 */

namespace mateable\core\models;

use mateable\core\users\User;

class Users extends User
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    public int $status = self::STATUS_INACTIVE;

    public string $firstname = '';
    public string $lastname = '';
    public string $dob = '';
    public string $location = '';
    public string $email = '';
    public string $username = '';
    public string $password = '';
    public string $password_confirm = '';
    public int $id;


    public function tableName(): string
    {
        return 'mtb_users';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        //$this->uploadProfilePicture($this->user_image);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2]],
            'lastname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2]],
            'dob' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2], [self::RULE_DOB, 'dob' => 18]],
            'location' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 180]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'username' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
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
            'location',
            'email',
            'username',
            'password',
            'status'
        ];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'dob' => 'Date of birth',
            'location' => 'Location',
            'username' => 'Username',
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

    public function displayUserName(): string
    {
        return $this->username;
    }

    public function displayUserID(): int
    {
        return $this->id;
    }
}