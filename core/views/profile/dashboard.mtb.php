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
<section id="dashboard" class="pt-4 pb-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="mateable-dashboard-hero card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                            <div>
                                <p class="text-uppercase fw-bold mb-2" style="letter-spacing:0.24rem; color: var(--mateable-accent);">Command Center</p>
                                <h1 class="fw-bold mb-2" style="color: var(--mateable-text);">
                                    Your Dashboard
                                </h1>
                                <p class="mb-0" style="color: var(--mateable-muted);">
                                    Welcome back! Track your presence, stats, and next moves from one place.
                                </p>
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge mateable-badge-pill">Live</span>
                                <span class="badge mateable-badge-pill">Ranked</span>
                                <span class="badge mateable-badge-pill">Ready</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <div class="card mateable-stat-card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Total Posts</h6>
                        <h3 class="fw-bold mb-0" style="color: var(--mateable-accent);"><?php echo $postsc; ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mateable-stat-card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Followers</h6>
                        <h3 class="fw-bold mb-0" style="color: var(--mateable-accent);"><?php echo $followerc; ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mateable-stat-card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Following</h6>
                        <h3 class="fw-bold mb-0" style="color: var(--mateable-accent);"><?php echo $followingc; ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mateable-stat-card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Unread/Messages</h6>
                        <h3 class="fw-bold mb-0" style="color: var(--mateable-accent);"><?php echo $unreadc; ?>/<?php echo $messagec; ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mateable-stat-card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Active Events</h6>
                        <h3 class="fw-bold mb-0" style="color: var(--mateable-accent);">0</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mateable-stat-card shadow-sm border-0">
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
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card mateable-panel shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-semibold mb-0">Recent Activity</h5>
                            <span class="badge mateable-badge-pill">Live Feed</span>
                        </div>
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

            <div class="col-lg-4">

                <div class="card mateable-panel shadow-sm border-0 mb-4">
                    <div class="card-body">

                        <h5 class="fw-semibold mb-3">
                            Quick Actions
                        </h5>

                        <div class="d-grid gap-1 mb-sm-1">
                            <?php if(Platform::$app->user->role === Platform::$app->user::ROLE_ADMINISTRATOR): ?>
                                <a href="admdash/post" class="btn btn-small mateable-action-btn">
                                    Create News Post
                                </a>
                            <?php endif; ?>

                            <a href="dashboard/post" class="btn mateable-action-btn">
                                Create Post
                            </a>

                            <a href="dashboard/edit?action=create&category=events" class="btn mateable-action-btn">
                                Create Event
                            </a>

                            <a href="dashboard/edit?action=modify&category=account" class="btn btn-outline-secondary">
                                Modify Account
                            </a>

                            <a href="dashboard/edit?action=&category=profile" class="btn mateable-action-btn">
                                Edit Profile
                            </a>

                            <a href="dashboard/edit?action=manage&category=community" class="btn btn-outline-secondary">
                                Manage Community
                            </a>
                        </div>

                    </div>
                </div>

                <div class="card mateable-panel shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-2">Mission Board</h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2"><i class="fa fa-trophy me-2" style="color: var(--mateable-accent);"></i>Join a ranked event this week</li>
                            <li class="mb-2"><i class="fa fa-users me-2" style="color: var(--mateable-accent);"></i>Build your squad and invite friends</li>
                            <li><i class="fa fa-bolt me-2" style="color: var(--mateable-accent);"></i>Share your latest match highlights</li>
                        </ul>
                    </div>
                </div>

                <div class="card mateable-panel shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-2">Upcoming Events</h6>
                        <p class="text-muted small mb-2">Weekly Cup • 8:00 PM UTC</p>
                        <p class="text-muted small mb-2">Creator Drop-in • Friday</p>
                        <p class="text-muted small mb-0">Community Scrim • Sunday</p>
                    </div>
                </div>

                <div class="card mateable-panel shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-2">Performance Snapshot</h6>
                        <p class="text-muted small mb-1"><strong style="color: var(--mateable-accent);">Win Rate:</strong> 72%</p>
                        <p class="text-muted small mb-1"><strong style="color: var(--mateable-accent);">Current Streak:</strong> +4</p>
                        <p class="text-muted small mb-0"><strong style="color: var(--mateable-accent);">Next Goal:</strong> Reach Diamond</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
