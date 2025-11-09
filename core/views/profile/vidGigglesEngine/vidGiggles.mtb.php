<?php

/**
 * Copyright (c) 2025. Mateable LLC
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
    <section class="clean-block dark">
        <div class="container col col-md-7 g-4">
            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <h2 class="h2 mb-4">Videos</h2>
                </div>
                <div class="alert alert-info">Powered by VidGiggles™ Engine.</div>
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
        <div class="container col col-md-4 g-4">
            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-1 g-4">
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
