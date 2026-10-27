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
    <section class="theme-page">
        <div class="container">
            <div class="g-card g-4">
                <div class="block-heading text-center mb-4">
                    <h2 class="text-uppercase fw-bold mb-2" style="letter-spacing:0.24rem; color: var(--mateable-accent);">Members Portal</h2>
                    <p class="text-muted mb-0">Login to see what you have been missing in the gaming world!</p>
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

                            <div class="row">
                                <div class="col text-center">
                                    <?php echo $form->button()::make('Login')
                                        ->class('btn btn-primary'); ?>
                                </div>
                            </div>

                            <?php echo $form::end(); ?>

                        </div>

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