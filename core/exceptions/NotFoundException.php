<?php

namespace mateable\core\exceptions;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */
class NotFoundException extends \Exception
{
    protected $message = 'The page was not found.';
    protected $code = 404;
}