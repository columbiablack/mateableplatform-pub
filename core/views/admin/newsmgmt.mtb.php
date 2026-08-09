<?php
/**
 * Copyright (c) 2026. Mateable LLC
 */

/** @var array $newsPosts */
/** @var \mateable\core\models\NewsPostModel|null $newsPost */
?>
<section class="pt-4 pb-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">News Management</h1>
                <p class="text-muted mb-0">Manage platform announcements and community news.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Create News Post</h5>
                        <form action="/admdash/newsmgmt/create" method="post">
                            <div class="mb-3">
                                <label for="content" class="form-label">Announcement</label>
                                <textarea id="content" name="content" class="form-control" rows="8" required minlength="3" maxlength="10000" placeholder="Write the announcement for the community..."><?= htmlspecialchars(isset($newsPost) ? $newsPost->content : '') ?></textarea>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Publish News</button>
                                <a href="/admdash" class="btn btn-outline-secondary">Back to Administration</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-semibold mb-0">Published news</h5>
                            <span class="badge bg-info-subtle text-info"><?= count($newsPosts ?? []) ?> posts</span>
                        </div>
                <?php if (empty($newsPosts)): ?>
                    <div class="border rounded p-4 text-muted">
                        No news posts are available yet.
                    </div>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($newsPosts as $newsPost): ?>
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start gap-3">
                                    <div>
                                        <div class="small text-muted mb-1"><?= htmlspecialchars($newsPost->postDate()) ?></div>
                                        <div class="text-break"><?= nl2br(htmlspecialchars($newsPost->postContent())) ?></div>
                                    </div>
                                    <form action="/admdash/newsmgmt/delete" method="post" onsubmit="return confirm('Delete this news post?');">
                                        <input type="hidden" name="id" value="<?= (int) $newsPost->id ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
