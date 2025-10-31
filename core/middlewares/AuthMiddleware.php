<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\middlewares;

use mateable\core\exceptions\ForbiddenException;
use mateable\core\Platform;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];

    /**
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Platform::isGuest())
        {
            if(empty($this->actions) || in_array(Platform::$app->controller->action, $this->actions))
            {
                Platform::$app->response->statusCode(403);
                throw new ForbiddenException("Authorization Required!<br /> <b>You are trying to access a forbidden area.</b><br /> You can <a href=\"/register\">create an account</a> and then try again.");
            }
        }
    }
}