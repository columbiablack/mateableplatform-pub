<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\exceptions;

class InternalErrorException extends \Exception
{
    protected $message = 'Internal Error <br> There is something wrong with this sector.';
    protected $code = 500;

}