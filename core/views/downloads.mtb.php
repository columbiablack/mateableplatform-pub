<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

?>
<section id="dashboard" class="bg-light pt-4 pb-5">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-3">
                <h1 class="fw-bold text-info">
                    General Downloads
                </h1>
                <p class="alert text-center text-muted alert-info mb-2">
                    Powered by VidGiggles™.
                </p>
            </div>
        </div>
        <!-- Stats Row -->
        <div class="row g-3 mb-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <?php
                        if(!isset(Platform::$app->downloads->listDownloads)){
                            echo '
                            <p>
                                '.Platform::$app->downloads->listDownloads.'Either there are no downloads listed at this moment or the Downloads database is down.<br><br>
                                If you are looking to download a copy of your Mateable Coin™ digital wallet visit <a href="https://coin.mateable.com/">MateableCoin\'s[MTBC] site</a>.
                            </p>                        
                        ';
                        }else{
                            // Show Downloads List Code Here
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
