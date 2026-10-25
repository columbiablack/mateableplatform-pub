<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

$myEnvName = $_ENV['NAME'];
?>
<section class="content">
    <div id="wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center">
                    <img src="assets/img/mateable_logo.png" width="150" height="135">
                    <h2 class="text-gray-900 mb-4">Undergoing maintenance</h2>
                </div>
                <div class="block-content">
                    <p class="text-secondary card-text text-left">
                        The <?php echo $myEnvName; ?> LLC platform is undergoing maintenance or upgrades at the moment.
                        It will only be a short period of time our services are unavailable to you. If you see this message for longer than 12 hours, consider this a major upgrade!
                        <br />
                        Developers, check out <a href="https://github.com/mateable">Github</a> to see the latest upgrades!
                    </p>
                    <p class="text-secondary card-text">
                        Best regards,<br />
                        Mateable Team
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
