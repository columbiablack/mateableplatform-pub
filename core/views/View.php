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
    protected ViewManager $viewManager;

    public function __construct()
    {
        $this->viewManager = Platform::$app->viewManager;
    }

    public function renderView($view, $params = []): array|string
    {
        $layout_content = $this->layoutContent();
        $viewcontent = $this->renderViewOnly($view,$params);

        $layout_content = str_replace("{{content}}", $viewcontent, $layout_content);

        return $this->viewManager->convert($layout_content);
    }

    public function renderLegalView($view, $params = []): array|string
    {
        $legal_layout_content = $this->layoutLegalContent();
        $viewcontent = $this->renderLegalViewOnly($view,$params);

        $legal_layout_content = str_replace("{{content}}", $viewcontent, $legal_layout_content);

        return $this->viewManager->convert($legal_layout_content);
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
        $layout = Platform::$app->controller->getLayout();

        if(Platform::$app->controller)
        {
            $layout = Platform::$app->controller->getLayout();
        }

        ob_start();
        include_once Platform::$ROOT_DIR."/core/views/layouts/$layout/main.mtb.php";
        return ob_get_clean();
    }

    public function layoutLegalContent(): string
    {
        $layout = Platform::$app->controller->getLayout();

        if(Platform::$app->controller)
        {
            $layout = Platform::$app->controller->getLayout();
        }

        ob_start();
        include_once Platform::$ROOT_DIR."/core/views/layouts/$layout/main.mtb.php";
        return ob_get_clean();
    }

    public function viewExist(string $filename): bool
    {
        $result = false;
        $dirs[] = scandir(Platform::$ROOT_DIR."/core/views/") ?? [];
        foreach($dirs as $dir){
            if($dir == '.' || $dir == '..') {
                continue;
            }elseif(array_search($filename,$dir)){
                $result = true;
            }
        }
        return $result;
    }
}