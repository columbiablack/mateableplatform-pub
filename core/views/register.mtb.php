<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

use mateable\core\form\Form;use mateable\core\Platform;

/**
 *  user: Mateable
 *  @var $model \mateable\core\models\user\account\UserModel
 */

?>
<?php if(Platform::$app->isGuest()):?>
<section class="theme-page">
    <div class="container py-4">

        <!-- Admin Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="mateable-dashboard-hero card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                            <div>
                                <p class="text-uppercase fw-bold mb-2" style="letter-spacing:0.24rem; color: var(--mateable-accent);">Account Registration</p>
                                <h2 class="fw-bold mb-2">
                                    Browse the marketplace for games, software, and team rewards.
                                </h2>
                                <p class="text-muted mb-3">
                                    Sign up and receive <strong>100 MTBC</strong> to get started!
                                </p>
                                <p class="text-muted mb-3 small">
                                    The information below is all that is required by {{app_name}} LLC.
                                    Any additional details will be requested via your dashboard, email, or SMS.
                                    By signing up, you confirm you are at least {{age}} years old and agree to our
                                    <a href="/legal?type=serviceterms">Terms of Service</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center container-fluid">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm h-100 clean-form p-4 bg-mateable-form-panel">

                    <?php $form = Form::begin('', 'post'); ?>

                    <div class="row g-3 pt-3">

                        <!-- Name -->
                        <div class="col-md-6">
                            <?= $form->field($model, 'firstname', '', '', '', '') ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'lastname', '', '', '', '') ?>
                        </div>

                        <!-- DOB + Phone -->
                        <div class="col-md-6">
                            <?= $form->field($model, 'dob', '', '', '', '')->dateField() ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'phone', '', '', '', '') ?>
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <?= $form->field($model, 'address1', '', '', '', '') ?>
                        </div>

                        <div class="col-12">
                            <?= $form->field($model, 'address2', '', '', '', '') ?>
                        </div>

                        <!-- City / State / Zip -->
                        <div class="col-md-4">
                            <?= $form->field($model, 'city', '', '', '', '') ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($model, 'state', '', '', '', '') ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($model, 'zip', '', '', '', '') ?>
                        </div>

                        <!-- Email -->
                        <div class="col-12">
                            <?= $form->field($model, 'email', '', '', '', '') ?>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <?= $form->field($model, 'password', '', '', '', '')->passwordField() ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'password_confirm', '', '', '', '')->passwordField() ?>
                        </div>

                        <!-- Button -->
                        <div class="mb-3">
                            <?= $form->button()::make('Register')->class('btn btn-primary') ?>
                        </div>

                    </div>
                    <?php echo $form::end(); ?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
    <section class="theme-page">
        <div class="container">
            <div class="card p-4">
                <div class="block-heading text-center mb-4">
                    <h2 class="text-uppercase fw-bold mb-2" style="letter-spacing:0.24rem; color: var(--mateable-accent);">Login</h2>
                    <p class="text-muted mb-0">You are already signed in! Go to your <a href="./dashboard">dashboard</a>.</p>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
