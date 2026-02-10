<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */
namespace mateable\core\views;

use mateable\core\Platform;

class ViewManager
{
    private string $title;

    public static array $definitionsExtra = [];

    public function __construct()
    {
        $this->title = $_ENV['NAME'];
        // Load extra definitions
    }

    public function definitions(): array
    {
        $Website = $_ENV['WEBSITE'];
        return [
            '{{app_name}}' => $_ENV['NAME'],
            '{{site_url}}' => $Website,
            '{{small_logo}}' => '<img style="height:30pt;width:30pt;" src=\'assets/img/mateable_logo.png\'>',
            '{{logo}}' => '<img src=\'assets/img/mateable_logo.png\'>',
            '{{age}}' => 18,
            '{{news_posts}}' => '** Working on news **',
        ] + self::$definitionsExtra;
    }

    public function convert(string $context): string
    {
        foreach($this->definitions() as $key => $value){
            $context = str_replace($key, $value, $context);
        }
        return ($context);
    }

    public function emoji(string $context):string
    {
        return "";
    }
}
