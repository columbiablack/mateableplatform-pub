<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\middlewares;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}