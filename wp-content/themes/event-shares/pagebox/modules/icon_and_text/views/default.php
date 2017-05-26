<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconAndText $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-22">EV-22</a>
        <div class="row" id="top-page-image-with-text">
            <div class="col-lg-12">
                <img class="img-fluid" id="firm-icon" src="<?= THEME_IMAGES_URI; ?>/Event%20Shares%20Icon-01-01.svg">
            </div>
            <div class="col-lg-6 offset-lg-3"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla interdum
                    sapien sapien, vel efficitur dui vehicula laoreet. Sed facilisis ornare tellus a mattis. Mauris
                    volutpat enim eget nibh finibus, quis tempor orci pretium. Ut gravida vehicula dui, ac tincidunt
                    arcu feugiat at. Nam varius eleifend risus ac aliquam. Sed semper.</p></div>
        </div>
    </div>
</div>