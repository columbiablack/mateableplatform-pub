<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

/***
 *  user: Mateable
 */

use mateable\core\Platform;

/**if(!Platform::$app->isGuest()){
    Platform::$app->response->redirect('/dashboard');
}*/
?>
    <section class="bg-light">
        <div class="container">
            <div class="d-block row-cols-lg-8">
                <div class="block-heading">
                    <h2 class="text-info">Mateable LLC</h2>
                </div>
                <div class="content">
                    <p>
                        Welcome to {{app_name}}! There is no template set for the news and updates of the network.
                        Please bare with us as we're setting up a new platform built by our team.
                        This platform is built with care to help socialize and solve overall life tackles.
                        All are equal here and there are no set boundaries until mischief comes to the frontline of trust.
                    </p>
                </div>
                <div class="block-heading">
                    <h2 class="text-info">Content Creators</h2>
                </div>
                <div class="block-content">
                    <p>
                        Content creators and streamers, come and bring your followers with you! <br>
                        Monetize your content through advertisements and reach over 1 million viewers within minutes! <br>
                        Stream through multiple platforms all at once and no headache of setting up.
                    </p>
                </div>
            </div>
        </div>
    </section>