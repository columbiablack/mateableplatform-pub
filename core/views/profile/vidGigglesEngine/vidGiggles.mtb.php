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
    <?php if(!isset($vidID)): ?>
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
    <?php else: ?>
    <section class="clean-block dark">
        <div class="container col col-md-9 g-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Video Player -->
                    <div class="ratio ratio-16x9 mb-4">
                        <iframe src="https://www.youtube.com/embed/<?= $vidID ?>" allowfullscreen class="rounded" loading="lazy"></iframe>
                    </div>
                    <!-- Video Metadata -->
                    <h1 class="h3 mb-3">Why <?= $contentModel->getTitle() ?></h1>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-1">
                                <i class="bi bi-eye-fill text-primary"></i>
                                <?= number_format($contentModel->getViews()) ?> views
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-clock-fill text-primary"></i>
                                <?= date("M j, Y", strtotime($contentModel->getAddedOn())) ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1">
                                <i class="bi bi-tag-fill text-primary"></i>
                                <?= htmlspecialchars($contentModel->getCategory()) ?>
                            </p>
                        </div>
                    </div>
                    <div class="rating-section mb-4">
                        <div class="star-rating" id="starRating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio"
                                       id="star<?= $i ?>"
                                       name="rating"
                                       value="<?= $i ?>"
                                       style="display: none;"> <!-- Ensures it's hidden -->
                                <label for="star<?= $i ?>"
                                       class="star-label <?= $user_rating ? 'rated' : '' ?>"
                                       data-value="<?= $i ?>">
                                    <i class="bi bi-star-fill"></i>
                                </label>
                            <?php endfor; ?>
                            <div class="rating-text">
                                <span class="current-rating">
                                    <?= number_format($contentModel->average_rating(), 1) ?>/5
                                    (<?= $contentModel->getTotalVotes() ?> ratings)
                                </span>
                                <div id="ratingMessage" class="text-danger small mt-1"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <?php if (!empty($contentModel->getDescription())): ?>
                        <div class="mb-4">
                            <h4 class="h5">Description</h4>
                            <p class="text-muted"><?= nl2br(htmlspecialchars($contentModel->getDescription())) ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Floating Share Button -->
                <button class="btn btn-primary rounded-circle shadow"
                        onclick="openShareModal()"
                        style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
                    <i class="bi bi-share-fill"></i>
                </button>
                <!-- Share Modal -->
                <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-4">
                            <h5 class="mb-3">Share this video</h5>
                            <div class="d-flex flex-wrap gap-3 justify-content-center">
                                <!-- Icons are just links -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url ?>" target="_blank"
                                   class="btn btn-outline-primary">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= $url ?>&text=<?= urlencode($contentModel->getTitle()) ?>"
                                   target="_blank" class="btn btn-outline-info">
                                    <i class="bi bi-twitter-x"></i> X
                                </a>
                                <a href="https://api.whatsapp.com/send?text=<?= urlencode($contentModel->getTitle() . ' ' . $url) ?>"
                                   target="_blank" class="btn btn-outline-success">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                                <a href="https://www.reddit.com/submit?url=<?= $url ?>&title=<?= urlencode($contentModel->getTitle()) ?>"
                                   target="_blank" class="btn btn-outline-danger">
                                    <i class="bi bi-reddit"></i> Reddit
                                </a>
                                <button class="btn btn-outline-secondary" onclick="copyVideoLink()">
                                    <i class="bi bi-clipboard"></i> Copy Link
                                </button>
                            </div>
                            <div id="copyMsg" class="text-success mt-2 d-none">Link copied!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
