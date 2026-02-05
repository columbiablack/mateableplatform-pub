<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */

?>
<section>
    <div class="container">
        <div class="row">
            <h2>Results</h2>
            <?php if (empty($results)): ?>
                <p>No results found.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($results as $r): ?>
                        <li><?= htmlspecialchars($r) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>
