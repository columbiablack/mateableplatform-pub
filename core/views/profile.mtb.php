<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

/**
 * user: Mateable
 * @var UserModel $user
*/

use mateable\core\models\user\account\UserModel;
use mateable\core\Platform;

?>

<section class="theme-page clean-block">
    <div class="clean-info container">

        <!-- PROFILE HEADER -->
        <div class="card bg-dark text-light border-0 mb-4 overflow-hidden">

            <!-- Profile Banner -->
            <div class="profile-banner"
                 style="min-height: 180px;
                        background: linear-gradient(135deg, #172554, #312e81, #111827);">
            </div>

            <div class="card-body">
                <div class="row align-items-center g-3">

                    <!-- Avatar -->
                    <div class="col-auto">
                        <img
                                src="/assets/img/default-avatar.png"
                                alt="Player Avatar"
                                width="110"
                                height="110"
                                class="rounded-circle border border-3 border-secondary"
                                style="object-fit: cover;"
                        >
                    </div>

                    <!-- Player Information -->
                    <div class="col">
                        <h2 class="mb-1">
                            <?= htmlspecialchars(
                               $user->displayFirstName() ?? 'Player',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </h2>

                        <p class="text-secondary mb-2">
                            @<?= htmlspecialchars(
                                $user->nickname ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </p>

                        <p class="mb-0">
                            <?= htmlspecialchars(
                                $profile['bio'] ?? 'Welcome to my Mateable Media profile!',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </p>
                    </div>

                    <!-- Profile Actions -->
                    <div class="col-12 col-lg-auto">
                        <?php if (
                            isset(Platform::$app->user) &&
                            Platform::$app->user->isGuest
                        ): ?>
                            <a href="/signin" class="btn btn-primary">
                                Sign In to Connect
                            </a>
                        <?php else: ?>
                            <a href="/messages" class="btn btn-primary">
                                <i class="icon-bubbles"></i> Message
                            </a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>

        <!-- PLAYER STATISTICS -->
        <div class="flex-fill clean-info card-title block-heading">
            <span class="s-label">Player Statistics</span>
        </div>

        <div class="row dark mb-4">
            <div class="clean-catalog container">
                <div class="row justify-content-center g-3">

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-game-controller card-img-top w-100 d-block"></i>
                            <h5>Games Played</h5>
                            <h3>
                                <?= (int) ($profile['games_played'] ?? 0); ?>
                            </h3>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-trophy card-img-top w-100 d-block"></i>
                            <h5>Wins</h5>
                            <h3>
                                <?= (int) ($profile['wins'] ?? 0); ?>
                            </h3>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-chart card-img-top w-100 d-block"></i>
                            <h5>Achievements</h5>
                            <h3>
                                <?= (int) ($profile['achievements_count'] ?? 0); ?>
                            </h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- GAMING PROFILE -->
        <div class="flex-fill clean-info card-title block-heading">
            <span class="s-label">Gaming Profile</span>
        </div>

        <div class="row dark mb-4">
            <div class="clean-catalog container">
                <div class="row justify-content-center g-3">

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-game-controller card-img-top w-100 d-block"></i>
                            <h5>Favorite Games</h5>
                            <p class="text-secondary mb-0">
                                Favorite games will appear here.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-trophy card-img-top w-100 d-block"></i>
                            <h5>Rankings</h5>
                            <p class="text-secondary mb-0">
                                Competitive rankings will appear here.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-badge card-img-top w-100 d-block"></i>
                            <h5>Achievements</h5>
                            <p class="text-secondary mb-0">
                                Player achievements will appear here.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- VIDEOS AND STREAMS -->
        <div class="flex-fill clean-info card-title block-heading">
            <span class="s-label">Videos & Streams</span>
        </div>

        <div class="row dark mb-4">
            <div class="clean-catalog container">
                <div class="row justify-content-center g-3">

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-screen-desktop card-img-top w-100 d-block"></i>
                            <h5>Gameplay Videos</h5>
                            <p class="text-secondary">
                                Gameplay clips and videos will appear here.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-camrecorder card-img-top w-100 d-block"></i>
                            <h5>Live Streams</h5>
                            <p class="text-secondary">
                                Live broadcasts will appear here.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-picture card-img-top w-100 d-block"></i>
                            <h5>Media Gallery</h5>
                            <p class="text-secondary">
                                Screenshots and gaming media will appear here.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- COMMUNITY -->
        <div class="flex-fill clean-info card-title block-heading">
            <span class="s-label">Community</span>
        </div>

        <div class="row dark mb-4">
            <div class="clean-catalog container">
                <div class="row justify-content-center g-3">

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-bubbles card-img-top w-100 d-block"></i>
                            <h5>Messages</h5>
                            <a href="/messages" class="dropdown-item text-center">
                                Open Messages
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-list card-img-top w-100 d-block"></i>
                            <h5>Tournaments</h5>
                            <a href="/tournaments" class="dropdown-item text-center">
                                Browse Tournaments
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card h-100 p-3">
                            <i class="icon-people card-img-top w-100 d-block"></i>
                            <h5>Player Community</h5>
                            <a href="/explore" class="dropdown-item text-center">
                                Explore Players
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>