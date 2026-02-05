<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\form\Form;

/**
 *  user: Mateable
 *  @var $model mateable\core\models\UserModel
 */

?>
<section class="bg-light py-5">
    <div class="container-fluid">
        <div class="block-heading text-center mb-4">
            <h2 class="text-info">Create Your Account</h2>

            <p class="lead">
                Sign up today and receive <strong>100 MTBC</strong> to get started.
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

        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <div class="clean-form p-4 border rounded bg-white">

                    <?php $form = Form::begin('', 'post'); ?>

                    <div class="row gy-4">

                        <div class="col-md-6">
                            <?= $form->field($model, 'firstname', '', '', 'width: 250px;', '') ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'lastname', '', '', 'width: 250px;', '') ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'dob', '', '', 'width: 250px;', '')->dateField() ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'phone', '', '', 'width: 250px;', '') ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'address1', '', '', 'width: 250px;', '') ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'address2', '', '', 'width: 250px;', '') ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($model, 'city', '', '', 'width: 250px;', '') ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($model, 'state', '', '', 'width: 250px;', '') ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($model, 'zip', '', '', 'width: 250px;', '') ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'email', '', '', 'width: 250px;', '') ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'password', '', '', 'width: 250px;', '')->passwordField() ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'password_confirm', '', '', 'width: 250px;', '')->passwordField() ?>
