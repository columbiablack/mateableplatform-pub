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
    public function renderView($view, $params = []): array|string
    {
        $layoutcontent = $this->layoutContent();
        $viewcontent = $this->renderViewOnly($view,$params);

        $layoutcontent = str_replace('{{app_name}}', $_ENV['NAME'], $layoutcontent);
        $layoutcontent = str_replace('{{content}}',$viewcontent, $layoutcontent);
        $layoutcontent = str_replace('{{logo}}','<img src="assets/img/mateable_logo.png">', $layoutcontent);
        $finalcontent = $layoutcontent;

        return $finalcontent;
    }

    protected function layoutContent(): string
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

    protected function renderViewOnly($view, $params = []): string
    {
        foreach($params as $key => $value)
        {
            $$key = $value;
        }

        ob_start();
        include_once Platform::$ROOT_DIR."/core/views/$view.mtb.php";
        return ob_get_clean();
    }
}