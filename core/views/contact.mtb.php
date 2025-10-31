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
    <section class="content-section clean-block">
        <div class="block-heading">
            <h2 class="text-info">Contact Us</h2>
            <p>Do you have any questions or concerns for the staff? Feel free to leave us a message and one of the Team will get back to you!</p>
        </div>
        <div class="clean-form">
            <div class="container form-control">
            <?php $form = Form::begin('','post'); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $form->field($model,'user_email', '', '','width: 250px;'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $form->field($model,'user_subject', '', '','width: 250px;'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $form->fieldTextArea($model,'user_message', 'width: 500px;height: 250px;'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $form->button('Submit'); ?>
                    </div>
                </div>
            <?php echo Form::end(); ?>
            </div>
        </div>
    </section>
