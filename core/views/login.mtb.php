<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

use mateable\core\form\Form;
use mateable\core\models\user\account\UserModel;
use mateable\core\Platform;

/**
 * user: Mateable
 * @var $model UserModel
 */

?>
<?php if(Platform::$app->isGuest()): ?>
    <section class="py-5">
        <div class="container">

            <div class="block-heading text-center mb-4">
                <h2 class="text-info">Sign in</h2>
                <p class="text-muted mb-0">Sign in to see what you have been missing in the gaming world!</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">

                    <div class="clean-form p-4 border rounded bg-mateable-form-panel">

                        <?php $form = Form::begin('', 'post'); ?>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <?php
                                echo $form->field(
                                    $model,
                                    'email',
                                    '',
                                    '',
                                    '',
                                    ''
                                );
                                ?>
                            </div>

                            <div class="col-md-6">
                                <?php
                                echo $form->field(
                                    $model,
                                    'password',
                                    '',
                                    '',
                                    '',
                                    ''
                                )->passwordField();
                                ?>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-md-6">
                                <?php echo $form->checkBox('remember_me', 'remember_me', 'Remember me'); ?>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="/pwdrec">Forgot Password?</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center">
                                <?php echo $form->button()::make('Sign In')
                                ->class('btn btn-primary'); ?>
                            </div>
                        </div>

                        <?php echo $form::end(); ?>

                    </div>

                </div>
            </div>

        </div>
    </section>
<?php else: ?>
    <section class="py-4 pb-5">
        <div class="container">

            <div class="block-heading text-center mb-4">
                <h2 class="text-info">Sign in</h2>
                <p>You are already signed in! Go to your <a href="./dashboard">dashboard</a>.</p>
            </div>

        </div>
    </section>
<?php endif; ?>