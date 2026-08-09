<?php
/**
 * Copyright (c) 2026. Mateable LLC
 */

/** @var array $a_tournaments */
?>
<section class="pt-4 pb-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">Tournament Moderation</h1>
                <p class="text-muted mb-0">Review tournament submissions, event status, and competitive activity.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Tournament queue</h5>
                        <?php if (empty($a_tournaments)): ?>
                            <div class="border rounded p-4 text-muted">
                                No tournaments are waiting for moderation. Tournament submissions will appear here when the event workflow is connected to storage.
                            </div>
                        <?php else: ?>
                            <div class="list-group">
                                <?php foreach ($a_tournaments as $tournament): ?>
                                    <div class="list-group-item">Tournament #<?= htmlspecialchars((string) $tournament->id) ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Moderation tools</h5>
                        <div class="d-grid gap-2">
                            <a href="/tournaments" class="btn btn-outline-primary">Tournament Hub</a>
                            <a href="/leaderboards" class="btn btn-outline-primary">Leaderboards</a>
                            <a href="/admdash" class="btn btn-outline-secondary">Back to Admin Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
