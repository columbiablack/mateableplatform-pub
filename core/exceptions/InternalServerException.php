<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\exceptions;

class InternalServerException extends \Exception
{
        protected $code = 500;
        protected $message = 'There was a internal error.';
        protected int $line;

}