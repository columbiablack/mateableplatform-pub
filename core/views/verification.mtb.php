<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */
/**
 * @var $model mateable\core\models\RegisterForm
 */

use mateable\core\form\Form;

?>
        <section class="clean-block clean-form dark">
            <div id="register" class="container">
                <div class="block-heading">
                    <h2 class="text-info">Staff Verification</h2>
                    <div class="block-content">
                        <p>
                            In this world there are a lot of scammers, hackers, and dark programmers.
                            <br>They love to pretend to be our staff for some unknown reason, we really have no idea why!
                            <br>Although nobody has made a report of a financial loss due to these encounters, it is an issue.
                            <br>So we have created a verification system for any type of message that comes from any one of our staff.
                            <br>We've selected to give our community the ease of verifying who they are speaking with.
                            <br>We send a lot of post in our discord, we respond to issues within a reasonable timeframe,
                            sometimes our response system has delays due to overwhelming amounts of reports.
                            <br>Bare with us, as we give our community a real solid sense of security when they're dealing with {{app_name}}.
                            To our community & followers, it's coming to an end and the resolution starts here!
                            <br>
                            <br>
                        </p>
                        <?php
                            $form = Form::begin('','post');
                            echo $form->field($model,'verify_key');
                            echo $form->field($model,'password')->passwordField();
                            echo $form->button('Submit');
                            echo $form::end();
                        ?>

                    </div>
                </div>
            </div>
        </section>
