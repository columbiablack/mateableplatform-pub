<?php

/**
 * Copyright (c) 2025-2026. Mateable LLC
 */

/**
 * user: Mateable
 * @var $contentModel mateable\core\models\VidGigglesModel
 * @var $page
 * @var $totalPages
 * @var $search
 */

use mateable\core\controllers\VidGigglesController;
use mateable\core\Platform;

$vidID = $_GET['video_id'];
$user_rating = 0;
$url='';
?>
    <section>
        <div class="container">
            <div class="row">
                <div class="block-heading">
                    <h2 class="h2 mb-4 text-info" style="text-align: center;">Videos</h2>
                </div>
                <div class="alert alert-info" style="text-align: center;">Powered by VidGiggles™ Engine.</div>
            </div>
            <div class="pagination alert alert-link">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">&laquo; Prev</a>
                <?php endif; ?>
                &nbsp;
                <span>| Page <?= $page ?> of <?= $totalPages ?> Pages |</span>
                &nbsp;
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="container container-fluid">
            <div class="row">
                <div class="content">
                    <?php if (!empty($vidGigglesList)): ?>
                        <?php foreach ($vidGigglesList as $contentModel): ?>
                            <div class="col block">
                                <div class="video-card h-100">
                                    <a href="videos?video_id=<?= $contentModel->getVideoId() ?>" class="text-decoration-none">
                                        <img src="<?= $contentModel->getThumbnail() ?>"
                                             class="w-100 video-thumbnail rounded-2"
                                             alt="<?= $contentModel->getTitle() ?>"
                                             loading="lazy">
                                        <div class="card-body">
                                            <h4 class="h6 video-title"><?= $contentModel->getTitle() ?></h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info"><p>No videos found in this category. Please try another one!</p></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
