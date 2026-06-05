<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

namespace mateable\core\form;

class Button
{
    protected string $label;
    protected string $type = 'submit';
    protected array $attributes = [];

    public function __construct(string $label)
    {
        $this->label = $label;
    }

    /*
     |----------------------------------------
     | Static Factory (cleaner syntax)
     |----------------------------------------
     */
    public static function make(string $label): self
    {
        return new self($label);
    }

    /*
     |----------------------------------------
     | Core Setters (Fluent)
     |----------------------------------------
     */
    public function type(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function name(string $name): self
    {
        $this->attributes['name'] = $name;
        return $this;
    }

    public function value(string $value): self
    {
        $this->attributes['value'] = $value;
        return $this;
    }

    public function id(string $id): self
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function class(string $class): self
    {
        $this->attributes['class'] =
            ($this->attributes['class'] ?? '') . ' ' . $class;
        return $this;
    }

    public function onclick(string $script): self
    {
        $this->attributes['onclick'] = $script;
        return $this;
    }

    public function formaction(string $url): self
    {
        $this->attributes['formaction'] = $url;
        return $this;
    }

    public function formmethod(string $method): self
    {
        $this->attributes['formmethod'] = $method;
        return $this;
    }

    /*
     |----------------------------------------
     | Generic Attribute Setter
     |----------------------------------------
     */
    public function attr(string $key, string $value): self
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /*
     |----------------------------------------
     | Render
     |----------------------------------------
     */
    public function __toString(): string
    {
        $attributes = '';

        foreach ($this->attributes as $key => $value) {
            $attributes .= sprintf(
                ' %s="%s"',
                htmlspecialchars($key, ENT_QUOTES, 'UTF-8'),
                htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8')
            );
        }

        return sprintf(
            '<button type="%s"%s>%s</button>%s',
            htmlspecialchars($this->type, ENT_QUOTES, 'UTF-8'),
            $attributes,
            htmlspecialchars($this->label, ENT_QUOTES, 'UTF-8'),
            PHP_EOL
        );
    }
}