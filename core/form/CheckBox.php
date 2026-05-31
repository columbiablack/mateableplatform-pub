<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\form;

class CheckBox
{
    private string $name;
    private string $id;
    private string $value;
    private bool $checked;

    public function __construct(
        string $name,
        string $id,
        string $value = '',
        bool $checked = false
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->checked = $checked;
    }

    public function __toString(): string
    {
        $checkedAttribute = $this->checked ? ' checked' : '';

        return sprintf(
            '<input type="checkbox" id="%s" name="%s" value="%s"%s>
             <label for="%s">%s</label>%s',
            htmlspecialchars($this->id, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($this->value, ENT_QUOTES, 'UTF-8'),
            $checkedAttribute,
            htmlspecialchars($this->id, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($this->value, ENT_QUOTES, 'UTF-8'),
            PHP_EOL
        );
    }
}