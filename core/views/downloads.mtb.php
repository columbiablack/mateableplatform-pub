<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

?>
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Downloads</h2>
                </div>
                <div class="block-content">
                    <p class="text-info">
                        <?php
                            var_dump(Platform::$app->view->getLayouts());
                            //var_dump(scandir(Platform::$ROOT_DIR.'/core/views/layouts/')) ?? [];
                        ?>
                    </p>
                </div>
            </div>
        </section>
