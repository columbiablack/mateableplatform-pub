<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */
/**
 * @var $totalu
 */
?>
<section id="admin-dashboard" class="bg-light pt-4 pb-5">
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
                        <h6 class="text-muted">Active Sessions</h6>
                        <h3 class="fw-bold mb-0">312</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Reports</h6>
                        <h3 class="fw-bold mb-0 text-danger">18</h3>
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

            <!-- Main Admin Panel -->
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">
                            Recent Administrative Activity
                        </h5>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                User <strong>@johndoe</strong> suspended
                                <span class="text-muted small float-end">10 mins ago</span>
                            </li>
                            <li class="list-group-item">
                                New admin role assigned
                                <span class="text-muted small float-end">1 hour ago</span>
                            </li>
                            <li class="list-group-item">
                                System maintenance completed
                                <span class="text-muted small float-end">Today</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">
                            User Management
                        </h5>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@johndoe</td>
                                    <td>john@example.com</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>User</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                        <button class="btn btn-sm btn-outline-danger">Suspend</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@admin01</td>
                                    <td>admin@example.com</td>
                                    <td><span class="badge bg-warning">Restricted</span></td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            <!-- Admin Sidebar -->
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">
                            Administrative Actions
                        </h5>

                        <div class="d-grid gap-2">
                            <a href="/admin/users" class="btn btn-outline-primary">
                                Manage Users
                            </a>
                            <a href="/admin/roles" class="btn btn-outline-secondary">
                                Roles & Permissions
                            </a>
                            <a href="/admin/moderation" class="btn btn-outline-warning">
                                Moderation Queue
                            </a>
                            <a href="/admin/settings" class="btn btn-outline-danger">
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
                            <li>✔ 2FA Enforcement: Enabled</li>
                            <li>✔ Account Recovery: Active</li>
                            <li>✔ Last Audit: 2 days ago</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
