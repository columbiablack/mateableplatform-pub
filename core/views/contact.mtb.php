<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\form\Form;

/**
 *  user: Mateable
 *  @var $model mateable\core\models\ContactForm
 */

?>
    <section class="bg-light py-5">
        <div class="container">

            <div class="block-heading text-center mb-4">
                <h2 class="text-info">Contact Us</h2>
                <p>Do you have any questions or concerns for the staff? Feel free to leave us a message and one of the Team will get back to you!</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">

                    <div class="form-control p-4 border rounded bg-white">
                        <?php $form = Form::begin('','post'); ?>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <?php echo $form->field($model,'user_email', '', '','width: 250px;', ''); ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $form->field($model,'user_subject', '', '','width: 250px;', ''); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <?php echo $form->fieldTextArea($model,'user_message', 'width: 500px;height: 250px;'); ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <?php echo $form->button('Submit'); ?>
                            </div>
                        </div>
                        <?php echo Form::end(); ?>
                    </div>

                </div>
            </div>

        </div>
    </section>
