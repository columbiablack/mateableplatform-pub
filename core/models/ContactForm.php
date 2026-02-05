<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

class ContactForm extends DB
{
    public string $user_email = '';
    public string $user_subject = '';
    public string $user_message = '';

    public static function tableName(): string
    {
        return 'service_messages';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return [
            'user_email',
            'user_subject',
            'user_message',
        ];
    }

    public function labels(): array
    {
        return [
            'user_email' => 'Your email',
            'user_subject' => 'Subject',
            'user_message' => 'Message'
        ];
    }

    public function rules(): array
    {
        return [
            'user_email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'user_subject' => [self::RULE_REQUIRED,[self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 120]],
            'user_message' => [self::RULE_REQUIRED]
        ];
    }

    public function contactUs(): bool
    {
        // MailToUs, add to db contacts.
        return Parent::save();
    }
}