<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

use mateable\core\Platform;

?>
<?php if(!Platform::isGuest()): ?>
<div class="floating-menu">
    <button class="btn btn-secondary" onclick="userOverlayOn()">Post</button>
</div>
<?php endif; ?>
<footer class="page-footer bottom dark">
    <div class="container">
        <?php if(Platform::isGuest()): ?>
            <div class="row">
                <div class="col-sm-3">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/register">Register</a></li>
                        <li><a href="/downloads">Downloads</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>About us</h5>
                    <ul>
                        <li><a href="/about-us">Mateable LLC</a></li>
                        <li><a href="/contactus">Contact us</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="/#">FAQ</a></li>
                        <li><a href="/#">Help desk</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="/legal?type=serviceterms">Terms of Service</a></li>
                        <li><a href="/legal?type=privacypolicy">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="text-center footer-copyright">
        <p>© 2023-<?php echo date('Y'); ?> Copyright <a href="{{site_url}}">{{app_name}} LLC</a></p>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.4.1/socket.io.js"></script>
<script src="../assets/bootstrap/js/main.min.js"></script>
<script src="../assets/js/client.js"></script>
<script src="../assets/js/main.min.js"></script>
<script src="../assets/js/validation.js"></script>
<script src="../assets/js/custom.js"></script>
<script src="../assets/mateable/js/animation.js"></script>
</body>
</html>
