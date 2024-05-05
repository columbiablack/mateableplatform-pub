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
    }

    public function definitions():array
    {
        $Website = $_ENV['WEBSITE'];
        return [
            '{{app_name}}' => $this->title,
            '{{site_url}}' => $Website,
            '{{small_logo}}' => '<img style="height:30pt;width:30pt;" src=\'assets/img/mateable_logo.png\'>',
            '{{logo}}' => '<img src=\'assets/img/mateable_logo.png\'>',
            '{{age}}' => 18,
            '{{MTBC_BALANCE}}' => 'Market(MTBC): '. Platform::$app->xeggeX->getMarketValue(),
        ] + self::$definitionsExtra;
    }

    public function convert(string $context): string
    {
        foreach($this->definitions() as $key => $value){
            $context = str_replace($key, $value, $context);
        }

        return $context;
    }
}
