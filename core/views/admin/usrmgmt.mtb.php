<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

/**
* @var $userAccounts
* @var UserModel $userAccount
**/

use mateable\core\models\UserModel;
use mateable\core\Platform;

?>
<section id="admin-dashboard" class="bg-light pt-4 pb-5">
    <div class="container-fluid">
        <!-- Admin Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">
                    User Management
                </h1>
                <p class="text-muted mb-0">
                    Manage users, role status and more!
                </p>
            </div>
        </div>

        <!-- Admin Workspace -->
        <div class="row g-4">

            <!-- Main Admin Panel -->
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">
                            Account Listing
                        </h5>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First</th>
                                    <th>Last</th>
                                    <th>Nickname</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($userAccounts as $userAccount): ?>
                                <tr>
                                    <td><?= $userAccount->displayUserID() ?></td>
                                    <td><?= $userAccount->displayFirstName() ?></td>
                                    <td><?= $userAccount->displayLastName() ?></td>
                                    <td>nickname</td>
                                    <td><?= $userAccount->displayEmail() ?></td>
                                    <?php
                                    switch($userAccount->displayAccountStatus()){

                                        case Platform::$app->user::ACCOUNT_STATUS_PENDING:
                                            echo '<td><span class="badge bg-warning">'.$userAccount->account_status.'</span></td>';
                                            break;

                                        case Platform::$app->user::ACCOUNT_STATUS_ACTIVE:
                                            echo '<td><span class="badge bg-success">'.$userAccount->account_status.'</span></td>';
                                            break;

                                        case Platform::$app->user::ACCOUNT_STATUS_SUSPENDED:
                                            echo '<td><span class="badge bg-danger">'.$userAccount->account_status.'</span></td>';
                                            break;

                                    }
                                    ?>

                                    <?php
                                    switch($userAccount->displayRole()){

                                        case Platform::$app->user::ROLE_ADMINISTRATOR :
                                            echo '<td><span class="badge bg-danger">Administrator</span></td>';
                                            break;

                                        case Platform::$app->user::ROLE_MODERATOR:
                                            echo '<td><span class="badge bg-warning">Moderator</span></td>';
                                            break;

                                        case Platform::$app->user::ROLE_MEMBER:
                                            echo '<td><span class="badge bg-success">Member</span></td>';
                                            break;

                                    }
                                    ?>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                        <button class="btn btn-sm btn-outline-danger">Suspend</button>
                                        <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
