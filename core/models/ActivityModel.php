<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models;

class ActivityModel extends DB
{
    public int $id;
    public string $user_id = '';
    public string $action = '';
    public string $context = '';
    public string $created_at = '';

    public static function tableName(): string
    {
        return 'user_activity';
    }

    public function attributes(): array
    {
        return [
            'user_id',
            'action',
            'context'
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [];
    }

    public static function log(int $user_id, string $action, ?string $context = null)
    {
        $activity = new self;
        $activity->user_id = $user_id;
        $activity->action = $action;
        $activity->context  = $context;
        $activity->save();
    }
}