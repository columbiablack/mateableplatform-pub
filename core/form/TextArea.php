<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\form;

use mateable\core\models\Model;

class TextArea
{
    public Model $model;

    public string $attribute;
    public string $style;

    public function __construct(Model $model, string $attribute, string $style)
    {
        $this->attribute = $attribute;
        $this->model = $model;
        $this->style = $style;
    }

    public function __toString(): string
    {
      return '
                <label class="form-label">' . $this->model->getLabel($this->attribute) . '</label>
                <textarea class="form-control ' . ($this->model->hasError($this->attribute) ? ' is-invalid' : '') . '" id="' . $this->attribute . '" style="'. $this->style .'" value="'. $this->model->{$this->attribute} .'"></textarea>
                <div class="invalid-feedback">
                    <p>' . $this->model->getFirstError($this->attribute) . '</p>
                </div>
              '.PHP_EOL;
    }
}