<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\Platform;

?>
<footer class="page-footer dark">
    <div class="container">
        <?php if(Platform::isGuest()>=false): ?>
            <div class="row">
                <div class="col-sm-3">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><a href="./register">Register</a></li>
                        <li><a href="./downloads">Downloads</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>About us</h5>
                    <ul>
                        <li><a href="./about-us">Mateable LLC</a></li>
                        <li><a href="./contact">Contact us</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="./#">FAQ</a></li>
                        <li><a href="./#">Help desk</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="./legal?type=serviceterms">Terms of Service</a></li>
                        <li><a href="./legal?type=privacypolicy">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="footer-copyright">
        <p>© 2023-<?php echo date('Y'); ?> Copyright <a href="{{site_url}}">{{app_name}} LLC</a></p>
    </div>
</footer>
<script src="./assets/bootstrap/js/main.min.js"></script>
<script src="./assets/js/main.min.js"></script>
<script src="./assets/js/validation.js"></script>
</body>
</html>
