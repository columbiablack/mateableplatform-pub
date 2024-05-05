<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

 ?>
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container">
        <?php if(Platform::isGuest() === true): ?>
            <a class="navbar-brand logo" href="/">{{small_logo}}{{app_name}}</a>
        <?php else: ?>
            <a class="navbar-brand logo" href="/dashboard">{{small_logo}}{{app_name}}</a>
        <?php endif;?>
        <!-- Split button -->
        <?php if(Platform::isGuest() === true): ?>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="./login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="./register">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="./marketplace">Marketplace</a></li>
                    <li class="nav-item"><a class="nav-link" href="./downloads">Downloads</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                            Projects
                        </a>
                        <ul class="dropdown-menu">
                            <li><p class="dropdown-item">Our Projects</p></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="https://coin.mateable.com/">Mateablecoin(MTBC)</a></li>
                            <li><a class="dropdown-item" href="./orchid">Orchid App</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="./about-us">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="./contactus">Contact Us</a></li>
                </ul>
            </div>
        <?php else: ?>
            <div class="btn-group">
                <button type="button" class="btn btn-outline-dark"><i class="icon-user"></i></button>
                <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./dashboard"><?php echo(Platform::$app->user->displayFirstName()); ?>'s Dashboard</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="./profile">My Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="icon-people"></i> Contacts</a></li>
                    <li><a class="dropdown-item" href="#"><i class="icon-people"></i> Groups</a></li>
                    <li><a class="dropdown-item" href="#"><i class="icon-bubbles"></i> Personal Message</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="icon-screen-desktop"></i> Videos</a></li>
                    <li><a class="dropdown-item" href="#"><i class="icon-picture"></i> Photos</a></li>
                    <li><a class="dropdown-item" href="#"><i class="icon-pencil"></i> Storyline</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Marketplace</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="icon-list"></i> My Subscriptions</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="icon-settings"></i> My Preferences</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="./logout">Sign Out</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>
