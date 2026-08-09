<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\models;

class StoreModel extends Model
{
    public static function sections(): array
    {
        return [
            'games' => [
                'label' => 'Games',
                'items' => [
                    ['name' => 'Nightfall Cup', 'type' => 'Tournament Pack', 'price' => '$9.99', 'badge' => 'Featured'],
                    ['name' => 'Rift Arena Pass', 'type' => 'Season Access', 'price' => '$14.99', 'badge' => 'New'],
                    ['name' => 'Arcade Vault', 'type' => 'Bundle', 'price' => '$19.99', 'badge' => 'Popular'],
                ],
            ],
            'software' => [
                'label' => 'Software',
                'items' => [
                    ['name' => 'Creator Studio', 'type' => 'Desktop App', 'price' => '$12.99', 'badge' => 'Pro'],
                    ['name' => 'Stream Overlay Pack', 'type' => 'Bundle', 'price' => '$7.99', 'badge' => 'Editor Pick'],
                ],
            ],
            'rewards' => [
                'label' => 'Rewards',
                'items' => [
                    ['name' => 'Reward Points Pack', 'type' => 'Credits', 'price' => '$4.99', 'badge' => 'Top'],
                    ['name' => 'Premium Drop', 'type' => 'Gift Box', 'price' => '$8.99', 'badge' => 'Limited'],
                ],
            ],
        ];
    }

    public static function getCatalog(string $section = 'games'): array
    {
        $catalog = self::sections();
        return $catalog[$section]['items'] ?? $catalog['games']['items'];
    }

    public static function getSectionLabel(string $section = 'games'): string
    {
        $catalog = self::sections();
        return $catalog[$section]['label'] ?? $catalog['games']['label'];
    }

    public function rules(): array
    {
        return [];
    }
}
