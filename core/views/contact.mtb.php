<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

use mateable\core\form\Form;

/**
 *  user: Mateable
 *  @var $model mateable\core\models\ContactForm
 */

?>
    <section class="py-5">
        <div class="container container-fluid">

            <div class="block-heading text-center mb-4">
                <h2 class="text-info">Contact Us</h2>
                <p>Do you have any questions or concerns for the staff? Feel free to leave us a message and one of the Team will get back to you!</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="p-4 border rounded bg-mateable-form-panel shadow-sm">
                        <?php $form = Form::begin('', 'post'); ?>

                        <div class="row g-3">

                            <!-- Email -->
                            <div class="col-md-6">
                                <?= $form->field($model, 'user_email', '', '', '','') ?>
                            </div>

                            <!-- Subject -->
                            <div class="col-md-6">
                                <?= $form->field($model, 'user_subject', '', '', '', '') ?>
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <?= $form->fieldTextArea($model, 'user_message', 'height: 200px;') ?>
                            </div>

                            <!-- Button -->
                            <div class="col-12 text-start">
                                <?= $form->button()::make('Submit')
                                    ->class('btn btn-primary') ?>
                            </div>

                        </div>

                        <?= Form::end(); ?>
                    </div>

                </div>
            </div>

        </div>
    </section>
