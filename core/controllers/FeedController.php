<?php

/**
 * Copyright (c) 2025-2026. Mateable LLC
 */

namespace mateable\core\controllers;

use mateable\core\middlewares\AuthMiddleware;
use mateable\core\models\feeds\FeedModel;
use mateable\core\routes\Routes;
use mateable\core\services\RssService;

class FeedController extends Controller
{
    private FeedModel $model;

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(Routes::authAllowedRoutes()));
        $service = new RssService(600);
        $this->model = new FeedModel($service);
    }

    public function getFeedIndex(array $params = []): string
    {
        $feeds = $params['feeds'] ?? [
            'https://rss.app/feeds/7cS4GNAuDkqNSeWh.xml',
            'https://rss.cnn.com/rss/edition.rss',
            'https://feeds.bbci.co.uk/news/rss.xml'
        ];

        $limit = $params['limit'] ?? 25;
        $items = $this->model->getFeeds($feeds, $limit);

        return $this->renderView('profile/feeds/list', ['feeds' => $items]);
    }

    public function api(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $urls = $_GET['feeds'] ?? null;
        if ($urls && is_string($urls)) {
            $urls = array_map('trim', explode(',', $urls));
        }
        if (!is_array($urls) || empty($urls)) {
            $urls = [
                'https://rss.cnn.com/rss/edition.rss',
                'https://feeds.bbci.co.uk/news/rss.xml'
            ];
        }

        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 50;
        $items = $this->model->getFeeds($urls, $limit);
        echo json_encode(['count' => count($items), 'items' => $items], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
