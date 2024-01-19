<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\views;

use mateable\core\Platform;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

class View
{
    protected array $dirList =[];
    public function renderView($view, $params = []): array|string
    {
        $layout_content = $this->layoutContent();
        $viewcontent = $this->renderViewOnly($view,$params);

        $layout_content = str_replace('{{app_name}}', $_ENV['NAME'], $layout_content);
        $layout_content = str_replace('{{content}}',$viewcontent, $layout_content);
        return str_replace('{{logo}}','<img src="assets/img/mateable_logo.png">', $layout_content);
    }

    public function renderLegalView($view, $params = []): array|string
    {
        $legal_layout_content = $this->layoutLegalContent();
        $viewcontent = $this->renderLegalViewOnly($view,$params);

        $legal_layout_content = str_replace('{{app_name}}', $_ENV['NAME'], $legal_layout_content);
        $legal_layout_content = str_replace('{{content}}',$viewcontent, $legal_layout_content);
        return str_replace('{{logo}}','<img src="assets/img/mateable_logo.png">', $legal_layout_content);
    }

    public function renderViewOnly($view, $params = []): string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Platform::$ROOT_DIR."/core/views/$view.mtb.php";
        return ob_get_clean();
    }

    public function renderLegalViewOnly($view, $params = []): string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Platform::$ROOT_DIR."/core/views/legal/$view.legal.php";
        return ob_get_clean();
    }

    public function layoutContent(): string
    {
        $layout = Platform::$app->controller->layout;

        if(Platform::$app->controller)
        {
            $layout = Platform::$app->controller->layout;
        }

        ob_start();
        include_once Platform::$ROOT_DIR."/core/views/layouts/$layout.mtb.php";
        return ob_get_clean();
    }

    public function layoutLegalContent(): string
    {
        $layout = Platform::$app->controller->layout;

        if(Platform::$app->controller)
        {
            $layout = Platform::$app->controller->layout;
        }

        ob_start();
        include_once Platform::$ROOT_DIR."/core/views/layouts/$layout.mtb.php";
        return ob_get_clean();
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