<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

if(Platform::$app->user){
    $balance = Platform::$app->mateablecoin->getbalance() ?? '';
    $toUSD = Platform::$app->xeggeX->getCoinUSDValue($balance) ?? '';
}
?>
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container">
        <a class="navbar-brand logo" href="./">{{small_logo}}{{app_name}}</a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ms-auto">
                <?php if(Platform::isGuest() === true): ?>
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
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true"><?php echo ('<i class="icon-user"></i> '); ?></a>
                        <ul class="dropdown-menu">
                            <!--<li><h6 class="dropdown-item text-info"><i class="icon-people"></i> Social</h6></li>
                            <li><hr class="dropdown-divider"></li>-->
                            <li><a class="dropdown-item" href="./profile"><?php echo(Platform::$app->user->displayFirstName()); ?>'s Profile</a></li>
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
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" aria-expanded="true">
                            <i class="icon-wallet"></i> {{MTBC_BALANCE}}
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
