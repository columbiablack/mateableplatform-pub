<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

class ContactForm extends Model
{
    public string $email = '';
    public string $subject = '';
    public string $message = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED],
            'subject' => [self::RULE_REQUIRED],
            'message' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Your email',
            'subject' => 'Subject',
            'message' => 'Message'
        ];
    }

    public function contactUs(): bool
    {

    }
}