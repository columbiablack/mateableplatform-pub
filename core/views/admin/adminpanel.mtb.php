<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */
/**
 * @var $totalu
 */
?>
<section id="admin-dashboard" class="pt-4 pb-5">
    <div class="container-fluid">
        <!-- Admin Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">
                    Administration Dashboard
                </h1>
                <p class="text-muted mb-0">
                    Manage users, monitor system health, and control platform operations.
                </p>
            </div>
        </div>
        <!-- Admin Stats -->
        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Total Users</h6>
                        <h3 class="fw-bold mb-0"><?php echo $totalu; ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Total Posts</h6>
                        <h3 class="fw-bold mb-0">0</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Total Events</h6>
                        <h3 class="fw-bold mb-0">0</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Reports</h6>
                        <h3 class="fw-bold mb-0 text-danger">0</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">System Status</h6>
                        <span class="badge bg-success">Operational</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- Admin Workspace -->
        <div class="row g-4">

            <!-- Admin Sidebar -->
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">
                            User Administrative Actions
                        </h5>

                        <div class="d-grid gap-2">
                            <a href="/admdash/usrmgmt" class="btn btn-small btn-outline-primary">
                                Manage Users
                            </a>
                            <a href="/admdash/moderation" class="btn btn-small btn-outline-secondary">
                                Moderation Queue
                            </a>
                            <a href="/admin/settings" class="btn btn-small btn-outline-danger">
                                Platform Settings
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-2">
                            Security Overview
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            <li>✔ 2FA Enforcement: Disabled</li>
                            <li>✔ Account Recovery: Active</li>
                            <li>✔ Last Audit: 2 days ago</li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Admin Sidebar -->
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">
                            Post Actions
                        </h5>

                        <div class="d-grid gap-2">
                            <a href="/admdash/postmgmt" class="btn btn-small btn-outline-primary">
                                Manage User Posts
                            </a>
                            <a href="/admdash/newsmgmt" class="btn btn-small btn-outline-secondary">
                                Manage News
                            </a>
                            <a href="/admin/settings" class="btn btn-small btn-outline-danger">
                                Platform Settings
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
