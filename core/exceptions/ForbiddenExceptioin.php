<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\exceptions;

use Exception;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */
class ForbiddenException extends Exception
{
    protected $message = 'The page was not found.';
    protected $code = 404;
}