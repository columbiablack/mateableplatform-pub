<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

use mateable\core\Platform;

 ?>

<div class="collapse fixed-bottom" id="navbarToggleExternalContent" data-bs-theme="light" style="">
    <div class="p-xl-5">
        <div class="btn-group">
            <div class="row">
                <div class="col-sm-auto">
                    <h5>Membership</h5>
                    <ul>
                        <?php if(Platform::isGuest() === true): ?>
                            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Preferences</a></li>
                            <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-sm-auto">
                    <h5>Community</h5>
                    <ul>
                        <li class="nav-item"><a class="nav-link" href="/downloads">Downloads</a></li>
                        <?php if(Platform::isGuest() === false): ?>
                        <li class="nav-item"><a class="nav-link" href="#">Forum</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Marketplace</a><small>(Coming Soon)</small></li>
                        <li class="nav-item"><a class="nav-link" href="#">Chatplace</a><small>(Coming Soon)</small></li>
                        <li class="nav-item"><a class="nav-link" href="#">Pylix</a><small>(Coming Soon)</small></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-sm-auto">
                    <h5>Projects</h5>
                    <ul>
                        <li class="nav-item"><a class="nav-link" href="https://coin.mateable.com/">Mateablecoin(MTBC)</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Orchid</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Pylix</a></li>
                    </ul>
                </div>
                <div class="col-sm-auto">
                    <h5>Reach Out</h5>
                    <ul>
                        <li class="nav-item"><a class="nav-link" href="/about-us">About {{app_name}}</a></li>
                        <li class="nav-item"><a class="nav-link" href="/contactus">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <div>
            <?php if(Platform::isGuest() === true): ?>
                <a class="navbar-brand logo" href="/">{{small_logo}}{{app_name}}</a>
            <?php else: ?>
                <a class="navbar-brand logo" href="/dashboard">{{small_logo}}{{app_name}}</a>
            <?php endif;?>
        </div>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
