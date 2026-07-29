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
                        <p class="text-info mb-2 fw-semibold">Tournament Hub</p>
                        <h1 class="display-6 fw-bold mb-3">Compete in structured events that test your timing, reflexes, and teamwork.</h1>
                        <p class="text-muted mb-4">
                            The tournaments section now acts as a launch point for upcoming events, recent winners, and your next challenge.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="/creators-streams" class="btn mateable-outline-btn">Meet Creators</a>
                            <a href="/streams" class="btn btn-outline-light">Watch Live Streams</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">Upcoming highlights</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3"><strong>Bracket ready</strong><br><span class="text-muted">Weekly cups with seeded rounds and live spectators.</span></li>
                            <li class="mb-3"><strong>Creator-backed</strong><br><span class="text-muted">Many events are hosted with streamers and community partners.</span></li>
                            <li><strong>Community focused</strong><br><span class="text-muted">Join with friends, earn standings, and rise through the ranks.</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold mb-3">Upcoming tournaments</h4>
                        <div class="d-grid gap-3">
                            <?php foreach (($upcomingTournaments ?? []) as $tournament): ?>
                                <div class="border rounded-3 p-3">
                                    <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                        <div>
                                            <h6 class="mb-1 fw-semibold"><?= htmlspecialchars($tournament['title']) ?></h6>
                                            <div class="text-muted small"><?= htmlspecialchars($tournament['game']) ?></div>
                                        </div>
                                        <span class="badge bg-info-subtle text-info"><?= htmlspecialchars($tournament['slots']) ?></span>
                                    </div>
                                    <div class="text-muted small mb-2"><?= htmlspecialchars($tournament['date']) ?></div>
                                    <div class="text-muted"><?= htmlspecialchars($tournament['description']) ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold mb-3">Recent results</h4>
                        <div class="d-grid gap-3">
                            <?php foreach (($recentResults ?? []) as $result): ?>
                                <div class="border rounded-3 p-3">
                                    <div class="fw-semibold"><?= htmlspecialchars($result['name']) ?></div>
                                    <div class="text-muted small"><?= htmlspecialchars($result['result']) ?></div>
                                    <div class="text-muted small"><?= htmlspecialchars($result['game']) ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

