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

    public function __construct(Model $model, string $attribute)
    {
        $this->attribute = $attribute;
        $this->model = $model;
    }

    public function __toString(): string
    {
      return '
                <div class="mb-3">
                    <label class="form-label">' . $this->model->getLabel($this->attribute) . '</label>
                    <textarea class="form-control' . ($this->model->hasError($this->attribute) ? ' is-invalid' : '') . '" name="' . $this->attribute . '" id="' . $this->attribute . '" value="' . $this->model->{$this->attribute} . '"></textarea>
                    <div class="invalid-feedback">
                        <p>' . $this->model->getFirstError($this->attribute) . '</p>
                    </div>
                </div>
              '.PHP_EOL;
    }
}