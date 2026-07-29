<?php
/**
 * Copyright (c) 2026. Mateable LLC
 */
?>
<section class="py-5">
    <div class="container py-4">
        <div class="row g-4 align-items-start">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, rgba(8,16,32,0.95), rgba(17,29,49,0.95));">
                    <div class="card-body p-4 p-lg-5">
                        <p class="text-info mb-2 fw-semibold">Creators & Streams</p>
                        <h1 class="display-6 fw-bold mb-3">Build your audience, host your events, and grow a loyal community.</h1>
                        <p class="text-muted mb-4">
                            Creators can spotlight gameplay, run tournaments, and engage fans through live streams that feel built for competition and discovery.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="/tournaments" class="btn mateable-outline-btn">See Tournaments</a>
                            <a href="/streams" class="btn btn-outline-light">Browse Live Streams</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">This week’s focus</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3"><strong>Live sessions</strong><br><span class="text-muted">Daily broadcasts with interactive chat and event reminders.</span></li>
                            <li class="mb-3"><strong>Creator tools</strong><br><span class="text-muted">Promote your community, spotlight highlights, and launch events quickly.</span></li>
                            <li><strong>Fan engagement</strong><br><span class="text-muted">Turn viewers into participants with challenge ladders and tournament invites.</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold mb-3">Featured creators</h4>
                        <div class="list-group list-group-flush">
                            <?php foreach (($featuredCreators ?? []) as $creator): ?>
                                <div class="list-group-item px-0 py-3">
                                    <div class="d-flex justify-content-between align-items-start gap-3">
                                        <div>
                                            <h6 class="mb-1 fw-semibold"><?= htmlspecialchars($creator['name']) ?></h6>
                                            <div class="text-muted small"><?= htmlspecialchars($creator['focus']) ?></div>
                                        </div>
                                        <span class="badge bg-info-subtle text-info"><?= htmlspecialchars($creator['followers']) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold mb-3">Live now</h4>
                        <div class="d-grid gap-3">
                            <?php foreach (($liveStreams ?? []) as $stream): ?>
                                <div class="border rounded-3 p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong><?= htmlspecialchars($stream['title']) ?></strong>
                                        <span class="badge bg-danger-subtle text-danger">Live</span>
                                    </div>
                                    <div class="text-muted small">Host: <?= htmlspecialchars($stream['host']) ?></div>
                                    <div class="text-muted small">Game: <?= htmlspecialchars($stream['game']) ?></div>
                                    <div class="text-muted small"><?= htmlspecialchars($stream['viewers']) ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
