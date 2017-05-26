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

            <?php for ($i=0; $i<4; $i++): ?>
            <div class="col-sm-6 col-6 col-lg-3 image-container">
                <img class="media-image" src="<?= THEME_IMAGES_URI; ?>/<?=($i%2)?'logo_microsoft.svg':'logo_yahoo.svg'?>">
            </div>
            <?php endfor; ?>
        </div>
    </div>
</div>