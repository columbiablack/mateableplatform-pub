<?php
/**
 * Copyright (c) 2026. Mateable LLC
 */
?>
<section class="py-5">
    <div class="container py-4">
        <div class="row g-4 align-items-start">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, rgba(8,16,32,0.95), rgba(17,29,49,0.95));">
                    <div class="card-body p-4 p-lg-5">
                        <p class="text-info mb-2 fw-semibold">Mateable Store</p>
                        <h1 class="display-6 fw-bold mb-3">Browse the marketplace for games, software, and team rewards.</h1>
                        <p class="text-muted mb-4">
                            The store now renders as a real catalog view, with category-driven browsing and static product cards that fit the current MVC structure.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="/store?section=games" class="btn mateable-outline-btn">Games</a>
                            <a href="/store?section=software" class="btn mateable-outline-btn">Software</a>
                            <a href="/store?section=rewards" class="btn mateable-outline-btn">Rewards</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">Current section</h5>
                        <div class="text-info fw-semibold"><?= htmlspecialchars($sectionLabel ?? 'Games') ?></div>
                        <p class="text-muted mt-2 mb-0">Explore featured digital items, creator tools, and reward bundles built for your community.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-semibold mb-3"><?= htmlspecialchars($sectionLabel ?? 'Games') ?> catalog</h4>
                        <div class="row g-3">
                            <?php foreach (($catalog ?? []) as $item): ?>
                                <div class="col-md-6 col-xl-4">
                                    <div class="border rounded-3 p-3 h-100">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="badge bg-info-subtle text-info"><?= htmlspecialchars($item['badge'] ?? 'Featured') ?></span>
                                            <span class="fw-semibold text-warning"><?= htmlspecialchars($item['price'] ?? '$0.00') ?></span>
                                        </div>
                                        <h6 class="fw-semibold mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                        <div class="text-muted small"><?= htmlspecialchars($item['type']) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
