<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
* user: Mateable
*/

use mateable\core\Platform;

?>
        <section class="content-section clean-block">
            <div class="clean-info container">
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
                            <a class="dropdown-item" href="#"><i class="icon-list card-img-top w-100 d-block"></i> My Subscriptions</a>
                        </div>
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-frame card-img-top w-100 d-block"></i> My Channel</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-screen-desktop card-img-top w-100 d-block"></i> My Videos</a>
                        </div>
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-bubbles card-img-top w-100 d-block"></i> Messages</a>
                        </div>
                    </div>
                </div>
                <div class="flex-fill clean-info card-title block-heading">
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
                                    <a class="dropdown-item" href="#"><i class="icon-book-open card-img-top w-100 d-block"></i> Mateablecoin(MTBC) Tutorials</a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-trophy card-img-top w-100 d-block"></i> MTBC Surveys</a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="#"><i class="icon-link card-img-top w-100 d-block"></i> Refer a friend</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <a class="dropdown-item" href="#"><i class="icon-chemistry card-img-top w-100 d-block"></i> Explorer</a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="border-1 rounded-pill card text-center clean-card">
                                    <a class="dropdown-item" href="/walletmanager/transactions"><i class="icon-clock card-img-top w-100 d-block"></i> Transactions History</a>
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
