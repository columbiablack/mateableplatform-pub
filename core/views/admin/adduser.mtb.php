<?php
/**
 * Copyright (c) 2026. Mateable LLC
 */

use mateable\core\models\user\account\UserModel;

/** @var UserModel $userAccount */
function adminUserValue(UserModel $userAccount, string $attribute): string
{
    return htmlspecialchars((string) ($userAccount->{$attribute} ?? ''), ENT_QUOTES, 'UTF-8');
}
?>
<section class="pt-4 pb-5">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">Add User</h1>
                <p class="text-muted mb-0">Create a member account from the administration panel.</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="/admdash/usrmgmt/add" method="post">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First name</label>
                            <input id="firstname" name="firstname" class="form-control" required minlength="2" value="<?= adminUserValue($userAccount, 'firstname') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Last name</label>
                            <input id="lastname" name="lastname" class="form-control" required minlength="2" value="<?= adminUserValue($userAccount, 'lastname') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="nickname" class="form-label">Nickname</label>
                            <input id="nickname" name="nickname" class="form-control" value="<?= adminUserValue($userAccount, 'nickname') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" class="form-control" required value="<?= adminUserValue($userAccount, 'email') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Date of birth</label>
                            <input id="dob" name="dob" class="form-control" required value="<?= adminUserValue($userAccount, 'dob') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input id="phone" name="phone" class="form-control" required value="<?= adminUserValue($userAccount, 'phone') ?>">
                        </div>
                        <div class="col-12">
                            <label for="address1" class="form-label">Address</label>
                            <input id="address1" name="address1" class="form-control" required minlength="5" value="<?= adminUserValue($userAccount, 'address1') ?>">
                        </div>
                        <div class="col-12">
                            <label for="address2" class="form-label">Address line 2</label>
                            <input id="address2" name="address2" class="form-control" value="<?= adminUserValue($userAccount, 'address2') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="city" class="form-label">City</label>
                            <input id="city" name="city" class="form-control" required minlength="2" value="<?= adminUserValue($userAccount, 'city') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <input id="state" name="state" class="form-control" required minlength="2" value="<?= adminUserValue($userAccount, 'state') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="zip" class="form-label">ZIP code</label>
                            <input id="zip" name="zip" class="form-control" required minlength="5" value="<?= adminUserValue($userAccount, 'zip') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Temporary password</label>
                            <input id="password" name="password" type="password" class="form-control" required minlength="6">
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirm" class="form-label">Confirm password</label>
                            <input id="password_confirm" name="password_confirm" type="password" class="form-control" required minlength="6">
                        </div>
                        <div class="col-12 d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">Create User</button>
                            <a href="/admdash/usrmgmt" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
