<?php
/**
 * Copyright (c) 2026. Mateable LLC
 */

/** @var string $systemStatus */
?>
<section class="pt-4 pb-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">Platform Settings</h1>
                <p class="text-muted mb-0">Review the current platform configuration and administrative tools.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">System status</h5>
                        <div class="d-flex justify-content-between align-items-center border rounded p-3">
                            <span>Application availability</span>
                            <span class="badge bg-success"><?= htmlspecialchars($systemStatus ?? 'Operational') ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border rounded p-3 mt-3">
                            <span>Administrative access</span>
                            <span class="badge bg-info">Protected</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Admin shortcuts</h5>
                        <div class="d-grid gap-2">
                            <a href="/admdash" class="btn btn-outline-primary">Dashboard</a>
                            <a href="/admdash/usrmgmt" class="btn btn-outline-primary">Manage Users</a>
                            <a href="/admdash/moderation" class="btn btn-outline-primary">Moderation Queue</a>
                            <a href="/admdash/newsmgmt" class="btn btn-outline-primary">Manage News</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
