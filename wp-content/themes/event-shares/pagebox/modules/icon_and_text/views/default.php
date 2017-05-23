<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconAndText $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container"><?php include_once('pageContent.php')?>
        <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-22">EV-22</a>
        <div class="row" id="top-page-image-with-text">
            <div class="col-lg-12">
                <img class="img-fluid" id="firm-icon" src="<?= THEME_IMAGES_URI; ?>/Event%20Shares%20Icon-01-01.svg">
            </div>
            <div class="col-lg-6 offset-lg-3"><p><?php echo $pageContent['paragraph'] ?></p></div>
        </div>
    </div>
</div>