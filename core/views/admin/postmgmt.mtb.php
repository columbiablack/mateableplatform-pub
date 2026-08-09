<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

use mateable\core\models\PostModel;

/** @var PostModel[] $posts */
/** @var array<int, string> $postAuthors */
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
									<td class="text-end">
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


