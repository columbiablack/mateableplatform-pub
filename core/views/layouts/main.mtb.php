<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

use mateable\core\Platform;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{app_name}}</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap_main.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="./assets/fonts/simple-line-icons_main.min.css">
    <link rel="stylesheet" href="./assets/css/main.min.css">
</head>
<body>

<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container">
        <a class="navbar-brand logo" href="./">{{app_name}}</a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ms-auto">
                <?php if(Platform::isGuest() >= false): ?>
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
                <li class="nav-item"><a class="nav-link" href="./contact">Contact Us</a></li>
                <?php else: ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                        <?php echo '<i class="icon-user"></i> '. Platform::$app->user->displayUserName(); ?>
                    </a>
                    <ul class="dropdown-menu">
                        <!--<li><h6 class="dropdown-item text-info"><i class="icon-people"></i> Social</h6></li>
                        <li><hr class="dropdown-divider"></li>-->
                        <li><a class="dropdown-item" href="./profile">Dashboard</a></li>
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
                        <i class="icon-wallet"></i> 0.00 MTBC{{MTBC_Price}}
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<main class="page landing-page">
    <?php if(Platform::isGuest() >= false): ?>
    <section class="clean-block clean-hero" style="background-image: url(&quot;assets/img/mateable_logo.png&quot;);background-position-y: -200pt;background-attachment: fixed;color: rgba(30, 75, 180, 0.85);"> <!--//rgba(9, 162, 255, 0.85);">-->
        <div class="text">
            <h2>{{app_name}}</h2>
            <p>We're back, register and see what's new!</p>
            <a class="btn btn-outline-light btn-lg" href="./register#register" type="button">Register</a>
        </div>
    </section>
    <?php endif; ?>
    <?php if(Platform::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Platform::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    {{content}}
<?php if(Platform::$app->request->getUrl() === '/'): ?>
    <section class="clean-block slider dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Hot Topics</h2>
                <p>See what's hot from the hottest topics!</p>
            </div>
            <div class="carousel slide" data-bs-ride="carousel" id="carousel-1">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100 d-block" src="assets/img/scenery/image1.jpeg" alt="Slide Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 d-block" src="assets/img/scenery/image2.jpeg" alt="Slide Image">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100 d-block" src="assets/img/scenery/image3.jpeg" alt="Slide Image">
                    </div>
                </div>
                <div>
                    <a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
                <ol class="carousel-indicators">
                    <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
                </ol>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="clean-block slider dark">
        <div class="container">

        </div>
    </section>
<?php endif; ?>
</main>
<footer class="page-footer dark">
    <div class="container">
        <?php if(Platform::isGuest()>=false): ?>
        <div class="row">
            <div class="col-sm-3">
                <h5>Get started</h5>
                <ul>
                    <li><a href="./">Home</a></li>
                    <li><a href="./register">Register</a></li>
                    <li><a href="./downloads">Downloads</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>About us</h5>
                <ul>
                    <li><a href="./about-us">Mateable LLC</a></li>
                    <li><a href="./contact">Contact us</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Support</h5>
                <ul>
                    <li><a href="./#">FAQ</a></li>
                    <li><a href="./#">Help desk</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Legal</h5>
                <ul>
                    <li><a href="./legal?type=serviceterms">Terms of Service</a></li>
                    <li><a href="./legal?type=privacypolicy">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="footer-copyright">
        <p>© <?php echo date('Y'); ?> Copyright <a href="https://www.mateable.com/">{{app_name}} LLC</a></p>
    </div>
</footer>
<script src="./assets/bootstrap/js/main.min.js"></script>
<script src="./assets/js/main.min.js"></script>
<script src="./assets/js/validation.js"></script>
</body>
</html>