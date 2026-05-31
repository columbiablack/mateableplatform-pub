<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models\user\recovery;

use mateable\core\models\Model;
use mateable\core\models\user\account\UserModel;

class RecoveryByEmailModel extends Model
{

    public string $email = '';
    public string $dob = '';

    protected UserModel $user;

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
            'dob' => [
                self::RULE_REQUIRED, self::RULE_DOB,
                [
                    self::RULE_MIN
                ]
            ],
        ];
    }

    public function labels(): array
    {
        return [
            'dob' => 'Date of Birth',
            'email' => 'Email',
        ];
    }

    public function doRecoveryByEmail(): bool
    {
        try {
            /**
             * @var $recModel UserModel
             */

            $recModel = UserModel::findOne(['email' => $this->email, 'dob' => $this->dob]);

            if (!$recModel) {
                $this->addError('email', 'The user does not exist with this email.');
                return false;
            }
            /**
             * Note: This needs to send an email out to the user with their passcode, link to a password reset page,
             * or an authentic verification code to verify user.
             */
            // $user->updateUserInfo($user->id);
            // Platform::$app->user = $user;

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}