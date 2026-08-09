<?php

/**
 * Copyright (c) 2025-2026. Mateable LLC
 */

use mateable\core\form\Form;
use mateable\core\models\SearchModel;
use mateable\core\Platform;

/**
 * user: Mateable
 * @var $searchModel mateable\core\models\SearchModel
 * @var $results array
 **/

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">{{app_name}}</a>
        <div class="collapse navbar-collapse" id="mtbNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/news">News</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="mtbStore" data-bs-toggle="dropdown" aria-expanded="false">Store</a>
                    <ul class="dropdown-menu mega-menu bg-dark p-0" aria-labelledby="mtbStore">
                        <div class="mega-container d-flex">
                            <div class="mega-left">
                                <a class="mega-category active" data-target="Games"><i class="bi bi-controller"></i> Games</a>
                                <a class="mega-category" data-target="Software"><i class="bi bi-cpu"></i> Software</a>
                                <a class="mega-category" data-target="Rewards"><i class="bi bi-gift"></i> Rewards</a>
                            </div>
                            <div class="mega-right">
                                <div class="mega-panel active" id="Games">
                                    <h6>PC & Mobile Games</h6>
                                    <a href="/store?section=games"><i class="bi bi-stars"></i> New Releases</a>
                                    <a href="/store?section=games"><i class="bi bi-heart"></i> Wishlist</a>
                                    <a href="/store?section=games"><i class="bi bi-box-seam"></i> My Inventory</a>
                                </div>
                                <div class="mega-panel" id="Software">
                                    <h6>Software & Apps</h6>
                                    <a href="/store?section=software"><i class="bi bi-pc-display"></i> Desktop</a>
                                    <a href="/store?section=software"><i class="bi bi-phone"></i> Mobile</a>
                                </div>
                                <div class="mega-panel" id="Rewards">
                                    <h6>Rewards</h6>
                                    <a href="/store?section=rewards"><i class="bi bi-question-circle"></i> How to Earn</a>
                                    <a href="/store?section=rewards"><i class="bi bi-gift"></i> Redeem Points</a>
                                    <a href="/store?section=rewards"><i class="bi bi-ticket-perforated"></i> Redeem Code</a>
                                </div>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="mtbDownload" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu mega-menu bg-dark p-0" aria-labelledby="mtbDownload">
                        <li>
                            <div class="mega-container d-flex">

                                <!-- LEFT: MAIN CATEGORIES -->
                                <div class="mega-left">
                                    <a class="mega-category active" data-target="action"><i class="bi bi-lightning-charge"></i> Action</a>
                                    <a class="mega-category" data-target="adventure"><i class="bi bi-compass"></i> Adventure</a>
                                    <a class="mega-category" data-target="rpg"><i class="bi bi-person-badge"></i> RPG</a>
                                    <a class="mega-category" data-target="strategy"><i class="bi bi-diagram-3"></i> Strategy</a>
                                    <a class="mega-category" data-target="simulation"><i class="bi bi-cpu"></i> Simulation</a>
                                    <a class="mega-category" data-target="sports"><i class="bi bi-trophy"></i> Sports</a>
                                    <a class="mega-category" data-target="online"><i class="bi bi-globe2"></i> Online</a>
                                    <a class="mega-category" data-target="casual"><i class="bi bi-emoji-smile"></i> Casual</a>
                                </div>

                                <!-- RIGHT: SUBCATEGORY PANELS -->
                                <div class="mega-right">

                                    <!-- ACTION -->
                                    <div class="mega-panel active" id="action">
                                        <h6>Action & Shooter</h6>
                                        <a href="#"><i class="bi bi-lightning-charge"></i> Action</a>
                                        <a href="#"><i class="bi bi-crosshair"></i> Shooter</a>
                                        <a href="#"><i class="bi bi-bullseye"></i> FPS</a>
                                        <a href="#"><i class="bi bi-person-video3"></i> Third-Person</a>
                                    </div>

                                    <!-- ADVENTURE -->
                                    <div class="mega-panel" id="adventure">
                                        <h6>Adventure</h6>
                                        <a href="#"><i class="bi bi-compass"></i> Adventure</a>
                                        <a href="#"><i class="bi bi-map"></i> Action-Adventure</a>
                                        <a href="#"><i class="bi bi-book"></i> Story Driven</a>
                                    </div>

                                    <!-- RPG -->
                                    <div class="mega-panel" id="rpg">
                                        <h6>RPG</h6>
                                        <a href="#"><i class="bi bi-person-badge"></i> RPG</a>
                                        <a href="#"><i class="bi bi-globe"></i> MMORPG</a>
                                        <a href="#"><i class="bi bi-sword"></i> Hack & Slash</a>
                                    </div>

                                    <!-- STRATEGY -->
                                    <div class="mega-panel" id="strategy">
                                        <h6>Strategy</h6>
                                        <a href="#"><i class="bi bi-diagram-3"></i> Strategy</a>
                                        <a href="#"><i class="bi bi-lightning"></i> Real-Time (RTS)</a>
                                        <a href="#"><i class="bi bi-hourglass-split"></i> Turn-Based</a>
                                    </div>

                                    <!-- SIMULATION -->
                                    <div class="mega-panel" id="simulation">
                                        <h6>Simulation</h6>
                                        <a href="#"><i class="bi bi-controller"></i> Simulation</a>
                                        <a href="#"><i class="bi bi-house"></i> Life Sim</a>
                                    </div>

                                    <!-- SPORTS -->
                                    <div class="mega-panel" id="sports">
                                        <h6>Sports & Racing</h6>
                                        <a href="#"><i class="bi bi-trophy"></i> Sports</a>
                                        <a href="#"><i class="bi bi-speedometer2"></i> Racing</a>
                                    </div>

                                    <!-- ONLINE -->
                                    <div class="mega-panel" id="online">
                                        <h6>Online & Competitive</h6>
                                        <a href="#"><i class="bi bi-diagram-2"></i> MOBA</a>
                                        <a href="#"><i class="bi bi-people-fill"></i> Battle Royale</a>
                                    </div>

                                    <!-- CASUAL -->
                                    <div class="mega-panel" id="casual">
                                        <h6>Casual & Arcade</h6>
                                        <a href="#"><i class="bi bi-joystick"></i> Casual</a>
                                        <a href="#"><i class="bi bi-arcade"></i> Arcade</a>
                                    </div>

                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="mtbCreatorsStreams" data-bs-toggle="dropdown" aria-expanded="false">Community</a>
                    <ul class="dropdown-menu mega-menu bg-dark p-0" aria-labelledby="mtbCreatorsStreams">
                        <div class="mega-container d-flex">

                            <!-- LEFT: MAIN CATEGORIES -->
                            <div class="mega-left">

                                <a class="mega-category active" data-target="Creators-Streams">
                                    <i class="bi bi-camera-video"></i>
                                    Creators & Streams
                                </a>

                                <a class="mega-category" data-target="Tournaments">
                                    <i class="bi bi-trophy"></i>
                                    Tournaments
                                </a>

                                <a class="mega-category" data-target="CommunityHighlights">
                                    <i class="bi bi-star"></i>
                                    Community Highlights
                                </a>

                            </div>

                            <!-- RIGHT: PANEL -->
                            <div class="mega-right">

                                <div class="mega-panel active" id="Creators-Streams">
                                    <h6><i class="bi bi-broadcast"></i> Creators & Streams</h6>
                                    <a href="/creators-streams" class="mega-item"><i class="bi bi-star"></i> Featured Creators</a>
                                    <a href="/streams" class="mega-item"><i class="bi bi-play-circle"></i> Live Streams</a>
                                    <a href="/creators-streams" class="mega-item"><i class="bi bi-person-plus"></i> Become a Creator</a>
                                    <a href="/creators-streams" class="mega-item"><i class="bi bi-camera-reels"></i> Gaming Clips</a>
                                </div>

                                <div class="mega-panel" id="Tournaments">
                                    <h6 class="text-white mb-3"><i class="bi bi-trophy"></i> Tournaments</h6>
                                    <a href="/tournaments" class="mega-item"><i class="bi bi-search"></i> Browse Tournaments</a>
                                    <a href="/tournaments" class="mega-item"><i class="bi bi-controller"></i> My Competitions</a>
                                    <a href="/tournaments" class="mega-item"><i class="bi bi-plus-circle"></i> Create Tournament</a>
                                    <a href="/leaderboards" class="mega-item"><i class="bi bi-bar-chart"></i> Leaderboards</a>
                                </div>

                                <div class="mega-panel" id="CommunityHighlights">
                                    <h6 class="text-white mb-3"><i class="bi bi-star"></i> Community Highlights</h6>
                                    <a href="/creators-streams" class="mega-item"><i class="bi bi-camera-video"></i> Spotlight Feed</a>
                                    <a href="/tournaments" class="mega-item"><i class="bi bi-trophy"></i> Weekly Brackets</a>
                                    <a href="/streams" class="mega-item"><i class="bi bi-play-circle"></i> Live Watch Party</a>
                                </div>

                            </div>

                        </div>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="mtbDropdown" data-bs-toggle="dropdown" aria-expanded="false">Account</a>

                    <?php if (Platform::$app->isGuest()): ?>
                        <ul class="dropdown-menu mega-menu bg-dark p-0" aria-labelledby="mtbAccount">
                            <div class="mega-container d-flex">

                                <!-- LEFT: MAIN CATEGORIES -->
                                <div class="mega-left">
                                    <a class="mega-category" href="/signin" data-target="Login">Login</a>
                                    <a class="mega-category" href="/signup" data-target="Register">Register</a>
                                </div>

                                <!-- RIGHT: INFORMATION -->
                                <div class="mega-right">

                                    <div class="mega-panel" id="Login">
                                        <p>
                                            You're already a member? Login here!
                                        </p>
                                    </div>

                                    <div class="mega-panel" id="Register">
                                        <p>
                                            You can sign up now for free and experience what Mateable Media has to offer!
                                        </p>
                                    </div>

                                </div>

                            </div>
                        </ul>
                    <?php else: ?>
                        <!-- Mega-Menu -->
                        <ul class="dropdown-menu mega-menu bg-dark p-0" aria-labelledby="mtbAccount">
                            <div class="mega-container d-flex">

                                <!-- LEFT: MAIN CATEGORIES -->
                                <div class="mega-left">

                                    <?php if (Platform::$app->user->role >= Platform::$app->user::ROLE_ADMINISTRATOR): ?>
                                        <a class="mega-category" href="/admdash">
                                            <i class="bi bi-shield-lock"></i> Admin Dashboard
                                        </a>
                                        <hr>
                                    <?php endif; ?>

                                    <a class="mega-category active" data-target="Dashboard">
                                        <i class="bi bi-speedometer2"></i> Dashboard
                                    </a>

                                    <a class="mega-category" data-target="Messages">
                                        <i class="bi bi-chat-dots"></i> Messages
                                    </a>

                                    <a class="mega-category" data-target="Payments">
                                        <i class="bi bi-credit-card"></i> Payments
                                    </a>

                                    <a class="mega-category" data-target="Subscriptions">
                                        <i class="bi bi-arrow-repeat"></i> Subscriptions
                                    </a>

                                    <a class="mega-category text-danger" href="/signout">
                                        <i class="bi bi-box-arrow-right"></i> Sign out
                                    </a>

                                </div>

                                <!-- RIGHT: SUBCATEGORY PANELS -->
                                <div class="mega-right">

                                    <!-- DASHBOARD -->
                                    <div class="mega-panel active" id="Dashboard">
                                        <h6>Account Dashboard</h6>
                                        <a href="/dashboard"><i class="bi bi-speedometer2"></i> My Dashboard</a>
                                        <a href="/dashboard/edit/account"><i class="bi bi-gear"></i> Account Settings</a>
                                        <a href="/dashboard/edit/profile"><i class="bi bi-person-circle"></i> Edit Profile</a>
                                        <a href="/dashboard"><i class="bi bi-bar-chart"></i> My Game Stats</a>
                                    </div>

                                    <!-- MESSAGES -->
                                    <div class="mega-panel" id="Messages">
                                        <h6>Messages</h6>
                                        <a href="/messages"><i class="bi bi-inbox"></i> Inbox</a>
                                        <a href="/messages"><i class="bi bi-archive"></i> Archive</a>
                                        <a href="/messages"><i class="bi bi-trash"></i> Trash</a>
                                    </div>

                                    <!-- PAYMENTS -->
                                    <div class="mega-panel" id="Payments">
                                        <h6>Payments</h6>
                                        <a href="/payments"><i class="bi bi-credit-card"></i> Payment Methods</a>
                                        <a href="/payments"><i class="bi bi-receipt"></i> Billing History</a>
                                    </div>

                                    <!-- SUBSCRIPTIONS -->
                                    <div class="mega-panel" id="Subscriptions">
                                        <h6>My Subscriptions</h6>
                                        <a href="/subscriptions"><i class="bi bi-people"></i> Who's Following Me</a>
                                        <a href="/subscriptions"><i class="bi bi-arrow-repeat"></i> Manage Subscriptions</a>
                                    </div>

                                </div>
                            </div>
                        </ul>                    <?php endif; ?>
                </li>
            </ul>
            <?php $form = Form::begin('/search', 'get'); ?>
            <?= $form->field(new SearchModel(), 'q', '', '', 'padding:10px; border:1px solid #ccc; border-radius:4px; font-size:14px; width:240px; box-sizing:border-box;', 'Search'); ?>
            <?= $form::end(); ?>
        </div>
    </div>
</nav>
