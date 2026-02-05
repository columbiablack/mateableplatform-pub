<?php

/**
 * Copyright (c) 2025. Mateable LLC
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
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mtbNavbar" aria-controls="mtbNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="mtbNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/news">News</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="mtbCommunity" data-bs-toggle="dropdown" aria-expanded="false">Community</a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="mtbCommunity">
                        <li><a class="dropdown-item nav-link" href="/tournaments">Tournaments</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="mtbDownload" data-bs-toggle="dropdown" aria-expanded="false">Downloads</a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="mtbDownload">
                        <li><a class="dropdown-item nav-link" href="/games">Games</a></li>
                        <li><a class="dropdown-item nav-link" href="/downloads">Other</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/creators">Creators</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/explore">Explore</a>
                </li>
                <?php if (!Platform::$app->isGuest()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="mtbStreams" data-bs-toggle="dropdown"
                           aria-expanded="false">Streams</a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="mtbStreams">
                            <li><a class="dropdown-item nav-link" href="/livestream">My Stream</a></li>
                            <li><a class="dropdown-item nav-link" href="/favoritestreams">Favorites</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/videos">Videos</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="/contactus">Contact Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="mtbDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false">Account</a>
                    <?php if (Platform::$app->isGuest()): ?>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="mtbDropdown">
                            <li><a class="dropdown-item nav-link" href="/signin">Login</a></li>
                            <li><a class="dropdown-item nav-link" href="/signup">Register</a></li>
                        </ul>
                    <?php else: ?>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="mtbDropdown">
                            <?php if (Platform::$app->user->role >= Platform::$app->user::ROLE_ADMINISTRATOR): ?>
                                <li><a class="dropdown-item nav-link" href="/admdash">Dashboard(Admin)</a></li>
                                <li>
                                    <hr>
                                </li>
                            <?php endif; ?>
                            <li><i class="dropdown-item-text text-info disabled" aria-disabled="true" tabindex="-1"><b>Main Menu</b></i></li>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item nav-link" href="/dashboard">Dashboard</a></li>
                            <li><a class="dropdown-item nav-link" href="/payments">Payments</a></li>
                            <li><a class="dropdown-item nav-link" href="/subscriptions">Subscriptions</a></li>
                            <li><a class="dropdown-item nav-link" href="/signout">Sign out</a></li>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
            <?php $form = Form::begin('/search', 'get'); ?>
            <?= $form->field(new SearchModel(), 'q', '', '', 'padding:10px; border:1px solid #ccc; border-radius:4px; font-size:14px; width:240px; box-sizing:border-box;', 'Search'); ?>
            <?= $form::end(); ?>
        </div>
    </div>
</nav>
