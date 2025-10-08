<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
 *  user: Mateable
 *  @var $model mateable\core\models\ContactForm
 */

use mateable\core\form\Form;
?>
    <section class="content-section clean-block">
        <div class="block-heading">
            <h2 class="text-info">Contact Us</h2>
            <p>Do you have questions or concerns about the site? Send us a message by filling out the form below.</p>
        </div>
        <div class="clean-form">
            <?php
                $form = Form::begin('', 'post');
                echo $form->field($model, 'user_email');
                echo $form->field($model, 'user_subject');
                echo $form->fieldTextArea($model, 'user_message');
                echo $form->button('Submit');
                echo $form::end();
            ?>
        </div>
    </section>
