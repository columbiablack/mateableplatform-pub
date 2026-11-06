<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\middlewares;

use mateable\core\services\BotDetection\BotDetectionService;
use mateable\core\services\BotDetection\RequestRateLimiter;

class BotDetectionMiddleware
{
    private BotDetectionService $detector;
    private RequestRateLimiter $rateLimiter;

    public function __construct()
    {
        $this->detector = new BotDetectionService();

        $this->rateLimiter = new RequestRateLimiter(
            120,
            60
        );
    }

    public function execute(): void
    {
        $server = $_SERVER;

        // Never trust X-Forwarded-For directly.
        $ip = $server['REMOTE_ADDR'] ?? 'unknown';

        $result = $this->detector->inspect($server);

        if ($result['blocked']) {
            $this->logDetection(
                $ip,
                $result['reason'],
                $result['agent'] ?? null
            );

            $this->block(403, 'Request blocked.');
        }

        if (!$this->rateLimiter->isAllowed($ip)) {
            $this->logDetection(
                $ip,
                'rate_limit_exceeded',
                null
            );

            $this->block(429, 'Too many requests.');
        }

        if ($result['reason'] === 'missing_user_agent') {
            $this->logDetection(
                $ip,
                'missing_user_agent',
                null
            );
        }
    }

    private function block(int $status, string $message): void
    {
        if (!headers_sent()) {
            http_response_code($status);
            header('Content-Type: application/json; charset=utf-8');

            if ($status === 429) {
                header('Retry-After: 60');
            }
        }

        echo json_encode([
            'success' => false,
            'error' => $message
        ]);

        exit;
    }

    private function logDetection(
        string $ip,
        string $reason,
        ?string $agent
    ): void {
        $entry = [
            'event' => 'bot_detection',
            'ip_hash' => hash('sha256', $ip),
            'reason' => $reason,
            'agent' => $agent,
            'timestamp' => date('c')
        ];

        error_log(json_encode($entry));
    }
}
