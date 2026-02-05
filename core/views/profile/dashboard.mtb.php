<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

/**
 * user: Mateable
 * @var $accstat
 * @var $followerc
 * @var $followingc
 * @var $postsc
 * @var $unreadc
 * @var $messagec
 * @var array $activities
 * @var ActivityModel $activity
 */

use mateable\core\models\ActivityModel;
use mateable\core\Platform;

?>
<section id="dashboard" class="bg-light pt-4 pb-5">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">
                    Dashboard
                </h1>
                <p class="text-muted mb-0">
                    Welcome back! Here’s what’s happening with your account.
                </p>
            </div>
        </div>
        <!-- Stats Row -->
        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Posts</h6>
                        <h3 class="fw-bold mb-0"><?php echo $postsc; ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Followers</h6>
                        <h3 class="fw-bold mb-0"><?php echo $followerc; ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Following</h6>
                        <h3 class="fw-bold mb-0"><?php echo $followingc; ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Unread/Messages</h6>
                        <h3 class="fw-bold mb-0"><?php echo $unreadc; ?>/<?php echo $messagec; ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Active Events</h6>
                        <h3 class="fw-bold mb-0">0</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Account Status</h6>
                        <?php
                            switch($accstat){

                                case Platform::$app->user::ACCOUNT_STATUS_PENDING:
                                    echo '<span class="badge bg-warning">'.$accstat.'</span>';
                                    break;

                                case Platform::$app->user::ACCOUNT_STATUS_ACTIVE:
                                    echo '<span class="badge bg-success">'.$accstat.'</span>';
                                    break;

                                case Platform::$app->user::ACCOUNT_STATUS_SUSPENDED:
                                    echo '<span class="badge bg-danger">'.$accstat.'</span>';
                                    break;

                            }
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- Main Content -->
        <div class="row g-4">

            <!-- Primary Column -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">
                            Recent Activity
                        </h5>
                        <?php if(!empty($activities)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($activities as $activity): ?>
                            <li class="list-group-item">
                                <?php echo(htmlspecialchars($activity->context)) ?>
                                <span class="text-muted small float-end"><?php echo date('M d, Y h:i A', strtotime($activity->created_at)) ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <p class="text-muted">No recent activity.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-4">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">
                            Quick Actions
                        </h5>

                        <div class="d-grid gap-2">
                            <a href="/profile" class="btn btn-outline-primary">
                                View Profile
                            </a>
                            <a href="/settings" class="btn btn-outline-secondary">
                                Account Settings
                            </a>
                            <a href="/security" class="btn btn-outline-danger">
                                Security
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-2">
                            System Status
                        </h6>
                        <p class="text-muted small mb-0">
                            All services operational.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
