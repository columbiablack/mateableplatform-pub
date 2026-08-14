<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */
namespace mateable\core\views;

use mateable\core\models\NewsPostModel;
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
            '{{small_logo}}' => '<img alt="" style="height:30pt;width:30pt;" src=\'assets/img/mateable_logo.png\'>',
            '{{logo}}' => '<img alt="" src=\'assets/img/mateable_logo.png\'>',
            '{{age}}' => 18,
            '{{news_posts}}' => $this->renderNewsPosts(),
        ] + self::$definitionsExtra;
    }

    private function renderNewsPosts(): string
    {
        try {
            $newsPosts = NewsPostModel::findAll([], 'post_date DESC', 10);
        } catch (\Throwable) {
            return '<p class="text-muted mb-0">News is temporarily unavailable.</p>';
        }

        if (empty($newsPosts)) {
            return '<p class="text-muted mb-0">No news posts have been published yet.</p>';
        }

        $markup = '<div class="d-grid gap-3">';

        foreach ($newsPosts as $newsPost) {
            $date = htmlspecialchars($newsPost->postDate(), ENT_QUOTES, 'UTF-8');
            $content = NewsPostModel::renderContent($newsPost->postContent());

            $markup .= '<article class="border rounded-3 p-3">'
                . '<div class="small text-muted mb-2">' . $date . '</div>'
                . '<div class="text-break">' . $content . '</div>'
                . '</article>';
        }

        return $markup . '</div>';
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
