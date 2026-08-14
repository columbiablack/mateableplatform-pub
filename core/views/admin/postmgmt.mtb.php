<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

use mateable\core\models\PostModel;

/** @var PostModel[] $posts */
/** @var array<int, string> $postAuthors */
/** @var string $query */
/** @var string $status */
?>
<section class="pt-4 pb-5">
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12">
				<h1 class="fw-bold text-info">Post Management</h1>
				<p class="text-muted mb-0">Review community posts and remove content that violates platform guidelines.</p>
			</div>
		</div>

		<div class="card border-0 shadow-sm">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center mb-3">
					<h5 class="fw-semibold mb-0">Community posts</h5>
					<a href="/admdash" class="btn btn-sm btn-outline-secondary">Back to Administration</a>
				</div>
				<form action="/admdash/postmgmt" method="get" class="row g-2 mb-4">
					<div class="col-md-7">
						<label for="post-search" class="visually-hidden">Search posts</label>
						<input id="post-search" name="q" class="form-control" value="<?= htmlspecialchars($query ?? '') ?>" placeholder="Search post content">
					</div>
					<div class="col-md-3">
						<label for="post-status" class="visually-hidden">Filter by status</label>
						<select id="post-status" name="status" class="form-select">
							<option value="all" <?= ($status ?? 'all') === 'all' ? 'selected' : '' ?>>All statuses</option>
							<option value="pending" <?= ($status ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
							<option value="approved" <?= ($status ?? '') === 'approved' ? 'selected' : '' ?>>Approved</option>
							<option value="rejected" <?= ($status ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
						</select>
					</div>
					<div class="col-md-2 d-grid">
						<button type="submit" class="btn btn-primary">Filter</button>
					</div>
				</form>

				<?php if (empty($posts)): ?>
					<div class="border rounded p-4 text-muted">
						No community posts are available for review.
					</div>
				<?php else: ?>
					<div class="table-responsive">
						<table class="table table-hover align-middle">
							<thead>
							<tr>
								<th>ID</th>
								<th>Author</th>
								<th>Content</th>
								<th>Created</th>
								<th>Status</th>
								<th class="text-end">Action</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($posts as $post): ?>
								<tr>
									<td><?= (int) $post->id ?></td>
									<td><?= htmlspecialchars($postAuthors[$post->id] ?? 'Unknown user') ?></td>
									<td class="text-break" style="min-width: 240px; max-width: 520px;"><?= nl2br(htmlspecialchars($post->content)) ?></td>
									<td><?= htmlspecialchars($post->created_at) ?></td>
									<td>
										<span class="badge <?= $post->moderation_status === 'approved' ? 'bg-success' : ($post->moderation_status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark') ?>">
											<?= htmlspecialchars(ucfirst($post->moderation_status)) ?>
										</span>
									</td>
									<td class="text-end">
										<form action="/admdash/postmgmt/moderate" method="post" class="d-inline-flex gap-1 mb-1">
											<input type="hidden" name="id" value="<?= (int) $post->id ?>">
											<button type="submit" name="moderation_status" value="approved" class="btn btn-sm btn-outline-success">Approve</button>
											<button type="submit" name="moderation_status" value="rejected" class="btn btn-sm btn-outline-warning">Reject</button>
										</form>
										<form action="/admdash/postmgmt/delete" method="post" onsubmit="return confirm('Delete this post? This action cannot be undone.');">
											<input type="hidden" name="id" value="<?= (int) $post->id ?>">
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


