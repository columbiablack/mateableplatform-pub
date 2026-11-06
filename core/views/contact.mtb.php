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
    <section class="theme-page">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="mateable-dashboard-hero card border-0 shadow-sm">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                                <div>
                                    <p class="text-uppercase fw-bold mb-2" style="letter-spacing:0.24rem; color: var(--mateable-accent);">Messaging Center</p>
                                    <h1 class="fw-bold mb-2" style="color: var(--mateable-text);">
                                        Contact Us
                                    </h1>
                                    <p class="mb-0" style="color: var(--mateable-muted);">
                                        Do you have questions and not have any luck finding an answer in the FAQ?
                                        Feel free to send us a message and one of the Team members will get back to you shortly!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card p-4 border rounded bg-mateable-form-panel shadow-sm">
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
