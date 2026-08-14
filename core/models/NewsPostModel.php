<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\models;

class NewsPostModel extends DB
{
    public int $id;
    public int $user_id = 0;
    public string $content = '';
    public string $post_date = '';

    public static function tableName(): string
    {
        return 'news_posts';
    }

    public function attributes(): array

    {
        return [
            'post_date',
            'content',
            'user_id',
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'content' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 10000]],
        ];
    }

    public function labels() : array
    {
        return [
            'content' => 'Message',
            'post_date' => 'Date'
        ];
    }

    public function postContent(): string
    {
        return $this->content;
    }

    public function postUserID(): int
    {
        return $this->user_id;
    }

    public function postDate(): string
    {
        return $this->post_date;
    }

    public static function renderContent(string $content): string
    {
        // Aggressively decode entities (handle double-encoded like &amp;#13;) up to a few passes
        $decodedContent = $content;
        for ($i = 0; $i < 3; $i++) {
            $new = html_entity_decode($decodedContent, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if ($new === $decodedContent) {
                break;
            }
            $decodedContent = $new;
        }

        // Replace any remaining numeric CR/LF entities or ampersand-encoded variants with newline
        $decodedContent = str_replace(['&#13;', '&#10;', '&amp;#13;', '&amp;#10;'], "\n", $decodedContent);

        // Normalize line endings so CRLF/CR become LF
        $decodedContent = str_replace(["\r\n", "\r"], "\n", $decodedContent);
        $links = [];

        // Convert Markdown links [label](url) into tokens
        $decodedContent = preg_replace_callback(
            '/\[([^\]]+)\]\(([^)]+)\)/u',
            static function (array $m) use (&$links): string {
                $label = trim($m[1]);
                $href = trim($m[2]);
                $href = html_entity_decode($href, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $scheme = strtolower((string) parse_url($href, PHP_URL_SCHEME));

                if (!in_array($scheme, ['http', 'https'], true) || $label === '') {
                    return $label;
                }

                $token = '__MATEABLE_SAFE_LINK_' . count($links) . '__';
                $links[$token] = '<a href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8')
                    . '" target="_blank" rel="noopener noreferrer">'
                    . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</a>';

                return $token;
            },
            $decodedContent
        ) ?? $decodedContent;

        // Convert explicit <a> anchors into tokens as well
        $contentWithTokens = preg_replace_callback(
            '/<a\b[^>]*\bhref\s*=\s*(["\'])(.*?)\1[^>]*>(.*?)<\/a>/isu',
            static function (array $matches) use (&$links): string {
                $href = html_entity_decode(trim($matches[2]), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $scheme = strtolower((string) parse_url($href, PHP_URL_SCHEME));
                $label = trim(strip_tags($matches[3]));

                if (!in_array($scheme, ['http', 'https'], true) || $label === '') {
                    return $label;
                }

                $token = '__MATEABLE_SAFE_LINK_' . count($links) . '__';
                $links[$token] = '<a href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8')
                    . '" target="_blank" rel="noopener noreferrer">'
                    . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</a>';

                return $token;
            },
            $decodedContent
        ) ?? $decodedContent;

        // Autolink plain URLs (http/https)
        $contentWithTokens = preg_replace_callback(
            '/\bhttps?:\/\/[^\s<]+/i',
            static function (array $m) use (&$links): string {
                $href = $m[0];
                $token = '__MATEABLE_SAFE_LINK_' . count($links) . '__';
                $links[$token] = '<a href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8')
                    . '" target="_blank" rel="noopener noreferrer">'
                    . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '</a>';
                return $token;
            },
            $contentWithTokens
        ) ?? $contentWithTokens;

        // Collapse multiple consecutive newlines to a single newline (avoid double <br>)
        $contentWithTokens = preg_replace('/\n{2,}/', "\n", $contentWithTokens);

        // Escape remaining content and convert newlines to <br>
        $safeContent = nl2br(htmlspecialchars($contentWithTokens, ENT_QUOTES, 'UTF-8'));

        // Restore safe links
        return str_replace(array_keys($links), array_values($links), $safeContent);
    }
}