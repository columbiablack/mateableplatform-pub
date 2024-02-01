<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

?>
<main class="page landing-page">
    <?php if(Platform::$app->isGuest()): ?>
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
    <?php if(Platform::$app->session->getFlash('warning')): ?>
        <div class="alert alert-warning">
            <?php echo Platform::$app->session->getFlash('warning'); ?>
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
