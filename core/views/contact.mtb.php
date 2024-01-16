<?php
/**
 *  user: Mateable
 */

use app\system\libs\form\Form;
?>

    <section class="clean-block clean-form dark">
        <div id="contact" class="container">
            <div class="block-heading">
                <h2 class="text-info">Contact Us</h2>
                <p>Do you have questions or concerns about the site? Send us a message by filling out the form below.</p>
            </div>

            <?php
                $form = Form::Begin('', 'post');
                echo $form->field($model, 'email');
                echo $form->field($model, 'subject');
                echo $form->fieldTextArea($model, 'message');
                echo $form->button('Submit');
                echo $form::end();
            ?>
        </div>
    </section>
