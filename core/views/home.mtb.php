<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

/***
 *  user: Mateable
 */

use mateable\core\Platform;

?>

<section class="py-5">
    <div class="container">

        <div class="row g-4">

            <!-- Card: Platform Intro -->
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h2 class="text-info mb-3">News</h2>
                        {{news_posts}}
                    </div>
                </div>
            </div>

            <!-- Card: Platform Intro -->
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h2 class="text-info mb-3">Mateable Media</h2>
                        <p class="mb-3">
                            Welcome to {{app_name}}, a competitive gaming platform built by Mateable LLC.
                            Our focus is simple: provide a place where players can compete, improve their skills,
                            and participate in a fair and rewarding gaming ecosystem.
                        </p>
                        <p class="mb-0">
                            This platform is designed around gameplay first—performance, matchmaking,
                            rankings, and community are driven by what happens in-game, not by algorithms
                            or artificial engagement.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card: Play Compete Progress -->
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h4 class="text-info mb-3">Play • Compete • Progress</h4>
                        <p class="mb-0">
                            Compete in skill-based games, climb ranked ladders, and take part in seasonal
                            tournaments. Track your progress, earn achievements, and build a reputation
                            based on performance—not popularity.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card: Creators & Developers -->
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h4 class="text-info mb-3">Creators & Developers</h4>
                        <p class="mb-3">
                            Mateable Media supports creators and developers who build meaningful gaming
                            experiences. Stream gameplay, host tournaments, and publish games or mods
                            directly to an audience that values competition and quality.
                        </p>
                        <p class="mb-0">
                            Monetization is transparent and skill-driven, allowing creators to earn through
                            engagement, events, and platform-supported tools—without intrusive advertising
                            or pay-to-win mechanics.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="bg-dark" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-uppercase section-heading text-primary">Platform Features</h2>
                <h3 class="section-subheading text-muted">
                    Core systems built for competitive gaming
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4 portfolio-item">
                <a class="portfolio-link" href="#matchMaking" data-bs-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="assets/img/features/matchmaking.jpg">
                </a>
                <div class="portfolio-caption">
                    <h4>Matchmaking</h4>
                    <p class="text-muted">Skill-Based Play</p>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 portfolio-item">
                <a class="portfolio-link" href="#rankedLadders" data-bs-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="assets/img/features/rankedladders.jpg">
                </a>
                <div class="portfolio-caption">
                    <h4>Ranked Ladders</h4>
                    <p class="text-muted">Seasonal Progression</p>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 portfolio-item">
                <a class="portfolio-link" href="#tournaments" data-bs-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="assets/img/features/tournaments.jpg">
                </a>
                <div class="portfolio-caption">
                    <h4>Tournaments</h4>
                    <p class="text-muted">Competitive Events</p>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 portfolio-item">
                <a class="portfolio-link" href="#playerProfiles" data-bs-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="assets/img/features/playerprofiles.jpg">
                </a>
                <div class="portfolio-caption">
                    <h4>Player Profiles</h4>
                    <p class="text-muted">Stats & Achievements</p>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 portfolio-item">
                <a class="portfolio-link" href="#creators" data-bs-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="assets/img/features/creators.jpg">
                </a>
                <div class="portfolio-caption">
                    <h4>Creators</h4>
                    <p class="text-muted">Streaming & Events</p>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 portfolio-item">
                <a class="portfolio-link" href="#developers" data-bs-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="assets/img/features/developers2.jpg">
                </a>
                <div class="portfolio-caption">
                    <h4>Developers</h4>
                    <p class="text-muted">Games & Mod Support</p>
                </div>
            </div>
        </div>
    </div>
</section>
