<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\middlewares;

use mateable\core\Platform;
use mateable\core\exceptions\ForbiddenException;

class AdminMiddleware extends BaseMiddleware
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
        if(Platform::isGuest() || Platform::$app->user->role == Platform::$app->user::ROLE_MEMBER || Platform::$app->user->role == Platform::$app->user::ROLE_MODERATOR)
        {
            if(empty($this->actions) || in_array(Platform::$app->controller->action, $this->actions))
            {
                Platform::$app->response->statusCode(403);
                throw new ForbiddenException("Administration Authorization Required!<br /> <b>You are trying to access a Mateable Administration only area.</b><br /> If you are staff then <a href=\"/signin\">Sign in</a>.");
            }
        }
    }

}