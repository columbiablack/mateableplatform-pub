<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

?>
    <section>
        <div class="container">
            <div class="row">
                <div class="block-heading">
                    <h2 class="h2 mb-4 text-info" style="text-align: center;">Downloads</h2>
                </div>
                <div class="alert alert-info" style="text-align: center;">Powered by VidGiggles™.</div>
            </div>
            <div class="row">
                <div class="block-content">
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
    </section>
