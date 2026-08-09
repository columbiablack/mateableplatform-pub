<?php
/**
 * Copyright (c) 2026. Mateable LLC
 */

use mateable\core\models\user\account\UserModel;

/** @var UserModel $userAccount */
?>
<section class="pt-4 pb-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">User Administration</h1>
                <p class="text-muted mb-0">Choose an administrative action for this account.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Selected account</h5>
                        <dl class="row mb-0">
                            <dt class="col-sm-4">User ID</dt>
                            <dd class="col-sm-8"><?= (int) $userAccount->displayUserID() ?></dd>
                            <dt class="col-sm-4">Name</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($userAccount->displayName()) ?></dd>
                            <dt class="col-sm-4">Email</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($userAccount->displayEmail()) ?></dd>
                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($userAccount->displayAccountStatus()) ?></dd>
                        </dl>

                        <?php if ((int) $userAccount->displayUserID() !== (int) \mateable\core\Platform::$app->user->id): ?>
                            <hr>
                            <h5 class="fw-semibold mb-3">Administrative status</h5>
                            <form action="/admdash/usrmgmt/status" method="post">
                                <input type="hidden" name="id" value="<?= (int) $userAccount->displayUserID() ?>">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="role" class="form-label">Role</label>
                                        <select id="role" name="role" class="form-select">
                                            <option value="0" <?= (int) $userAccount->displayRole() === UserModel::ROLE_MEMBER ? 'selected' : '' ?>>Member</option>
                                            <option value="1" <?= (int) $userAccount->displayRole() === UserModel::ROLE_MODERATOR ? 'selected' : '' ?>>Moderator</option>
                                            <option value="2" <?= (int) $userAccount->displayRole() === UserModel::ROLE_ADMINISTRATOR ? 'selected' : '' ?>>Administrator</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="account_status" class="form-label">Account status</label>
                                        <select id="account_status" name="account_status" class="form-select">
                                            <option value="active" <?= $userAccount->displayAccountStatus() === UserModel::ACCOUNT_STATUS_ACTIVE ? 'selected' : '' ?>>Active</option>
                                            <option value="pending" <?= $userAccount->displayAccountStatus() === UserModel::ACCOUNT_STATUS_PENDING ? 'selected' : '' ?>>Pending</option>
                                            <option value="suspended" <?= $userAccount->displayAccountStatus() === UserModel::ACCOUNT_STATUS_SUSPENDED ? 'selected' : '' ?>>Suspended</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Save Administrative Status</button>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Administrative options</h5>
                        <div class="d-grid gap-2">
                            <a href="/admdash/usrmgmt/add" class="btn btn-outline-primary">Add User</a>
                            <a href="/admdash/usrmgmt" class="btn btn-outline-secondary">Back to User List</a>
                            <?php if ((int) $userAccount->displayUserID() !== (int) \mateable\core\Platform::$app->user->id): ?>
                                <form action="/admdash/usrmgmt/delete" method="post" onsubmit="return confirm('Delete this user account? This action cannot be undone.');">
                                    <input type="hidden" name="id" value="<?= (int) $userAccount->displayUserID() ?>">
                                    <button type="submit" class="btn btn-outline-danger w-100">Delete User</button>
                                </form>
                            <?php else: ?>
                                <button type="button" class="btn btn-outline-danger" disabled>Current Administrator</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
