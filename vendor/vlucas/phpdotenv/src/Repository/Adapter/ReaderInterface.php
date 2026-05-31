<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

declare(strict_types=1);

namespace Dotenv\Repository\Adapter;

interface ReaderInterface
{
    /**
     * Read an environment variable, if it exists.
     *
     * @param non-empty-string $name
     *
     * @return \PhpOption\Option<string>
     */
    public function read(string $name);
}
