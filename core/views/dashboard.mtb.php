<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
* user: Mateable
*/

use mateable\core\form\Form;
use mateable\core\Platform;

?>
        <section class="content-section clean-block">
            <div class="container">
                <div id="userOverlay">
                    <div id="userOverlayText" class="card clean-form row">
                        <div class="card-header mb-3">
                            <h2 class="text-primary">Content</h2>
                            <button class="exit-button" onclick="userOverlayOff()">X</button>
                        </div>
                        <div class="card-body text-secondary mb-1">
                            <?php
                                $postForm = Form::begin('','post');
                                echo $postForm->fieldTextArea($postModel,'postContent','width: 360pt;height: 240pt;resize: none;');
                                echo $postForm->field($postModel, 'fileInput','fileInput','video/*')->fileField();
                                echo $postForm->button('Post','','','userOverlayOff()');
                                echo $postForm::end();
                            ?>
                        </div>
                    </div>
                </div>
                <?php if(Platform::$app->user->role >= Platform::$app->user::ROLE_MODERATOR): ?>
                <div class="flex-fill clean-info card-title block-heading">
                    <h4 class="text-warning card-title">Administration Menu</h4>
                </div>
                <div class="row dark">
                    <div class="clean-catalog container">
                        <div class="row justify-content-center">
                            <?php if(Platform::$app->user->role === Platform::$app->user::ROLE_ADMINISTRATOR): ?>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card bg-danger">
                                    <a class="dropdown-item" href="#"><i class="icon-screen-desktop card-img-top w-100 d-block"></i> Administration Panel</a>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-list card-img-top w-100 d-block"></i> User Privileges</a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-list card-img-top w-100 d-block"></i> Conference Room</a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-list card-img-top w-100 d-block"></i> Service Message</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="border-1 block-heading">
                    <h4 class="text-info card-title">Socialize</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-frame card-img-top w-100 d-block"></i> My Channel</a>
                        </div>
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-screen-desktop card-img-top w-100 d-block"></i> My Videos</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-list card-img-top w-100 d-block"></i> Subscriptions</a>
                        </div>
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="/messages"><i class="icon-bubbles card-img-top w-100 d-block"></i> Messages</a>
                        </div>
                    </div>
                </div>
                <!-- <div class="flex-fill clean-info card-title block-heading">
                    <h4 class="text-info card-title">Learn & Earn</h4>
                </div>
                <div class="row dark">
                    <div class="clean-catalog container">
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-book-open card-img-top w-100 d-block"></i> Cryptocurrency Tutorials</a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-trophy card-img-top w-100 d-block"></i> MTBC Surveys</a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-book-open card-img-top w-100 d-block"></i> Mateablecoin(MTBC) Tutorials</a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-link card-img-top w-100 d-block"></i> Refer a friend</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="flex-fill clean-info card-title block-heading">
                    <h4 class="text-info card-title">Finances</h4>
                </div>
                <div class="row dark">
                    <div class="clean-catalog container">
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="/walletmanager"><i class="icon-wallet card-img-top w-100 d-block"></i> MTBC Wallet</a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-chemistry card-img-top w-100 d-block"></i> MTBC Explorer</a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="/walletmanager/transactions"><i class="icon-clock card-img-top w-100 d-block"></i> Transactions History</a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="/walletmanager/transactions"><i class="icon-graph card-img-top w-100 d-block"></i> Finance Graph</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-fill clean-info card-title block-heading">
                    <h4 class="text-info card-title">Help</h4>
                </div>
                <div class="row dark">
                    <div class="clean-catalog container">
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="./contactus"><i class="icon-pencil bubble card-img-top w-100 d-block"></i> Contact Us</a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-question card-img-top w-100 d-block"></i> F.A.Q.</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content-section">
            <div class="container">
                <div class="clean-block">
                    <div class="flex-fill clean-info card-title block-heading">
                        <h4 class="text-warning card-title">Sponsored by</h4>
                    </div>
                    <div class="carousel slide justify-content-center w-100" data-bs-ride="carousel" id="carousel-1">
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
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="https://www.coingecko.com/en/coins/mateable"><img src="assets/img/CoinGecko-WhiteText.svg" style="height: 250px; width: 320px;"></a>
                            </div>
                            <div class="carousel-item">
                                <a href=" https://coincodex.com/crypto/mateablecoin/"><img src="assets/img/cc-logo-png.png" style="height: 160px; width: 320px;"></a>
                            </div>
                            <div class="carousel-item">
                                <a href="https://coinpaprika.com/coin/mtbc-mateablecoin/"><img src="assets/img/paprika.svg" style="height: 160px; width: 320px;"></a>
                            </div>
                            <div class="carousel-item">
                                <a href="https://www.livecoinwatch.com/price/MateableCoin-_MTBC"><img src="assets/img/logotype-light-on-dark-color.png" style="height: 160px; width: 320px;"></a>
                            </div>
                            <div class="carousel-item">
                                <a href="https://blockspot.io/coin/mateablecoin/"><img src="assets/img/250x90.png" style="height: 250px; width: 320px;"></a>
                            </div>
                        </div>
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
                            <li data-bs-target="#carousel-1" data-bs-slide-to="3"></li>
                            <li data-bs-target="#carousel-1" data-bs-slide-to="4"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
