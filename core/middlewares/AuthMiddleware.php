<?php

namespace app\system\middlewares;

use app\system\core\Application;
use app\system\exception\ForbiddenException;
use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */
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
                Platform::$app->view->renderview('_error',['exception' => 'You\'re forbidden to see this part of the site!', 'exceptiontitle' => 'Forbidden']);
            }
        }
    }
}