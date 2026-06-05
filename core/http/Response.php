<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\http;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */
class Response
{
    public function statusCode(int $code): void
    {
        http_response_code($code);
    }

    public function redirect($url): void
    {
        header("Location: $url");
    }
}