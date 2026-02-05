<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

namespace mateable\core\form;

class CheckBox
{
    private string $objectName = '';
    private string $objectID = '';
    private string $objectValue = '';
    private bool $checked = false;

    public function __construct(string $name, string $id, string $value)
    {
        $this->objectID = $id;
        $this->objectName = $name;
        $this->objectValue = $value;
    }

    public function __toString(): string
    {
        return '
                <input type="checkbox" id="'.$this->objectID.'" name="'.$this->objectName.'" checked>
                <label for="'.$this->objectID.'">'.$this->objectValue.'</label>
        '.PHP_EOL;
    }
}