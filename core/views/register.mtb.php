<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\form\Form;

/**
 *  user: Mateable
 *  @var $model mateable\core\models\RegisterForm
 */

?>
        <section class="clean-block clean-form dark">
            <div id="register" class="container">
                <div class="block-heading">
                    <h2 class="text-info">Register</h2>
                    <p>When you become a member you get a MateableCoin (MTBC) wallet free. Hurry, you may get 100 MTBC to start you off!</p>
                    <br/>
                    <br/>
                    <p>The membership application below is the only information we require of our community. Any additional information needed will be asked upon login.</p>
                    <p>By signing up, you acknowledge that you are of legal age to view this content, and have agreed to our <a href="/legal?type=serviceterms">Terms of Service</a>.</p>
                </div>
                <?php
                    $form = Form::begin('','post');
                    echo $form->Field($model,'firstname');
                    echo $form->Field($model,'lastname');
                    echo $form->Field($model,'dob')->dateField();
                    echo $form->Field($model,'address1');
                    echo $form->Field($model,'address2');
                    echo $form->Field($model,'city');
                    echo $form->Field($model,'state');
                    echo $form->Field($model,'zip');
                    echo $form->Field($model,'phone');
                    echo $form->Field($model,'email');
                    echo $form->Field($model,'password')->passwordField();
                    echo $form->Field($model,'password_confirm')->passwordField();
                    echo $form->button('Submit');
                    echo Form::end();
                ?>
            </div>
        </section>
