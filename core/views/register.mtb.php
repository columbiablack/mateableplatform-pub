<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

use mateable\core\form\Form;

/**
 *  user: Mateable
 *  @var $model \mateable\core\models\user\account\UserModel
 */

?>
<section class="py-5">
    <div class="container-fluid">

        <div class="block-heading text-center mb-4">
            <h2 class="text-info">Create Your Account</h2>

            <p class="lead">
                Sign up and receive <strong>100 MTBC</strong> to get started!
            </p>

            <p class="text-muted">
                The information below is all that is required by {{app_name}} LLC.
                Any additional details will be requested via your dashboard, email, or SMS.
            </p>

            <p class="small">
                By signing up, you confirm you are at least {{age}} years old and agree to our
                <a href="/legal?type=serviceterms">Terms of Service</a>.
            </p>
        </div>

        <div class="row justify-content-center container-fluid">
            <div class="col-lg-9">
                <div class="clean-form p-4 border rounded bg-mateable-form-panel">

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
                        <div class="col-12 text-start mt-3">
                            <?= $form->button()::make('Register')->class('btn btn-primary') ?>
                        </div>

                    </div>
                    <?php echo $form::end(); ?>

                </div>
            </div>
        </div>
    </div>
</section>
