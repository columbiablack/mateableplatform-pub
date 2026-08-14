<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models;

class TournamentEntryModel extends DB
{
    public int $id = 0;
    public int $tournament_id = 0;
    public int $user_id = 0;
    public string $created_at = '';

    public static function tableName(): string
    {
        return 'tournament_entries';
    }

    public function attributes(): array
    {
        return ['tournament_id', 'user_id'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [];
    }
}