<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

use mateable\core\form\Form;

$form = new Form();
?>
<section class="clean-block clean-form content-section">
    <div class="container">
        <div class="row block-heading">
            <h2 class="text-info">Chatview</h2>
            <p></p>
        </div>
        <div class="row block-content content">
            <div class="container content">
                <div class="row">
                    <div class="col">
                        <div class="fa-snapchat-square">
                            <video id="localVideo" autoplay></video>
                        </div>
                    </div>
                    <div class="col">
                        <div class="fa-snapchat-square dark">
                            <video id="remoteVideo" autoplay></video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row block-content content"> <!-- Added justify-content-center and align-items-center classes -->
            <div class="col">
                <div class="baguetteBox-button">
                    <?php echo $form->button('Call Peer', 'callButton').PHP_EOL; ?>
                </div>
            </div>
            <div class="col">
                <div class="baguetteBox-button">
                    <?php echo $form->button('Start Webcam', 'startButton').PHP_EOL; ?>
                </div>
            </div>
            <div class="col">
                <div class="baguetteBox-button">
                    <?php echo $form->button('Stop Webcam', 'stopButton'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
