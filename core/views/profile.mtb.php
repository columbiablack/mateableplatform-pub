<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
* user: Mateable
*/

use mateable\core\Platform;

?>
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="border-1 block-heading">
                    <h4 class="text-info card-title"><?php echo Platform::$app->user->displayFirstName().'\'s' ?? '' ?> Dashboard</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-people card-img-top w-100 d-block"></i> Contacts</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-screen-desktop card-img-top w-100 d-block"></i> Marketplace</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-list card-img-top w-100 d-block"></i> Subscriptions</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-screen-desktop card-img-top w-100 d-block"></i> Videos</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-picture card-img-top w-100 d-block"></i> Photo Gallery</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-bubbles card-img-top w-100 d-block"></i> Personal Messages</a>
                        </div>
                    </div>
                </div>
                <div class="border-1 block-heading">
                    <h4 class="text-info card-title">Finance</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-wallet card-img-top w-100 d-block"></i> MTBC Wallet</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-credit-card card-img-top w-100 d-block"></i> Credit Cards</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-chemistry card-img-top w-100 d-block"></i> Explorer</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="border-1 rounded-pill card text-center clean-card">
                            <a class="dropdown-item" href="#"><i class="icon-clock card-img-top w-100 d-block"></i> Transactions History</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
