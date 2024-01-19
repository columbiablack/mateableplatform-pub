<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\exceptions;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */
class ForbiddenException extends Exception
{
    protected $message = 'Forbidden Access - You\'re not authorized to view this sector.';
    protected $code = 403;
}