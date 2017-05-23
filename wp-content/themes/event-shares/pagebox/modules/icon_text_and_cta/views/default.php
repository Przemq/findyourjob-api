<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconTextAndCTA $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container"><?php include_once('pageContent.php');?>
        <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-16">EV-27</a>
        <div class="row" id="banner-with-download-button">
            <div class="col-lg-8 offset-lg-2 offset-sm-0">
                <div class="mx-auto" id="magnifier-icon"><img src="<?= THEME_IMAGES_URI; ?>/ES%20Magnifyglass-Graph%20Icon-01-01.svg"></div>
                <h4 class=""><?php echo $pageContent['header1'] ?></h4>
                <p class=""><?php echo $pageContent['paragraph1'] ?></p>
                <a href="#" class="btn btn-primary" id="download-button">
                    <span><img id="download-icon" src="<?= THEME_IMAGES_URI; ?>/Download%20icon-01-01.svg"></span>
                    <span class="align-middle"><?php echo $pageContent['download_button'] ?></span>
                </a>
            </div>
        </div>
    </div>
</div>