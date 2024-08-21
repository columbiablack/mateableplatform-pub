<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
* user: Mateable
* @var $model mateable\core\models\UserModel
*/

use mateable\core\form\Form;
use mateable\core\Platform;

?>
<?php if(Platform::isGuest()): ?>
        <section class="content-section clean-block clean-form py-3">
            <div class="block-heading">
                <h2 class="text-info">Login</h2>
                <p>Are you of legal age to access the account?</p>
            </div>
            <div class="block-content">
                <?php
                    $form = Form::begin('','post');
                    echo $form->field($model,'email');
                    echo $form->field($model,'password')->passwordField();
                    echo $form->button('Login');
                    echo $form::end();
                ?>
            </div>
        </section>
        <section class="clean-block clean-form content-section">
        </section>
<?php else: ?>
        <section class="clean-block clean-form content-section">
            <div class="block-heading">
                <h2 class="text-info">Login</h2>
                <p>You are already logged in! Go to your <a href="./dashboard">dashboard</a>.</p>
            </div>
        </section>
<?php endif; ?>
