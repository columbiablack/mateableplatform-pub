<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\session;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */
class Session
{
    protected const FLASH_KEY = 'flash_messages';
    private int $lifetime = 0;

    public function __construct()
    {
        $this->lifetime = 60 * 60 * 24 * 7; // 7 days

        // Ensure garbage collection and cookie lifetimes match
        ini_set('session.gc_maxlifetime', $this->lifetime);
        ini_set('session.cookie_lifetime', $this->lifetime);

        // Use the same lifetime for the session cookie
        session_set_cookie_params([
            'lifetime' => $this->lifetime,
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']), // only use HTTPS cookies
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        session_start();

        // Refresh the cookie each time user is active
        setcookie(session_name(), session_id(), [
            'expires' => time() + $this->lifetime,
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        // Handle flash messages
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

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

    public function __destruct()
    {
        $this->removeFlashMessages();
    }

    private function removeFlashMessages(): void
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => $flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}
