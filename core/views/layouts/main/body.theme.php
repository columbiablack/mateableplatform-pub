<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

use mateable\core\Platform;

?>
<main id="mainContent">
<?php if (Platform::$app->session->getFlash('success')): ?>
    <header class="masthead pt-5">
        <div class="content-section container container-fluid">
            <?php if (Platform::$app->session->getFlash('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <p style="text-align: center;"><?php echo Platform::$app->session->getFlash('success'); ?></p>
                </div>
            <?php endif; ?>
            <?php if (Platform::$app->session->getFlash('warning')): ?>
                <div class="alert alert-warning alert-dismissible fade show">
                    <?php echo Platform::$app->session->getFlash('warning'); ?>
                </div>
            <?php endif; ?>
        </div>
    </header>
<?php endif; ?>

{{content}}
</main>
