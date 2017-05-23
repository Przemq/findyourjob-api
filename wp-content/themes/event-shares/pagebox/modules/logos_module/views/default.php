<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\LogosModule $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-49">EV-49</a>
        <div class="row" id="in-the-media">
            <div class="col-lg-12">
                <h4>IN THE MEDIA</h4>
            </div>
            <div class="col-lg-3 image-container">
                <img class="media-image img-fluid" id="media1" src="<?= THEME_IMAGES_URI; ?>/logo_microsoft.svg">
            </div>
            <div class="col-lg-3 image-container">
                <img class="media-image img-fluid" id="media2" src="<?= THEME_IMAGES_URI; ?>/logo_yahoo.svg">
            </div>
            <div class="col-lg-3 image-container">
                <img class="media-image img-fluid" id="media3" src="<?= THEME_IMAGES_URI; ?>/logo_google.svg">
            </div>
            <div class="col-lg-3 image-container">
                <img class="media-image img-fluid" id="media4" src="<?= THEME_IMAGES_URI; ?>/logo_amazon.svg">
            </div>
        </div>
    </div>
</div>