<?php

/**
 * Copyright (c) 2025-2026. Mateable LLC
 */

use mateable\core\form\Form;
use mateable\core\models\user\account\UserLoginModel;

/**
 * @var $recModel \mateable\core\models\user\account\UserLoginModel
 */

?>
<section class="py-5 pb-4">
    <div class="container">

        <div class="block-heading text-center mb-4">
            <h2 class="text-info">Account Recovery</h2>
            <p>
                <b>Don't sweat the retrieval of your account!!!</b>
            </p>
            <br/>
            <p>
                By using our process for account recovery you are acknowledging the account you are trying to retrieve access to is yours; you are of legal age({{age}} yrs) to view the content of {{app_name}} LLC, and have agreed to our <a href="/legal?type=serviceterms">Terms of Service</a>.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="clean-form p-4 border rounded bg-mateable-form-panel">

                    <?php $form = Form::begin('', 'post'); ?>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <?php
                            echo $form->field(
                                $recModel,
                                'dob',
                                '',
                                '',
                                'padding:10px; border:1px solid #ccc; border-radius:4px; font-size:14px; width:100%; box-sizing:border-box;',
                                ''
                            )->dateField();
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php
                            echo $form->field(
                                $recModel,
                                'email',
                                '',
                                '',
                                'padding:10px; border:1px solid #ccc; border-radius:4px; font-size:14px; width:100%; box-sizing:border-box;',
                                ''
                            );
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-center">
                            <?php echo $form->button()::make('Recover')
                            ->class('btn btn-primary'); ?>
                        </div>
                    </div>

                    <?php echo $form::end(); ?>

                </div>

            </div>
        </div>

    </div>
</section>
