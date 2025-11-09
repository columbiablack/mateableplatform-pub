<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

namespace mateable\core\services;

use SimpleXMLElement;

class RssService
{
    private int $cacheTtl; // seconds
    private string $cacheDir;
    private string $userAgent;

    public function __construct(int $cacheTtl = 300, string $cacheDir = __DIR__ . '/storage/cache/rss', string $userAgent = 'Mateable RSS Bot/1.0 (+https://mateablemedia.com)')
    {
        $this->cacheTtl = $cacheTtl;
        $this->cacheDir = rtrim($cacheDir, '/');
        $this->userAgent = $userAgent;

        if (!is_dir($this->cacheDir)) {
            if (!@mkdir($this->cacheDir, 0755, true) && !is_dir($this->cacheDir)) {
                error_log("[RssService] Failed to create cache dir: {$this->cacheDir}");
            }
        }
    }

    public function fetch(string $url): array
    {
        try {
            $cached = $this->getCache($url);
            if (is_array($cached)) {
                return $cached;
            }

            $raw = $this->fetchRaw($url);
            if ($raw === false) {
                return [];
            }

            $items = $this->parseXmlToItems($raw, $url);

            if (!empty($items)) {
                $this->setCache($url, $items);
            }

            return $items;
        } catch (\Throwable $e) {
            error_log("[RssService::fetch] {$e->getMessage()}");
            return [];
        }
    }

    public function fetchMany(array $urls, ?int $limit = null, bool $sortByDate = true, bool $dedupe = true): array
    {
        $all = [];
        foreach ($urls as $u) {
            $feedItems = $this->fetch($u);
            foreach ($feedItems as $it) {
                // ensure 'source' present
                if (!isset($it['source']) || empty($it['source'])) {
                    $it['source'] = parse_url($u, PHP_URL_HOST) ?: $u;
                }
                $all[] = $it;
            }
        }

        if ($dedupe) {
            $all = $this->dedupeByLink($all);
        }

        if ($sortByDate) {
            usort($all, function ($a, $b) {
                $ta = isset($a['pubDate']) ? strtotime($a['pubDate']) : 0;
                $tb = isset($b['pubDate']) ? strtotime($b['pubDate']) : 0;
                return $tb <=> $ta;
            });
        }

        if ($limit !== null && $limit > 0) {
            $all = array_slice($all, 0, $limit);
        }

        return $all;
    }

    /* ----------------------- internals ----------------------- */

    private function fetchRaw(string $url)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_USERAGENT => $this->userAgent,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $data = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if ($data === false || $code >= 400) {
            error_log("[RssService::fetchRaw] URL: {$url} HTTP: {$code} ERR: {$err}");
            return false;
        }

        return $data;
    }

    private function parseXmlToItems(string $xmlStr, string $sourceUrl): array
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($xml === false) {
            $errs = libxml_get_errors();
            libxml_clear_errors();
            error_log("[RssService::parseXmlToItems] XML parse failed for $sourceUrl");
            return [];
        }

        $namespaces = $xml->getNamespaces(true);
        $items = [];

        // RSS 2.0
        if (isset($xml->channel) && isset($xml->channel->item)) {
            foreach ($xml->channel->item as $item) {
                $items[] = $this->normalizeRssItem($item, $namespaces, $sourceUrl);
            }
            return $items;
        }

        // Atom
        if (isset($xml->entry)) {
            foreach ($xml->entry as $entry) {
                $items[] = $this->normalizeAtomEntry($entry, $namespaces, $sourceUrl);
            }
            return $items;
        }

        // Fallback using XPath searching for item-like nodes
        $nodes = $xml->xpath('//item') ?: $xml->xpath('//entry') ?: [];
        foreach ($nodes as $node) {
            $items[] = $this->normalizeGeneric($node, $namespaces, $sourceUrl);
        }

        return $items;
    }

    private function normalizeRssItem(SimpleXMLElement $item, $namespaces, string $source)
    {
        $title = (string)($item->title ?? '');
        $link = (string)($item->link ?? '');
        if (empty($link) && isset($item->guid)) $link = (string)$item->guid;
        $description = (string)($item->description ?? '');
        $content = '';
        if (isset($namespaces['content'])) {
            $c = $item->children($namespaces['content']);
            $content = (string)($c->encoded ?? '');
        }
        $content = $content !== '' ? $content : $description;
        $author = (string)($item->author ?? $item->creator ?? '');
        $pubDate = (string)($item->pubDate ?? $item->date ?? '');

        return [
            'title' => trim($title),
            'link' => trim($link),
            'description' => trim($description),
            'content' => trim($content),
            'pubDate' => $pubDate,
            'author' => trim($author),
            'source' => $source,
        ];
    }

    private function normalizeAtomEntry(SimpleXMLElement $entry, $namespaces, string $source)
    {
        $title = (string)($entry->title ?? '');
        $link = '';
        if (isset($entry->link)) {
            foreach ($entry->link as $l) {
                $attrs = $l->attributes();
                if (isset($attrs['rel']) && (string)$attrs['rel'] === 'alternate' && isset($attrs['href'])) {
                    $link = (string)$attrs['href'];
                    break;
                }
                if (isset($attrs['href'])) $link = (string)$attrs['href'];
            }
        }
        $summary = (string)($entry->summary ?? '');
        $content = (string)($entry->content ?? $summary);
        $author = '';
        if (isset($entry->author)) {
            $author = (string)($entry->author->name ?? $entry->author);
        }
        $pubDate = (string)($entry->updated ?? $entry->published ?? '');

        return [
            'title' => trim($title),
            'link' => trim($link),
            'description' => trim($summary),
            'content' => trim($content),
            'pubDate' => $pubDate,
            'author' => trim($author),
            'source' => $source,
        ];
    }

    private function normalizeGeneric(SimpleXMLElement $node, $namespaces, string $source)
    {
        $title = (string)($node->title ?? '');
        $link = (string)($node->link ?? '');
        if (is_object($link)) {
            // link as object with attributes
            $attrs = $link->attributes();
            $link = isset($attrs['href']) ? (string)$attrs['href'] : '';
        }
        $description = (string)($node->description ?? '');
        $pubDate = (string)($node->pubDate ?? $node->updated ?? '');
        return [
            'title' => trim($title),
            'link' => trim($link),
            'description' => trim($description),
            'content' => '',
            'pubDate' => $pubDate,
            'author' => '',
            'source' => $source,
        ];
    }

    private function cacheFileName(string $url): string
    {
        return $this->cacheDir . '/rss_' . md5($url) . '.json';
    }

    private function getCache(string $url): ?array
    {
        $file = $this->cacheFileName($url);
        if (!is_file($file)) return null;

        $mtime = @filemtime($file);
        if ($mtime === false) return null;

        if ((time() - $mtime) > $this->cacheTtl) {
            @unlink($file);
            return null;
        }

        $json = @file_get_contents($file);
        if ($json === false) return null;

        $data = json_decode($json, true);
        if (!is_array($data)) {
            // corrupt cache, delete it
            @unlink($file);
            return null;
        }

        return $data;
    }

    private function setCache(string $url, array $items): void
    {
        $file = $this->cacheFileName($url);
        $tmp = $file . '.tmp';
        $json = json_encode($items, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            error_log("[RssService::setCache] json_encode failed for $url");
            return;
        }
        if (@file_put_contents($tmp, $json, LOCK_EX) === false) {
            error_log("[RssService::setCache] failed to write cache file $tmp");
            return;
        }
        @rename($tmp, $file);
    }

    private function dedupeByLink(array $items): array
    {
        $seen = [];
        $out = [];
        foreach ($items as $it) {
            $key = $it['link'] ?? '';
            if (empty($key)) {
                // fallback to title+pubDate
                $key = ($it['title'] ?? '') . '|' . ($it['pubDate'] ?? '');
            }
            if (isset($seen[$key])) continue;
            $seen[$key] = true;
            $out[] = $it;
        }
        return $out;
    }
}
