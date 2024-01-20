<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */
namespace mateable\core\views;

class ViewManager
{
    protected string $title;

    public function __construct()
    {
        $this->title = $_ENV['NAME'];
    }

    public function definitions():array
    {
        return [
            '{{app_name}}' => $this->title,
            '{{age}}' => 18,
            '{{logo}}' => '<img src=\'assets/img/mateable_logo.png\'>'
        ];
    }

    public function convert(string $context): string
    {
        foreach($this->definitions() as $key => $value){
            $context = str_replace($key, $value, $context);
        }
        return $context;
    }
}
