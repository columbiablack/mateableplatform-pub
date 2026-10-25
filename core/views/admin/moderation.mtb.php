<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

/**
 * @var $moderationAccounts
 * @var UserModel $moderationAccount
 */

use mateable\core\Platform;
use mateable\core\form\Form;
use mateable\core\models\user\account\UserModel;

?>
<section class="pt-4 pb-5">
    <div class="container-fluid">
        <!-- Admin Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="fw-bold text-info">
                    Moderation
                </h1>
                <p class="text-muted mb-0">
                    Keep an eye on members of the community!
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
                            Account Information
                        </h5>

                        <?php $bulkForm = Form::begin('/bulk','post') ?>
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
                                    <th>Select All</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($moderationAccounts as $moderationAccount): ?>
                                <?php $form = Form::begin('','post') ?>
                                    <tr>
                                        <td><?= $moderationAccount->displayUserID() ?></td>
                                        <td><?= $moderationAccount->displayFirstName() ?></td>
                                        <td><?= $moderationAccount->displayLastName() ?></td>
                                        <td><?= $moderationAccount->displayNickname() ?></td>
                                        <td><?= $moderationAccount->displayEmail() ?></td>
                                        <td>
                                            <?php $form->select()::model($moderationAccount,'account_status', [
                                                        Platform::$app->user::ACCOUNT_STATUS_ACTIVE => 'Active',
                                                        Platform::$app->user::ACCOUNT_STATUS_PENDING => 'Pending',
                                                        Platform::$app->user::ACCOUNT_STATUS_SUSPENDED => 'Suspended',
                                                    ],
                                                    'status_'.$moderationAccount->id
                                                );
                                            ?>
                                        </td>
                                        <?php switch($moderationAccount->displayRole()){
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
                                            <?php echo $form->button()::make('Edit')
                                                ->name('editUser')
                                                ->class('btn btn-sm btn-outline-secondary')
                                                ->formaction('')
                                                ->onclick("return confirm('Are you sure?')");
                                            ?>
                                            <?php echo $form->button()::make('Apply')
                                                ->name('applySingle')
                                                ->class('btn btn-sm btn-outline-secondary')
                                                ->formaction('/singleMod')
                                                ->onclick("return confirm('Are you sure?')");
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $bulkForm->checkbox($moderationAccount->DisplayUserID(), $moderationAccount->DisplayUserID()) ?>
                                        </td>
                                    </tr>
                                <?php echo $form::end() ?>
                                <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <td>
                                        <?php echo $bulkForm->button()::make('Apply All')
                                            ->name('applyBulk')
                                            ->class('btn btn-primary btn-sm btn-outline-success')
                                            ->formaction('/bulkMod')
                                            ->onclick("return confirm('Are you sure?')"); ?>
                                    </td>
                                </tfoot>
                            </table>
                        </div>
                        <?php echo $bulkForm::end() ?>

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
