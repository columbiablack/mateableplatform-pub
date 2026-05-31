<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
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

    public string $attribute = '';
    public string $type = '';
    public string $id = '';
    public string $accept = '';
    public string $style = '';
    public string $placeHolder = '';

    public function __construct(Model $model, string $attribute, string $id = '', string $accept = '', string $style = '', string $placeHolder = '')
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
        $this->id = $id ?? '';
        $this->accept = $accept ?? '';
        $this->style = $style ?? '';
        $this->placeHolder = $placeHolder ?? '';
    }

    public function __toString(): string
    {
        if(!$this->placeHolder){
           return '
                    <label for="'. $this->id .'">' . $this->model->getLabel($this->attribute) . '</label>
                    <input accept="'. $this->accept .'" style="'.  ($this->style) .'" class="form-control' . ($this->model->hasError($this->attribute) ? ' is-invalid' : '') . '" id="'. $this->id .'" type="'. $this->type .'" name="'. $this->attribute .'" value="'. $this->model->{$this->attribute} .'">
                    <div class="invalid-feedback">
                        <p id="message_error">' . $this->model->getFirstError($this->attribute) . '</p>
                    </div>
           '.PHP_EOL;
        }else{
           return '
                    <input accept="'. $this->accept .'" style="'.  ($this->style) .'" placeholder="'. ($this->placeHolder) .'" class="form-control' . ($this->model->hasError($this->attribute) ? ' is-invalid' : '') . '" id="'. $this->id .'" type="'. $this->type .'" name="'. $this->attribute .'" value="'. $this->model->{$this->attribute} .'">
                    <div class="invalid-feedback">
                        <p id="message_error">' . $this->model->getFirstError($this->attribute) . '</p>
                    </div>
           '.PHP_EOL;
        }
    }

    public function dateField(): Field
    {
        $this->type = self::TYPE_DATE;
        return $this;
    }

    public function fileField(): Field
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }

    public function hiddenField(): Field
    {
        $this->type = self::TYPE_HIDDEN;
        return $this;
    }

    public function passwordField(): Field
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}
