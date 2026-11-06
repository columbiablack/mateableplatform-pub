<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\services\BotDetection;

use function mateable\core\services\str_starts_with;

class BotDetectionService
{
    private array $aiAgents = [
        'GPTBot',
        'ChatGPT-User',
        'OAI-SearchBot',
        'ClaudeBot',
        'Claude-User',
        'Claude-SearchBot',
        'PerplexityBot',
        'Bytespider',
        'CCBot',
        'Amazonbot',
        'Applebot-Extended',
        'Meta-ExternalAgent'
    ];

    private array $blockedPaths = [
        '/.env',
        '/.git/config',
        '/wp-admin',
        '/wp-login.php',
        '/phpmyadmin',
        '/vendor/phpunit',
        '/.aws/credentials',
        '/actuator/env'
    ];

    public function inspect(array $server): array
    {
        $userAgent = trim($server['HTTP_USER_AGENT'] ?? '');
        $uri = $server['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        // Block explicitly identified AI crawlers and agents.
        foreach ($this->aiAgents as $agent) {
            if (
                $userAgent !== '' &&
                stripos($userAgent, $agent) !== false
            ) {
                return [
                    'blocked' => true,
                    'reason' => 'known_ai_agent',
                    'agent' => $agent
                ];
            }
        }

        // Block common vulnerability-scanner paths.
        foreach ($this->blockedPaths as $blockedPath) {
            if (
                $path === $blockedPath ||
                str_starts_with($path, $blockedPath . '/')
            ) {
                return [
                    'blocked' => true,
                    'reason' => 'suspicious_path',
                    'agent' => null
                ];
            }
        }

        // Missing user agents are suspicious, but not enough
        // on their own to justify blocking a visitor.
        if ($userAgent === '') {
            return [
                'blocked' => false,
                'reason' => 'missing_user_agent',
                'agent' => null
            ];
        }

        return [
            'blocked' => false,
            'reason' => 'normal',
            'agent' => null
        ];
    }
}
