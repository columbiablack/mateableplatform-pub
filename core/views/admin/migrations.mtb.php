<?php
/**
 * Copyright (c) 2026. Mateable LLC
 */

/** @var string $migrationOutput */
?>
<section class="pt-4 pb-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">Database Migrations</h1>
                <p class="text-muted mb-0">Apply pending database changes for the Mateable platform.</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <pre class="mb-0 text-wrap"><?= $migrationOutput ?? '' ?></pre>
            </div>
        </div>
    </div>
</section>