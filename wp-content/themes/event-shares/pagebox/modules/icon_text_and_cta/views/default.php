<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconTextAndCTA $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <?= createTaskLink('EV-27') ?>
        <div class="row" id="banner-with-download-button">
            <div class="col-lg-8 offset-lg-2 offset-sm-0">
                <div class="mx-auto" id="magnifier-icon"><img src="<?= THEME_IMAGES_URI; ?>/ES%20Magnifyglass-Graph%20Icon-01-01.svg"></div>
                <h4 class="">lorem ipsum</h4>
                <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed leo nec nulla lobortis dignissim
                    sit amet at lorem. Morbi aliquam id velit id gravida. In massa nunc, pellentesque vitae ligula at, condimentum
                    hendrerit ante.Morbi  aliquam id velit id gravida. In massa nunc, pellentesque vitae ligula at, condimentum
                    hendrerit ante.</p>
                <a href="#" class="btn btn-primary" id="download-button">
                    <span><img id="download-icon" src="<?= THEME_IMAGES_URI; ?>/Download%20icon-01-01.svg"></span>
                    <span class="align-middle">download pdf</span>
                </a>
            </div>
        </div>
    </div>
</div>