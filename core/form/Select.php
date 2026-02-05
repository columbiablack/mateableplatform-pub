<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\form;

class Select
{
    public string $objectName = '';
    public string $objectID = '';

    public static function begin(string $objectName, string $objectID): Select
    {
        echo '
            <select name="'. $objectName .'" id="'. $objectID .'">
            ';

        return new Select();
    }

    public static function end(): string
    {
        return '
            </select>
        ';
    }

    public function addOption(string $name, string $value): void
    {
        echo '<option value="'.$value.'">'.$name.'</option>. PHP_EOL';
    }

}