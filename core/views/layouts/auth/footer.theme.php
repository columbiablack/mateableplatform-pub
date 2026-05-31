<?php

/**
 * Copyright (c) 2025-2026. Mateable LLC
 */

?>
<footer class="pt-5 pb-4 border-top">
    <div class="container">

        <!-- Top Section -->
        <div class="row mb-4">

            <!-- Brand / Description -->
            <div class="col-md-4 mb-3">
                <h5 class="text-uppercase">{{app_name}}</h5>
                <p class="text-muted small">
                    {{app_name}} is a next-generation gaming platform where players compete,
                    connect, and grow through tournaments, community-driven features,
                    and creator-focused tools.
                </p>
            </div>

            <!-- Platform Links -->
            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase">Platform</h6>
                <ul class="list-unstyled small">
                    <li><a class="text-dark-emphasis" href="/about">About</a></li>
                    <li><a class="text-dark-emphasis" href="/how-it-works">How It Works</a></li>
                    <li><a class="text-dark-emphasis" href="/roadmap">Roadmap</a></li>
                    <li><a class="text-dark-emphasis" href="/careers">Careers</a></li>
                </ul>
            </div>

            <!-- Community Links -->
            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase">Community</h6>
                <ul class="list-unstyled small">
                    <li><a class="text-dark-emphasis" href="/community/forums">Forums</a></li>
                    <li><a class="text-dark-emphasis" href="/tournaments">Tournaments</a></li>
                    <li><a class="text-dark-emphasis" href="/events">Events</a></li>
                    <li><a class="text-dark-emphasis" href="/leaderboards">Leaderboards</a></li>
                </ul>
            </div>

            <!-- Support Links -->
            <div class="col-md-2 mb-3">
                <h6 class="text-uppercase">Support</h6>
                <ul class="list-unstyled small">
                    <li><a class="text-dark-emphasis" href="/help">Help Center</a></li>
                    <li><a class="text-dark-emphasis" href="/contact">Contact</a></li>
                    <li><a class="text-dark-emphasis" href="/account-recovery">Account Recovery</a></li>
                    <li><a class="text-dark-emphasis" href="/report">Report Abuse</a></li>
                </ul>
            </div>

            <!-- Legal Links -->
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

        <!-- Bottom Section -->
        <div class="row align-items-center">

            <!-- Copyright -->
            <div class="col-md-4 text-md-start text-center mb-2 mb-md-0">
                <span class="copyright small text-muted">
                    © <?php echo date('Y'); ?>
                    <a class="text-dark-emphasis" href="{{site_url}}">
                        {{app_name}} LLC
                    </a>. All rights reserved.
                </span>
            </div>

            <!-- Social Links -->
            <div class="col-md-4 text-center mb-2 mb-md-0">
                <ul class="list-inline social-buttons mb-0">
                    <li class="list-inline-item">
                        <a href="https://x.com/mateablemedia" aria-label="X">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://facebook.com/mateablemedia" aria-label="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://linkedin.com/company/mateablemedia" aria-label="LinkedIn">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://discord.gg/yourinvite" aria-label="Discord">
                            <i class="fa fa-comments"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Quick Legal -->
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
<!-- Modal Begin -->
<div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="matchMaking">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <h2 class="text-uppercase">Matchmaking</h2>
                            <p class="text-muted item-intro">Skill-based game pairing.</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/features/matchmaking2.jpg" alt="Matchmaking">

                            <p>
                                Matchmaking is designed to create fair and competitive matches by
                                evaluating player performance, skill rating, and recent activity.
                                Players are paired with opponents of similar ability to ensure
                                consistent challenge and improvement.
                            </p>

                            <p>
                                The system adapts over time, adjusting ratings as players improve
                                or change play styles. This prevents one-sided matches and supports
                                long-term competitive integrity.
                            </p>

                            <ul class="list-unstyled">
                                <li><strong>Basis:</strong> Skill & Performance Metrics</li>
                                <li><strong>Modes:</strong> Casual and Competitive</li>
                                <li><strong>Goal:</strong> Fair, Balanced Matches</li>
                            </ul>

                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">
                                <i class="fa fa-times"></i><span>&nbsp;Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="rankedLadders">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <h2 class="text-uppercase">Ranked Ladders</h2>
                            <p class="text-muted item-intro">Seasonal competitive progression.</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/features/rankedladders.jpg" alt="Ranked Ladders">

                            <p>
                                Ranked ladders track player performance across competitive seasons.
                                Wins, losses, and consistency affect placement, allowing players
                                to climb tiers and earn recognition based on skill.
                            </p>

                            <p>
                                Each season resets rankings while preserving historical stats,
                                ensuring fresh competition without erasing long-term achievements.
                            </p>

                            <ul class="list-unstyled">
                                <li><strong>Structure:</strong> Tiered Rankings</li>
                                <li><strong>Seasons:</strong> Time-Based Resets</li>
                                <li><strong>Progress:</strong> Skill-Driven Advancement</li>
                            </ul>

                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">
                                <i class="fa fa-times"></i><span>&nbsp;Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="tournaments">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <h2 class="text-uppercase">Tournaments</h2>
                            <p class="text-muted item-intro">Organized competitive events.</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/features/tournaments.jpg" alt="Tournaments">

                            <p>
                                Tournaments allow players to compete in structured events with
                                defined rules, brackets, and scoring systems. These events are
                                designed to highlight skill, teamwork, and consistency.
                            </p>

                            <p>
                                Events may be open, invite-only, or ranked, and can support both
                                solo and team-based competition.
                            </p>

                            <ul class="list-unstyled">
                                <li><strong>Formats:</strong> Solo, Team, Bracket</li>
                                <li><strong>Tracking:</strong> Automatic Results</li>
                                <li><strong>Rewards:</strong> Achievements & Recognition</li>
                            </ul>

                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">
                                <i class="fa fa-times"></i><span>&nbsp;Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="playerProfiles">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <h2 class="text-uppercase">Player Profiles</h2>
                            <p class="text-muted item-intro">Your competitive identity.</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/features/playerprofiles2.jpg" alt="Player Profiles">

                            <p>
                                Player profiles display competitive history, rankings, achievements,
                                and performance statistics. Profiles are built automatically from
                                gameplay data and reflect real results.
                            </p>

                            <p>
                                This creates a reputation system based on skill and consistency,
                                not follower counts or activity volume.
                            </p>

                            <ul class="list-unstyled">
                                <li><strong>Includes:</strong> Stats & Rankings</li>
                                <li><strong>History:</strong> Match & Season Records</li>
                                <li><strong>Focus:</strong> Performance Over Popularity</li>
                            </ul>

                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">
                                <i class="fa fa-times"></i><span>&nbsp;Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="creators">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <h2 class="text-uppercase">Creators</h2>
                            <p class="text-muted item-intro">Content built around competition.</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/features/creators2.jpg" alt="Creators">

                            <p>
                                Creators can stream gameplay, host tournaments, and produce
                                educational or competitive content directly on the platform.
                                Visibility is driven by quality and engagement, not algorithms.
                            </p>

                            <p>
                                Creator tools are designed to support events, communities, and
                                skill-focused content without intrusive advertising.
                            </p>

                            <ul class="list-unstyled">
                                <li><strong>Tools:</strong> Streaming & Event Hosting</li>
                                <li><strong>Focus:</strong> Competitive Content</li>
                                <li><strong>Monetization:</strong> Transparent & Optional</li>
                            </ul>

                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">
                                <i class="fa fa-times"></i><span>&nbsp;Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-center portfolio-modal" role="dialog" tabindex="-1" id="developers">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <h2 class="text-uppercase">Developers</h2>
                            <p class="text-muted item-intro">Build and publish competitive games.</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/features/developers.jpg" alt="Developers">

                            <p>
                                Developers can integrate games into the platform using provided
                                APIs and tools for matchmaking, rankings, and tournaments.
                                This allows games to immediately support competitive play.
                            </p>

                            <p>
                                The platform is designed to support long-term growth through
                                modding, updates, and community-driven improvements.
                            </p>

                            <ul class="list-unstyled">
                                <li><strong>Support:</strong> APIs & SDKs</li>
                                <li><strong>Integration:</strong> Rankings & Events</li>
                                <li><strong>Goal:</strong> Sustainable Competitive Ecosystem</li>
                            </ul>

                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">
                                <i class="fa fa-times"></i><span>&nbsp;Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>