<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace PhpOption;

use EmptyIterator;

/**
 * @extends Option<never>
 */
final class None extends Option
{
    /** @var None|null */
    private static $instance;

    /**
     * @return None
     */
    public static function create(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get()
    {
        throw new \RuntimeException('None has no value.');
    }

    /**
     * @template S
     *
     * @param callable():S $callable
     *
     * @return S
     */
    public function getOrCall($callable)
    {
        return $callable();
    }

    /**
     * @template S
     *
     * @param S $default
     *
     * @return S
     */
    public function getOrElse($default)
    {
        return $default;
    }

    public function getOrThrow(\Exception $ex)
    {
        throw $ex;
    }

    public function isEmpty(): bool
    {
        return true;
    }

    public function isDefined(): bool
    {
        return false;
    }

    public function orElse(Option $else)
    {
        return $else;
    }

    public function ifDefined($callable)
    {
        // Just do nothing in that case.
    }

    public function forAll($callable)
    {
        return $this;
    }

    public function map($callable)
    {
        return $this;
    }

    public function flatMap($callable)
    {
        return $this;
    }

    public function filter($callable)
    {
        return $this;
    }

    public function filterNot($callable)
    {
        return $this;
    }

    public function select($value)
    {
        return $this;
    }

    public function reject($value)
    {
        return $this;
    }

    public function getIterator(): EmptyIterator
    {
        return new EmptyIterator();
    }

    /**
     * @template S
     * @template R
     *
     * @param S                    $initialValue
     * @param callable(S, never):R $callable
     *
     * @return S
     */
    public function foldLeft($initialValue, $callable)
    {
        return $initialValue;
    }

    /**
     * @template S
     * @template R
     *
     * @param S                    $initialValue
     * @param callable(never, S):R $callable
     *
     * @return S
     */
    public function foldRight($initialValue, $callable)
    {
        return $initialValue;
    }

    private function __construct()
    {
    }
}
