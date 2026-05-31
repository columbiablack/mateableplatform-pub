<?php

/**
 * Copyright (c) 2025-2026. Mateable LLC
 */

namespace mateable\core\security;

class Security
{
    /**
     * Generate a strong cryptographic token.
     */
    public static function token(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Create a hash using PASSWORD_DEFAULT.
     */
    public static function hash(string $value): string
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * Verify a hashed value.
     */
    public static function verify(string $value, string $hash): bool
    {
        return password_verify($value, $hash);
    }

    /**
     * Constant-time string comparison (protection against timing attacks).
     */
    public static function slowEquals(string $a, string $b): bool
    {
        return hash_equals($a, $b);
    }

    /**
     * Regenerate session ID safely to prevent fixation.
     */
    public static function regenerateSessionID(bool $deleteOld = true): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        session_regenerate_id($deleteOld);
    }

    /**
     * Set a secure cookie (HTTP-only, SameSite, Secure).
     */
    public static function setSecureCookie(
        string $name,
        string $value,
        int $expires = 0
    ): void {
        setcookie($name, $value, [
            'expires'  => $expires,
            'path'     => '/',
            'secure'   => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }

    /**
     * Remove a secure cookie.
     */
    public static function deleteCookie(string $name): void
    {
        setcookie($name, '', [
            'expires' => time() - 3600,
            'path'    => '/',
        ]);
    }

    /**
     * Basic HTML sanitization for output.
     */
    public static function escape(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Generate and store a CSRF token.
     */
    public static function csrfToken(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = self::token(32);
        }

        return $_SESSION['csrf_token'];
    }

    /**
     * Validate a CSRF token from POST requests.
     */
    public static function validateCsrf(string $token): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return isset($_SESSION['csrf_token'])
            && hash_equals($_SESSION['csrf_token'], $token);
    }
}
