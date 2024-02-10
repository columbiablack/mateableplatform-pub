<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\form;

use mateable\core\models\Model;

class Form
{
    /**
     * @param $action
     * @param $method
     * @return Form
     */
    public static function begin($action, $method): Form
    {
        echo '<form action="' . $action . '" method="' . $method . '" enctype="multipart/form-data">'.PHP_EOL;
        return new Form();
    }

    public static function end(): string
    {
        return '
            </form>
            '.PHP_EOL;
    }

    public function field(Model $model, string $attribute): Field
    {
        return new Field($model, $attribute);
    }

    public function fieldTextArea(Model $model, string $attribute)
    {
        return new TextArea($model, $attribute);
    }

    public function button(string $name, string $id = ''): string
    {
        return '<button class="btn btn-primary" id="'. $id .'" type="submit">'. $name .'</button>'.PHP_EOL;

    }
}