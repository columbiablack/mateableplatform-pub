<?php
/**
 * Copyright (c) 2026. Mateable LLC
 */

use mateable\core\models\TournamentModel;

/** @var TournamentModel[] $tournaments */
/** @var array<int, string> $creators */
/** @var array<string, int> $counts */
/** @var string $status */
?>
<section class="pt-4 pb-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">Tournament Moderation</h1>
                <p class="text-muted mb-0">Review tournament submissions, event status, and competitive activity.</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-semibold mb-0">Tournament queue</h5>
                    <a href="/admdash" class="btn btn-sm btn-outline-secondary">Back to Administration</a>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-sm-3"><a href="/admdash/tournaments?status=all" class="text-decoration-none"><div class="border rounded p-3"><div class="small text-muted">All</div><div class="h4 mb-0"><?= (int) ($counts['all'] ?? 0) ?></div></div></a></div>
                    <div class="col-sm-3"><a href="/admdash/tournaments?status=pending" class="text-decoration-none"><div class="border rounded p-3"><div class="small text-muted">Pending</div><div class="h4 mb-0 text-warning"><?= (int) ($counts['pending'] ?? 0) ?></div></div></a></div>
                    <div class="col-sm-3"><a href="/admdash/tournaments?status=approved" class="text-decoration-none"><div class="border rounded p-3"><div class="small text-muted">Approved</div><div class="h4 mb-0 text-success"><?= (int) ($counts['approved'] ?? 0) ?></div></div></a></div>
                    <div class="col-sm-3"><a href="/admdash/tournaments?status=rejected" class="text-decoration-none"><div class="border rounded p-3"><div class="small text-muted">Rejected</div><div class="h4 mb-0 text-danger"><?= (int) ($counts['rejected'] ?? 0) ?></div></div></a></div>
                </div>
                <div class="small text-muted mb-3">Showing: <?= htmlspecialchars(ucfirst($status ?? 'all')) ?></div>
                <?php if (empty($tournaments)): ?>
                    <div class="border rounded p-4 text-muted">No tournaments have been submitted yet.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead><tr><th>Title</th><th>Game</th><th>Creator</th><th>Starts</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                            <tbody>
                            <?php foreach ($tournaments as $tournament): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($tournament->title) ?></strong><br><small class="text-muted"><?= htmlspecialchars($tournament->description) ?></small></td>
                                    <td><?= htmlspecialchars($tournament->game) ?></td>
                                    <td><?= htmlspecialchars($creators[$tournament->id] ?? 'Unknown user') ?></td>
                                    <td><?= htmlspecialchars($tournament->starts_at) ?></td>
                                    <td><span class="badge <?= $tournament->moderation_status === 'approved' ? 'bg-success' : ($tournament->moderation_status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark') ?>"><?= htmlspecialchars(ucfirst($tournament->moderation_status)) ?></span></td>
                                    <td class="text-end">
                                        <form action="/admdash/tournaments/moderate" method="post" class="d-inline-flex gap-1 mb-1">
                                            <input type="hidden" name="id" value="<?= (int) $tournament->id ?>">
                                            <button type="submit" name="moderation_status" value="approved" class="btn btn-sm btn-outline-success">Approve</button>
                                            <button type="submit" name="moderation_status" value="rejected" class="btn btn-sm btn-outline-warning">Reject</button>
                                        </form>
                                        <form action="/admdash/tournaments/delete" method="post" onsubmit="return confirm('Delete this tournament?');">
                                            <input type="hidden" name="id" value="<?= (int) $tournament->id ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
