<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */
use mateable\core\Platform;
?>
<nav class="navbar navbar-expand-lg fixed-top bg-dark navbar-dark" id="mainNav">
    <div class="container"><a class="navbar-brand" href="/">{{app_name}}</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler" type="button" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto text-uppercase">
                <?php if(Platform::$app->isGuest() === true): ?>
                    <li class="nav-item"><a class="nav-link" href="/downloads">Downloads</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contactus">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="/mylogin">Login</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/downloads">Downloads</a></li>
                    <li class="nav-item"><a class="nav-link" href="/videos">Videos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/speakonit">Speak on It! (Forums)</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contactus">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="/help">Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
