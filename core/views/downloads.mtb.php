<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

?>
        <section class="clean-block dark">
            <div class="container col-md-4">
                <div class="block-heading">
                    <h2 class="text-info">Downloads</h2>
                </div>
                <div class="block-content">
                <?php
                    if(!Platform::$app->downloads->count){
                        echo '
                            <p>
                                Either there are no downloads listed at this moment or the Downloads database is down.<br><br>
                                If you are looking to download a copy of your Mateable Coin™ digital wallet visit <a href="https://coin.mateable.com/">MateableCoin\'s[MTBC] site</a>.
                            </p>                        
                        ';
                    }else{

                    }
                ?>
                </div>
            </div>
        </section>
