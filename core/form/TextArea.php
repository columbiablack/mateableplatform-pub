<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\form;

use mateable\core\models\Model;

class TextArea
{
    protected array $attributes = [];
    private Model $model;
    private string $placeholder;

    public function __construct(string $placeholder)
    {
        $this->placeholder = $placeholder;
    }

    public static function make(string $placeholder):self
    {
        return new self($placeholder);
    }

    public function model(Model $model): self
    {
        $this->attributes['model'] = $model;
        return $this;
    }

    public function class(string $class): self
    {
        $this->attributes['class'] = $class;
        return $this;
    }

    public function name(string $name): self
    {
        $this->attributes['name'] = $name;
        return $this;
    }

    public function placeholder(string $text): self
    {
        $this->attributes['placeholer'] = $text;
        return $this;
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