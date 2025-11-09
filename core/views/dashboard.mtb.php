<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
* user: Mateable
*/

use mateable\core\Platform;

?>
    <section>
        <div class="container" style="min-height: 500px;">
            <div class="row">
                <?php if (Platform::$app->user->role >= Platform::$app->user::ROLE_MODERATOR): ?>
                    <div class="flex-fill clean-info card-title block-heading">
                        <h4 class="text-warning card-title">Administration Menu</h4>
                    </div>
                    <div class="row dark">
                        <div class="clean-catalog container">
                            <div class="row justify-content-center">
                                <?php if (Platform::$app->user->role === Platform::$app->user::ROLE_ADMINISTRATOR): ?>
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="border-1 rounded-pill card text-center clean-card bg-danger">
                                            <a class="dropdown-item" href="#"><i
                                                        class="icon-screen-desktop card-img-top w-100 d-block"></i>
                                                Administration Panel</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="border-1 rounded-pill card text-center clean-card">
                                        <a class="dropdown-item" href="#"><i
                                                    class="icon-list card-img-top w-100 d-block"></i> User
                                            Privileges</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="border-1 rounded-pill card text-center clean-card">
                                        <a class="dropdown-item" href="#"><i
                                                    class="icon-list card-img-top w-100 d-block"></i> Conference
                                            Room</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="border-1 rounded-pill card text-center clean-card">
                                        <a class="dropdown-item" href="#"><i
                                                    class="icon-list card-img-top w-100 d-block"></i> Service
                                            Message</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
