<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\form;

use mateable\core\models\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_HIDDEN = 'hidden';
    public const TYPE_FILE = 'file';
    public const TYPE_DATE = 'date';

    public Model $model;

    public string $attribute;
    public string $type;
    public string $id;
    public string $accept;

    public function __construct(Model $model, string $attribute, string $id = '', string $accept = '')
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
        $this->id = $id;
        $this->accept = $accept;
    }

    public function __toString(): string
    {
       return '
                <div class="form-control" style="width: 420pt;">
                    <label class="form-label">' . $this->model->getLabel($this->attribute) . '</label>
                    <input accept="'. $this->accept .'" class="form-control' . ($this->model->hasError($this->attribute) ? ' is-invalid' : '') . '" id="'. $this->id .'" type="'. $this->type .'" name="'. $this->attribute .'" value="'. $this->model->{$this->attribute} .'">
                    <div class="invalid-feedback">
                        <p id="message_error">' . $this->model->getFirstError($this->attribute) . '</p>
                    </div>
                </div>
       '.PHP_EOL;
    }

    public function dateField(): string
    {
        $this->type = self::TYPE_DATE;
        return $this;
    }

    public function fileField(): string
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }

    public function hiddenField(): string
    {
        $this->type = self::TYPE_HIDDEN;
        return $this;
    }

    public function passwordField(): string
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}
