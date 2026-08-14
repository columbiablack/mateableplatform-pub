<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models;

class TournamentModel extends DB
{
    public const STATUS_OPEN = 'open';
    public const STATUS_CLOSED = 'closed';
    public const MODERATION_PENDING = 'pending';
    public const MODERATION_APPROVED = 'approved';
    public const MODERATION_REJECTED = 'rejected';

    public int $id = 0;
    public int $creator_id = 0;
    public string $title = '';
    public string $game = '';
    public string $description = '';
    public string $starts_at = '';
    public int $max_players = 0;
    public string $status = 'open';
    public string $moderation_status = 'pending';
    public string $created_at = '';

    public static function tableName(): string
    {
        return 'tournaments';
    }

    public function attributes(): array
    {
        return [
            'creator_id',
            'title',
            'game',
            'description',
            'starts_at',
            'max_players',
            'status',
            'moderation_status',
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 120]],
            'game' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2], [self::RULE_MAX, 'max' => 120]],
            'description' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 5000]],
            'starts_at' => [self::RULE_REQUIRED],
        ];
    }

    public function updateModerationStatus(string $moderationStatus): bool
    {
        if (!in_array($moderationStatus, ['pending', 'approved', 'rejected'], true)) {
            return false;
        }

        $statement = self::prepare(
            'UPDATE tournaments SET moderation_status = :moderation_status WHERE id = :id'
        );
        $statement->bindValue(':moderation_status', $moderationStatus);
        $statement->bindValue(':id', $this->id, \PDO::PARAM_INT);

        return $statement->execute();
    }
}
