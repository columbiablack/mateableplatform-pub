<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

use mateable\core\Platform;
?>
<main class="clean-block">
    <div class="container">
        <div class="row">
            <!--<?php if(Platform::$app->isGuest()): ?>
    <header class="masthead" style="background-image:url('assets/img/mateable_logo.png');background-size: 1000px auto;background-repeat: no-repeat;background-position-y: 50pt;background-attachment: fixed;height: 780px;">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in"><span>Welcome To Mateable Media!</span></div>
                <div class="intro-heading text-uppercase text-dark-emphasis"><span></span></div>
            </div>
        </div>
    </header>
    <?php endif; ?>-->
            <div class="clean-info cols-lg-2">
                <?php if(Platform::$app->session->getFlash('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?php echo Platform::$app->session->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if(Platform::$app->session->getFlash('warning')): ?>
                    <div class="alert alert-warning alert-dismissible fade show">
                        <?php echo Platform::$app->session->getFlash('warning'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            {{content}}
        </div>
    </div>
    <?php if(Platform::$app->request->getUrl() === "/" || Platform::$app->request->getUrl() === "/home"): ?>
    <section class="clean-block" id="portfolio">
         <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase section-heading">Features</h2>
                    <h3 class="text-muted section-subheading">View some of our community features</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" href="#portfolioModal1" data-bs-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="assets/img/portfolio/1-thumbnail.jpg">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Threads</h4>
                        <p class="text-muted">Illustration</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" href="#portfolioModal2" data-bs-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="assets/img/portfolio/2-thumbnail.jpg">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Explore</h4>
                        <p class="text-muted">Graphic Design</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" href="#portfolioModal3" data-bs-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="assets/img/portfolio/3-thumbnail.jpg">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Finish</h4>
                        <p class="text-muted">Identity</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" href="#portfolioModal4" data-bs-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="assets/img/portfolio/4-thumbnail.jpg">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Lines</h4>
                        <p class="text-muted">Branding</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" href="#portfolioModal5" data-bs-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="assets/img/portfolio/5-thumbnail.jpg">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Southwest</h4>
                        <p class="text-muted">Website Design</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 portfolio-item"><a class="portfolio-link" href="#portfolioModal6" data-bs-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fa fa-plus fa-3x"></i></div>
                        </div><img class="img-fluid" src="assets/img/portfolio/6-thumbnail.jpg">
                    </a>
                    <div class="portfolio-caption">
                        <h4>Window</h4>
                        <p class="text-muted">Photography</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>
