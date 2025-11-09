<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

/** @var array $feeds */
//$feeds = $feeds ?? [];
?>
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <h2 class="text-uppercase fw-bold">Latest News Feeds</h2>
            <p class="text-muted">Stay updated with the latest stories from trusted sources</p>
        </div>
    </div>

    <?php if (empty($feeds)): ?>
        <div class="row">
            <div class="col text-center">
                <div class="alert alert-info">
                    No news items found at this time. Please try again later.
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($feeds as $item):
                $title = htmlspecialchars($item['title'] ?? 'Untitled');
                $link = htmlspecialchars($item['link'] ?? '#');
                $desc = strip_tags($item['description'] ?? $item['content'] ?? '');
                $desc = htmlspecialchars(mb_strimwidth($desc, 0, 180, '...'));
                $source = htmlspecialchars($item['source'] ?? '');
                $author = htmlspecialchars($item['author'] ?? '');
                $pubDate = $item['pubDate'] ? date('M d, Y', strtotime($item['pubDate'])) : '';
            ?>
            <div class="col">
                <div class="card shadow-sm h-100 border-0 rounded-3">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-2">
                            <a href="<?= $link ?>" class="text-decoration-none text-dark fw-semibold" target="_blank" rel="noopener">
                                <?= $title ?>
                            </a>
                        </h5>
                        <p class="card-text text-muted small mb-2">
                            <?= $desc ?>
                        </p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="small text-secondary">
                                    <span><?= $source ?></span>
                                    <?php if ($author): ?> • <?= $author ?><?php endif; ?>
                                    <?php if ($pubDate): ?> • <?= $pubDate ?><?php endif; ?>
                                </div>
                                <a href="<?= $link ?>" class="btn btn-outline-primary btn-sm" target="_blank" rel="noopener">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
