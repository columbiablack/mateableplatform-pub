<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

/***
 *  user: Mateable
 */

use mateable\core\Platform;

?>
<main class="home-page">
    <section class="hero">
        <div class="container hero-inner">
            <div class="row align-items-center g-5">
                <div class="col-xl-7">
                    <span class="s-label">Mateable Media</span>
                    <h1 class="hero-title">Competitive gaming, designed around skill and community.</h1>
                    <p class="hero-sub">
                        Discover tournaments, creators, game rewards, and a digital ecosystem where performance matters more than hype.
                    </p>

                    <div class="hero-actions d-flex flex-wrap gap-3 mb-4">
                        <a href="/signup" class="btn btn-primary">Create Account</a>
                        <a href="/tournaments" class="btn btn-outline-light">Explore Tournaments</a>
                    </div>

                    <div class="hero-stats-bar">
                        <div class="hs">
                            <span class="hs-label">Players</span>
                            <span class="hs-val">18K+</span>
                        </div>
                        <div class="hs-sep"></div>
                        <div class="hs">
                            <span class="hs-label">Tournaments</span>
                            <span class="hs-val">240</span>
                        </div>
                        <div class="hs-sep"></div>
                        <div class="hs">
                            <span class="hs-label">Creators</span>
                            <span class="hs-val">1.2K</span>
                        </div>
                        <div class="hs-sep"></div>
                        <div class="hs">
                            <span class="hs-label">MTBC</span>
                            <span class="hs-val">$0.0000285</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-caret">⌄</div>
    </section>

    <section class="ecosystem-section bg-b">
        <div class="container">
            <div class="hero-ecosystem-column">
                <div class="g-card hero-ecosystem-card" style="padding: 1.5rem; border-radius: 22px;">
                    <div class="ecosystem-header mb-3">
                        <div>
                            <span class="text-uppercase small s-label" style="letter-spacing: .12em;">Live ecosystem</span>
                            <h4 class="mb-0 text-white">Mateable Coin</h4>
                        </div>
                        <span class="badge bg-success-subtle text-success" style="border: 1px solid rgba(25,135,84,0.3);">Online</span>
                    </div>

                    <div class="ecosystem-market p-3 rounded-4" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(108,92,231,0.22);">
                        <div class="small text-uppercase" style="color: rgba(255,255,255,0.45); letter-spacing: .1em;">Market</div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div>
                                <div class="display-6 fw-bold text-white">$0.0000285</div>
                                <div class="text-success small">+4.32% today</div>
                            </div>
                            <div class="text-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 54px; height: 54px; background: linear-gradient(135deg, rgba(108,92,231,0.28), rgba(162,155,254,0.18)); color: #fff; font-size: 1.5rem;">
                                    <i class="bi bi-coin"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 ecosystem-tiles">
                        <div class="col-6">
                            <div class="g-card" style="padding: 1rem; min-height: 110px;">
                                <div class="small text-uppercase" style="color: rgba(255,255,255,0.45);">Wallet</div>
                                <div class="mt-2 fw-bold text-white">Fast setup</div>
                                <div class="small mt-1" style="color: rgba(255,255,255,0.55);">Desktop + mobile</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="g-card" style="padding: 1rem; min-height: 110px;">
                                <div class="small text-uppercase" style="color: rgba(255,255,255,0.45);">Rewards</div>
                                <div class="mt-2 fw-bold text-white">Earn + trade</div>
                                <div class="small mt-1" style="color: rgba(255,255,255,0.55);">MTBC ecosystem</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-a" style="padding-top: 5rem; padding-bottom: 5rem;">
        <div class="container">
            <div class="text-center mb-5">
                <span class="s-label">Platform features</span>
                <h2 class="s-title text-white">Everything built for competitive gaming</h2>
                <p class="s-desc">From discovery and matchmaking to tournaments and creator support, every part of the experience is designed to keep the focus on play.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-xl-3">
                    <div class="g-card">
                        <div class="feat-icon"><i class="bi bi-controller"></i></div>
                        <h4 class="text-white mb-2">Matchmaking</h4>
                        <p class="mb-0" style="color: rgba(255,255,255,0.65);">Skill-based grouping and fair competition across players, scrims, and seasons.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="g-card">
                        <div class="feat-icon"><i class="bi bi-trophy"></i></div>
                        <h4 class="text-white mb-2">Tournaments</h4>
                        <p class="mb-0" style="color: rgba(255,255,255,0.65);">Launch events, brackets, rankings, and recurring competitive loops for communities.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="g-card">
                        <div class="feat-icon"><i class="bi bi-people"></i></div>
                        <h4 class="text-white mb-2">Creators</h4>
                        <p class="mb-0" style="color: rgba(255,255,255,0.65);">Support streaming, spotlight feeds, showcases, and creator-led community events.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="g-card">
                        <div class="feat-icon"><i class="bi bi-wallet2"></i></div>
                        <h4 class="text-white mb-2">Wallet</h4>
                        <p class="mb-0" style="color: rgba(255,255,255,0.65);">Secure transactions, rewards, and digital asset support built around MTBC usage.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-b" style="padding-top: 5rem; padding-bottom: 5rem;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="s-label">The ecosystem</span>
                    <h2 class="s-title text-white">Built for players, creators, and communities</h2>
                    <p class="s-desc text-start" style="margin: 0 0 2rem 0; max-width: none;">Mateable is more than a games site. It is an ecosystem of competition, profiles, digital rewards, and social discovery.</p>

                    <div class="d-grid gap-3">
                        <div class="g-card" style="padding: 1.25rem;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(108,92,231,0.15); color: #a29bfe;">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-white">Player profiles</h5>
                                    <p class="mb-0" style="color: rgba(255,255,255,0.6);">Stats, achievements, performance history, and status tracking.</p>
                                </div>
                            </div>
                        </div>

                        <div class="g-card" style="padding: 1.25rem;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(108,92,231,0.15); color: #a29bfe;">
                                    <i class="bi bi-broadcast"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-white">Streaming + discovery</h5>
                                    <p class="mb-0" style="color: rgba(255,255,255,0.6);">Feature streamers, collect clips, and promote community highlights.</p>
                                </div>
                            </div>
                        </div>

                        <div class="g-card" style="padding: 1.25rem;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(108,92,231,0.15); color: #a29bfe;">
                                    <i class="bi bi-shop"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-white">Store + rewards</h5>
                                    <p class="mb-0" style="color: rgba(255,255,255,0.6);">Games, software, and digital goods tied to the broader Mateable universe.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="g-card" style="padding: 1.5rem;">
                        <div class="mb-4">
                            <div class="small text-uppercase" style="letter-spacing: .12em; color: rgba(255,255,255,0.5);">Featured moments</div>
                            <h3 class="mt-2 text-white">This week’s competitive highlights</h3>
                        </div>

                        <div class="d-grid gap-3">
                            <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(108,92,231,0.14);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="text-white">Season Cup</strong>
                                    <span class="badge bg-primary-subtle text-primary">Live</span>
                                </div>
                                <div class="small mt-2" style="color: rgba(255,255,255,0.6);">Bracket finals and global rankings are now active.</div>
                            </div>
                            <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(108,92,231,0.14);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="text-white">Creator spotlight</strong>
                                    <span class="badge bg-secondary-subtle text-secondary">Featured</span>
                                </div>
                                <div class="small mt-2" style="color: rgba(255,255,255,0.6);">New streams, showcases, and community event coverage are trending.</div>
                            </div>
                            <div class="p-3 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(108,92,231,0.14);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="text-white">MTBC rewards</strong>
                                    <span class="badge bg-success-subtle text-success">Updated</span>
                                </div>
                                <div class="small mt-2" style="color: rgba(255,255,255,0.6);">New reward activity and player incentives are live this week.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-a" style="padding-top: 5rem; padding-bottom: 5rem;">
        <div class="container">
            <div class="text-center mb-5">
                <span class="s-label">Latest updates</span>
                <h2 class="s-title text-white">News and community activity</h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="g-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="mb-0 text-white">Community news</h3>
                            <a href="/news" class="btn btn-outline-secondary">View all</a>
                        </div>
                        {{news_posts}}
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="g-card">
                        <h3 class="text-white mb-4">Quick access</h3>

                        <div class="d-grid gap-3">
                            <a href="/downloads" class="p-3 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(108,92,231,0.14); color: #fff; display: block;">
                                <div class="fw-semibold">Download wallet</div>
                                <div class="small mt-1" style="color: rgba(255,255,255,0.6);">Install the wallet and start with MTBC.</div>
                            </a>
                            <a href="/tournaments" class="p-3 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(108,92,231,0.14); color: #fff; display: block;">
                                <div class="fw-semibold">Browse tournaments</div>
                                <div class="small mt-1" style="color: rgba(255,255,255,0.6);">Find events and competition opportunities.</div>
                            </a>
                            <a href="/messages" class="p-3 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(108,92,231,0.14); color: #fff; display: block;">
                                <div class="fw-semibold">Messages</div>
                                <div class="small mt-1" style="color: rgba(255,255,255,0.6);">Stay connected with your community and teammates.</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-b" style="padding-top: 5rem; padding-bottom: 5rem;">
        <div class="container">
            <div class="text-center mb-5">
                <span class="s-label">Ways to participate</span>
                <h2 class="s-title text-white">Get involved with the platform</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="g-card participation-card">
                        <div class="feat-icon"><i class="bi bi-joystick"></i></div>
                        <h4 class="text-white mb-2">Play</h4>
                        <p class="mb-3" style="color: rgba(255,255,255,0.64);">Join games, build rankings, and compete in events designed for skill-based achievement.</p>
                        <a href="/signup" class="btn btn-primary w-100">Join now</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="g-card participation-card">
                        <div class="feat-icon"><i class="bi bi-camera-video"></i></div>
                        <h4 class="text-white mb-2">Create</h4>
                        <p class="mb-3" style="color: rgba(255,255,255,0.64);">Stream, share clips, and build a creator presence inside the community and event discovery flow.</p>
                        <a href="/creators-streams" class="btn btn-outline-light w-100">Creator hub</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="g-card participation-card">
                        <div class="feat-icon"><i class="bi bi-graph-up-arrow"></i></div>
                        <h4 class="text-white mb-2">Grow</h4>
                        <p class="mb-3" style="color: rgba(255,255,255,0.64);">Track your progress, collect rewards, and take part in the broader MTBC and game economy.</p>
                        <a href="/walletmanager" class="btn btn-outline-light w-100">Wallet access</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-a" style="padding-top: 5rem; padding-bottom: 5rem;">
        <div class="container">
            <div class="g-card text-center" style="padding: 2.5rem 1.5rem;">
                <span class="s-label">Ready to start?</span>
                <h2 class="s-title text-white">Join the next generation of competitive gaming.</h2>
                <p class="s-desc" style="margin: 0 auto 2rem; max-width: 700px;">Whether you want to play, compete, stream, or earn through community activity, Mateable gives you a full pathway to engage with the ecosystem.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="/signup" class="btn btn-primary">Create account</a>
                    <a href="/about" class="btn btn-outline-light">Learn more</a>
                </div>
            </div>
        </div>
    </section>
</main>
