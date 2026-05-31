<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\form;

class Select
{
    public static function model(object $model, string $attribute, array $options, string $id = ''): void
    {
        $value = $model->$attribute ?? '';

        $idAttribute = $id ? ' id="' . htmlspecialchars($id) . '"' : '';

        echo '<select name="' . htmlspecialchars($attribute) . '"' . $idAttribute . '>';

        foreach ($options as $optionValue => $label) {
            $selected = ($optionValue == $value) ? ' selected' : '';

            echo '<option value="' . htmlspecialchars($optionValue) . '"' . $selected . '>'
                . htmlspecialchars($label)
                . '</option>';
        }

        echo '</select>';
    }
}
