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
    <section class="bg-light py-5">
        <div class="container">

            <div class="block-heading text-center mb-4">
                <h2 class="text-info">Sign in</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">

                    <div class="clean-form p-4 border rounded bg-white">

                        <?php $form = Form::begin('', 'post'); ?>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <?php
                                echo $form->field(
                                    $model,
                                    'email',
                                    '',
                                    '',
                                    'padding:10px; border:1px solid #ccc; border-radius:4px; font-size:14px; width:100%; box-sizing:border-box;',
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
                                    'padding:10px; border:1px solid #ccc; border-radius:4px; font-size:14px; width:100%; box-sizing:border-box;',
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
                                <?php echo $form->button('Sign In'); ?>
                            </div>
                        </div>

                        <?php echo $form::end(); ?>

                    </div>

                </div>
            </div>

        </div>
    </section>
<?php else: ?>
    <section class="clean-block clean-form content-section">
        <div class="block-heading">
            <h2 class="text-info">Sign in</h2>
            <p>You are already signed in! Go to your <a href="./dashboard">dashboard</a>.</p>
        </div>
    </section>
<?php endif; ?>