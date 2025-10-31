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
    <section class="clean-block">
        <div class="container" style="min-height: 500px;">
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
