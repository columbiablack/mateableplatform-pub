<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\middlewares\BaseMiddleware;
use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class Controller
{
    public string $action = '';

    private string $layout = 'main';
    private array $dirList =[];

    /**
     * @var BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function renderView($view, $params = []): string
    {
        return Platform::$app->view->renderView($view, $params);
    }

    public function renderLegal($view, $params = []): string
    {
        return Platform::$app->view->renderLegalView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function setLayout(string $name): bool
    {
        if(array_search($name,$this->getLayouts())){
            $this->layout = $name;
            return true;
        }else{
            return false;
        }
    }

    public function getLayout(): string
    {
        return Platform::$app->controller->layout;
    }

    public function getLayouts(): array
    {
        foreach(scandir(Platform::$ROOT_DIR.'/core/views/layouts/') as $key => $value){
            if(str_contains($value, '.') || str_contains($value, '..') || str_contains($value, 'htaccess')) {
                continue;
            }else{
                $this->dirList += [$key => $value];
            }
        }
        return $this->dirList;
    }
}