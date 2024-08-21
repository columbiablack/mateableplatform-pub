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

    public function field(Model $model, string $attribute, string $id = '', string $accept = ''): Field
    {
        return new Field($model, $attribute, $id, $accept);
    }

    public function fieldTextArea(Model $model, string $attribute, string $style = '')
    {
        return new TextArea($model, $attribute, $style);
    }

    public function fieldSelect(string $name, string $id)
    {
        return new Select($name, $id);
    }

    public function fieldOption(string $name, string $id)
    {
        return new Select($name, $id);
    }

    public function button(string $name, string $id = '', string $class = '', string $onclick = ''): string
    {
        return '<button class="btn btn-primary '.$class.'" id="'. $id .'" onclick="'. $onclick .'" type="submit">'. $name .'</button>'.PHP_EOL;
    }
}