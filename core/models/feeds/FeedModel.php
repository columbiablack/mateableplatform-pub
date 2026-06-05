<?php

/**
 * Copyright (c) 2025-2026. Mateable LLC
 */

namespace mateable\core\models\feeds;

use mateable\core\services\RssService;

class FeedModel
{
    private RssService $service;

    public function __construct(RssService $service = null)
    {
        $this->service = $service ?? new RssService();
    }

    /**
     * Return array of items for a single feeds
     */
    public function getFeed(string $url): array
    {
        return $this->service->fetch($url);
    }

    /**
     * Return merged array of items for many feeds (normalized)
     */
    public function getFeeds(array $urls, int $limit = 100): array
    {
        return $this->service->fetchMany($urls, $limit, true);
    }
}
