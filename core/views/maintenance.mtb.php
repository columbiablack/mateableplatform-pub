<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

$myEnvName = $_ENV['NAME'];
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Mateable Media is a next-gen gaming platform for tournaments, matchmaking, streaming, and community—built by players, for players.">

    <meta property="og:title" content="Mateable Media">
    <meta property="og:description" content="Mateable Media is a next-gen gaming platform for tournaments, matchmaking, streaming, and community—built by players, for players.">
    <meta property="og:image" content="https://mateablemedia.com/assets/img/mateable_logo.png">
    <meta property="og:url" content="https://mateablemedia.com">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Mateable Media">
    <meta name="twitter:description" content="Compete, stream, and connect on Mateable Media — built by players, for players.">
    <meta name="twitter:image" content="https://mateablemedia.com/assets/img/mateable_logo.png">

    <title>{{app_name}}</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;display=swap">
</head>
<body id="wBody" class="" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="54">
<!--<section class="content">
    <div id="wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center">
                    <img src="assets/img/mateable_logo.png" width="150" height="135">
                    <h2 class="text-gray-900 mb-4">Undergoing maintenance</h2>
                </div>
                <div class="block-content">
                    <p class="text-secondary card-text text-left">
                        The <?php echo $myEnvName; ?> LLC platform is undergoing maintenance or upgrades at the moment.
                        It will only be a short period of time our services are unavailable to you. If you see this message for longer than 12 hours, consider this a major upgrade!
                        <br />
                        Developers, check out <a href="https://github.com/mateable">Github</a> to see the latest upgrades!
                    </p>
                    <p class="text-secondary card-text">
                        Best regards,<br />
                        Mateable Team
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="pt-5 pb-4 border-top">
    <div class="container">

        <div class="row mb-4">

            <div class="col-md-4 mb-3">
                <h5 class="text-uppercase">{{app_name}}</h5>
                <p class="text-muted small">
                    {{app_name}} is a next-generation gaming platform where players compete,
                    connect, and grow through tournaments, community-driven features,
                    and creator-focused tools.
                </p>
            </div>

            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase">Platform</h6>
                <ul class="list-unstyled small">
                    <li><a class="text-dark-emphasis" href="/about">About</a></li>
                    <li><a class="text-dark-emphasis" href="/how-it-works">How It Works</a></li>
                    <li><a class="text-dark-emphasis" href="/roadmap">Roadmap</a></li>
                    <li><a class="text-dark-emphasis" href="/careers">Careers</a></li>
                </ul>
            </div>

            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase">Community</h6>
                <ul class="list-unstyled small">
                    <li><a class="text-dark-emphasis" href="/community/forums">Forums</a></li>
                    <li><a class="text-dark-emphasis" href="/tournaments">Tournaments</a></li>
                    <li><a class="text-dark-emphasis" href="/events">Events</a></li>
                    <li><a class="text-dark-emphasis" href="/leaderboards">Leaderboards</a></li>
                </ul>
            </div>

            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase">Support</h6>
                <ul class="list-unstyled small">
                    <li><a class="text-dark-emphasis" href="/help">Help Center</a></li>
                    <li><a class="text-dark-emphasis" href="/contact">Contact</a></li>
                    <li><a class="text-dark-emphasis" href="/account-recovery">Account Recovery</a></li>
                    <li><a class="text-dark-emphasis" href="/report">Report Abuse</a></li>
                </ul>
            </div>

            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase">Legal</h6>
                <ul class="list-unstyled small">
                    <li><a class="text-dark-emphasis" href="/legal?type=privacypolicy">Privacy Policy</a></li>
                    <li><a class="text-dark-emphasis" href="/legal?type=serviceterms">Terms of Use</a></li>
                    <li><a class="text-dark-emphasis" href="/guidelines">Community Guidelines</a></li>
                    <li><a class="text-dark-emphasis" href="/dmca">DMCA</a></li>
                </ul>
            </div>

        </div>

        <hr>

        <div class="row align-items-center">

            <div class="col-md-4 text-md-start text-center mb-2 mb-md-0">
                <span class="copyright small text-muted">
                    © <?php echo date('Y'); ?>
                    <a class="text-dark-emphasis" href="{{site_url}}">
                        {{app_name}} LLC
                    </a>. All rights reserved.
                </span>
            </div>

            <div class="col-md-4 text-center mb-2 mb-md-0">
                <ul class="list-inline social-buttons mb-0">
                    <li class="list-inline-item">
                        <a href="https://x.com/mateable" aria-label="X">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://facebook.com/mateable" aria-label="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://linkedin.com/company/mateable" aria-label="LinkedIn">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://discord.gg/JWafFNx6Kv" aria-label="Discord">
                            <i class="fa fa-comments"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 text-md-end text-center">
                <ul class="list-inline quicklinks mb-0 small">
                    <li class="list-inline-item">
                        <a class="text-dark-emphasis" href="/legal?type=privacypolicy">
                            Privacy
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-dark-emphasis" href="/legal?type=serviceterms">
                            Terms
                        </a>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</footer>
</div>-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>