<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\exceptions;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class NotFoundException extends \Exception
{
    protected $message = 'The requested page was not found.';
    protected $code = 404;
}