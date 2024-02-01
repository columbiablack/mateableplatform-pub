<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
* user: Mateable
* @var $model mateable\core\models\RegisterForm
*/

use mateable\core\form\Form;
use mateable\core\Platform;

?>

<?php if(Platform::isGuest()): ?>
    <section class="clean-block clean-form dark">
        <div id='login' class="container">
            <div class="block-heading">
                <h2 class="text-info">Login</h2>
                <p>You are 18 years of age or older by access to the account?</p>
            </div>
            <?php
                $form = Form::begin('','post');
                echo $form->field($model,'email');
                echo $form->field($model,'password')->passwordField();
                echo $form->button('Submit');
                echo $form::end();
            ?>
        </div>
    </section>
<?php else: ?>
    <section class="clean-block clean-form dark">
        <div id='login' class="container">
            <div class="block-heading">
                <h2 class="text-info">Login</h2>
                <p>You are already logged in! Go to your <a src="./dashboard">dashboard</a>.</p>
            </div>
    </section>
<?php endif; ?>
