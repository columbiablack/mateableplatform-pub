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
    <section class="content-section clean-block">
        <div class="block-heading">
            <h2 class="text-info">Register</h2>
            <p>Register with us and you may get 100 MTBC to start you off!</p>
            <br/>
            <p>The membership application below is the only information required by {{app_name}} LLC. Any additional information required will be acknowledged via e-mail.</p>
            <p>By signing up, you acknowledge that you are of legal age({{age}} yrs) to view this content, and have agreed to our <a href="/legal?type=serviceterms">Terms of Service</a>.</p>
        </div>
        <div class="clean-form">
            <div class="container form-control">
            <?php $form = Form::begin('','post'); ?>
                <div class="row">
                    <div class="col-md-5">
                        <?php echo $form->field($model,'firstname', '', '','width: 250px;'); ?>
                    </div>
                    <div class="col-md-5">
                        <?php echo $form->field($model,'lastname', '', '','width: 250px;'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <?php echo $form->field($model,'dob', '', '','width: 250px;')->dateField(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <?php echo $form->field($model,'address1', '', '','width: 250px;'); ?>
                    </div>
                    <div class="col-md-5">
                        <?php echo $form->field($model,'address2', '', '', 'width: 250px;'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <?php echo $form->field($model,'city', '', '','width: 250px;'); ?>
                    </div>
                    <div class="col-md-5">
                        <?php echo $form->field($model,'state', '', '','width: 250px;'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <?php echo $form->field($model,'zip', '', '','width: 250px;'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <?php echo $form->field($model,'phone', '', '','width: 250px;'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <?php echo $form->field($model,'email', '', '','width: 250px;'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <?php echo $form->field($model,'password', '', '','width: 250px;')->passwordField(); ?>
                    </div>
                    <div class="col-md-5">
                        <?php echo $form->field($model,'password_confirm', '', '','width: 250px;')->passwordField(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $form->button('Register'); ?>
                    </div>
                </div>
            </div>
            <?php echo Form::end(); ?>
        </div>
    </section>
