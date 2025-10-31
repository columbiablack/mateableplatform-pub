<?php

/**
 * Copyright (c) 2025. Mateable LLC
 */
use mateable\core\form\Form;
/**
 * @var $recModel \mateable\core\models\UserLoginModel
 */

?>
<section class="content-section clean-block">
    <div class="block-heading">
        <h2 class="text-info">Account Recovery</h2>
        <p>
            <b>Don't sweat the retrieval of your account!!!</b>
        </p>
        <br/>
        <p>
            By using our process for account recovery you are acknowledging the account you are trying to retrieve access to is yours; you are of legal age({{age}} yrs) to view the content of {{app_name}} LLC, and have agreed to our <a href="/legal?type=serviceterms">Terms of Service</a>.
        </p>
    </div>
    <div class="clean-form">
        <div class="container form-control">
            <?php $form = Form::begin('','post'); ?>
            <div class="row">
                <div class="col-md-5">
                    <?php echo $form->field($recModel,'dob', '', '','width: 250px;')->dateField(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <?php echo $form->field($recModel,'email', '', '','width: 250px;'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?php echo $form->button('Register'); ?>
                </div>
            </div>
        </div>
        <?php echo Form::end(); ?>
    </div>
</section>
