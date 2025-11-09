<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

?>
<nav class="navbar navbar-expand-lg fixed-top bg-dark navbar-dark" id="mainNav">
    <div class="container-fluid">
        <a class="navbar-brand" href="/news">{{app_name}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mtbNavbar"
                aria-controls="mtbNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mtbNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/news">News</a>
                </li>
                <?php if(!Platform::$app->isGuest()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/downloads">Downloads</a>
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
                    <?php if(Platform::$app->isGuest()): ?>
                        <ul class="dropdown-menu" aria-labelledby="mtbDropdown">
                            <li><a class="dropdown-item" href="/login">Login</a></li>
                            <li><a class="dropdown-item" href="/register">Register</a></li>
                        </ul>
                    <?php else: ?>
                        <ul class="dropdown-menu" aria-labelledby="mtbDropdown">
                            <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                            <li><a class="dropdown-item" href="/myvideos">Saved Videos</a></li>
                            <li><hr></li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
            <form>
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </div>
</nav>
