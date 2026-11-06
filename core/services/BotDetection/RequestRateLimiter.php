<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\services\BotDetection;

class RequestRateLimiter
{
    private string $storagePath;
    private int $maxRequests;
    private int $windowSeconds;

    public function __construct(
        int $maxRequests = 120,
        int $windowSeconds = 60,
        ?string $storagePath = null
    ) {
        $this->maxRequests = $maxRequests;
        $this->windowSeconds = $windowSeconds;

        // Keep this directory outside the public web root.
        $this->storagePath = $storagePath
            ?? sys_get_temp_dir() . '/mateable-rate-limits';
    }

    public function isAllowed(string $ip): bool
    {
        if (
            !is_dir($this->storagePath) &&
            !mkdir($this->storagePath, 0700, true) &&
            !is_dir($this->storagePath)
        ) {
            error_log('Mateable rate limiter: storage unavailable.');
            return true; // Fail open rather than taking down the site.
        }

        $filename = hash('sha256', $ip) . '.json';
        $filepath = $this->storagePath . DIRECTORY_SEPARATOR . $filename;

        $handle = @fopen($filepath, 'c+');

        if ($handle === false) {
            error_log('Mateable rate limiter: unable to open storage.');
            return true;
        }

        try {
            if (!flock($handle, LOCK_EX)) {
                return true;
            }

            rewind($handle);
            $contents = stream_get_contents($handle);
            $data = json_decode($contents ?: '{}', true);

            if (!is_array($data)) {
                $data = [];
            }

            $now = time();
            $windowStart = (int) ($data['window_start'] ?? 0);
            $count = (int) ($data['count'] ?? 0);

            if (
                $windowStart === 0 ||
                ($now - $windowStart) >= $this->windowSeconds
            ) {
                $windowStart = $now;
                $count = 0;
            }

            $count++;

            $updated = [
                'window_start' => $windowStart,
                'count' => $count
            ];

            rewind($handle);
            ftruncate($handle, 0);
            fwrite($handle, json_encode($updated));
            fflush($handle);

            return $count <= $this->maxRequests;
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }
}
