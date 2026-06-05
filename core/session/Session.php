<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\session;

class Session
{
    protected const FLASH_KEY = 'flash_messages';
    private int $lifetime;
    private int $regenerateInterval = 300; // 5 minutes

    public function __construct(int $lifetime = 604800) // default: 7 days
    {
        session_start();
        $this->lifetime = $lifetime;

        $this->applyLifetimeSettings();


        // Refresh cookie on activity
        $this->refreshCookie();

        // Secure auto-regeneration
        $this->autoRegenerateId();

        // Mark flash messages for removal
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    /* -------------------------------
     * SESSION LIFETIME MANAGEMENT
     * ------------------------------- */

    private function applyLifetimeSettings(): void
    {
        ini_set('session.gc_maxlifetime', $this->lifetime);
        ini_set('session.cookie_lifetime', $this->lifetime);

        session_set_cookie_params([
            'lifetime' => $this->lifetime,
            'path'     => '/',
            'secure'   => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    private function refreshCookie(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            setcookie(session_name(), session_id(), [
                'expires'  => time() + $this->lifetime,
                'path'     => '/',
                'secure'   => isset($_SERVER['HTTPS']),
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
        }
    }

    /** Change session lifetime dynamically */
    public function setLifetime(int $seconds): void
    {
        $this->lifetime = $seconds;
        $this->applyLifetimeSettings();
        $this->refreshCookie();
    }

    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    /* -------------------------------
     * REMEMBER ME FEATURE
     * ------------------------------- */

    /**
     * Enable Remember Me mode
     */
    public function  rememberMe(int $days): void
    {
        $seconds = $days * 24 * 60 * 60;
        $this->setLifetime($seconds);
    }

    /* -------------------------------
     * SESSION ID REGENERATION SECURITY
     * ------------------------------- */

    /** Call this manually on login */
    public function regenerateOnLogin(): void
    {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }

    /** Automatic regeneration every X seconds */
    private function autoRegenerateId(): void
    {
        $last = $_SESSION['last_regeneration'] ?? 0;

        if (time() - $last >= $this->regenerateInterval) {
            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time();
        }
    }

    public function setRegenerationInterval(int $seconds): void
    {
        $this->regenerateInterval = $seconds;
    }

    /* -------------------------------
     * FLASH MESSAGES
     * ------------------------------- */

    public function setFlash($key, $message): void
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    /* -------------------------------
     * REGULAR SESSION STORAGE
     * ------------------------------- */

    public function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key): void
    {
        unset($_SESSION[$key]);
    }

    /* -------------------------------
     * FLASH CLEANUP
     * ------------------------------- */

    public function __destruct()
    {
        $this->removeFlashMessages();
    }

    private function removeFlashMessages(): void
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => $flashMessage) {
            if (!empty($flashMessage['remove'])) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}
