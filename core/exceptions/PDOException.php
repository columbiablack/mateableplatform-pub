<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\exceptions;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */
class PDOException extends \PDOException
{
    public ?array $errorInfo = ['The database was not found.'];
    protected $code = 'Db-404';
}