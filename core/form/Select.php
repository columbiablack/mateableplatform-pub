<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\form;

class Select
{
    public function __construct(string $name, string $id)
    {
        self::begin($name, $id);
    }

    public static function begin(string $name, string $id): Select
    {
        echo '<select name="'.$name.'" id="'.$id.'">';
        return new Select();
    }

    public static function end(): void
    {
        echo '</select>';
    }

    public static function addOption(string $name, string $value): void
    {
        echo '<option value="'.$value.'">'.$name.'</option>';
    }
}