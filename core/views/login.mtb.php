<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\form\Form;
use mateable\core\Platform;

/**
 * user: Mateable
 * @var $model mateable\core\models\UserModel
 */

?>
<?php if(Platform::$app->isGuest()): ?>
    <section class="clean-block">
        <div class="block-heading">
            <h2 class="text-info">Login</h2>
            <p>Are you of legal age to access the account?</p>
        </div>
        <div class="clean-form">
            <div class="container form-control">
            <?php $form = Form::begin('','post'); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $form->field($model,'email', '', '','padding:10px; border:1px solid #ccc; border-radius:4px; font-size:14px; width:100%; box-sizing:border-box;'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $form->field($model,'password', '', '','padding:10px; border:1px solid #ccc; border-radius:4px; font-size:14px; width:100%; box-sizing:border-box;')->passwordField(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <a href="/pwdrec">Forgot Password</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $form->button('Login'); ?>
                    </div>
                </div>
            <?php echo $form::end(); ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="clean-block clean-form content-section">
        <div class="block-heading">
            <h2 class="text-info">Login</h2>
            <p>You are already logged in! Go to your <a href="./dashboard">dashboard</a>.</p>
        </div>
    </section>
<?php endif; ?>