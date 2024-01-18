<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
*  user: Mateable
*  @var $model \mateable\core\models\User
*/

use mateable\core\form\Form;

?>

        <section class="clean-block clean-form dark">
            <div id="register" class="container">
                <div class="block-heading">
                    <h2 class="text-info">Register</h2>
                    <p>When you become a member you get a Mateable Coin wallet with 100MTBC free!</p><br/><br/>
                    <p>By signing up you do acknowledge that you are legally 18 years of age or older, and have agreed to our <a href="#">Terms of Policy</a>.</p>
                </div>
                <?php
                    $form = Form::begin('','post');
                    echo $form->Field($model,'firstname');
                    echo $form->Field($model,'lastname');
                    echo $form->Field($model,'dob')->dateField();
                    echo $form->Field($model,'location');
                    echo $form->Field($model,'email');
                    echo $form->Field($model,'username');
                    echo $form->Field($model,'password')->passwordField();
                    echo $form->Field($model,'password_confirm')->passwordField();
                    echo $form->button('Submit');
                    echo Form::end();
                ?>
            </div>
        </section>
