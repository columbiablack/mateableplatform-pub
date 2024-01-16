<?php
/**
* user: Mateable
* @var $model \app\models\User
*/

use app\system\libs\form\Form;
?>
    <section class="clean-block clean-form dark">
        <div id='login' class="container">
            <div class="block-heading">
                <h2 class="text-info">Login</h2>
                <p>You are 18 years of age or older by access to the account.</p>
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
