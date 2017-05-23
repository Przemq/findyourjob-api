<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconsAndText $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container"><?php include_once('pageContent.php') ?>
        <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-19">EV-19</a>
        <div class="row" id="three-column-boxes">
            <div class="col-lg-12"><h4 id="top-header"><?php echo $pageContent['header2']; ?></h4></div>
            <div class="col-lg-4">
                <div style="margin-bottom: 20px; height: 105px"><img src="<?= THEME_IMAGES_URI; ?>/ES Nav Icon-01-01.svg" id="icon1"></div>
                <h4 class="sub-header"><?php echo $pageContent['three_column_sub_header1']; ?></h4>
                <p><?php echo $pageContent['three_column_sub_paragraph1']; ?></p>
            </div>
            <div class="col-lg-4">
                <div style="margin-bottom: 20px;  height: 105px"><img src="<?= THEME_IMAGES_URI; ?>/ES%20Magnifyglass-Graph%20Icon-01-01.svg" id="icon2"></div>
                <h4 class="sub-header"><?php echo $pageContent['three_column_sub_header2']; ?></h4>
                <p><?php echo $pageContent['three_column_sub_paragraph2']; ?></p>
            </div>
            <div class="col-lg-4">
                <div style="margin-bottom: 20px;  height: 105px"><img src="<?= THEME_IMAGES_URI; ?>/ES%20Pie%20Graph%20Icon-01-01.svg" id="icon3"></div>
                <h4 class="sub-header"><?php echo $pageContent['three_column_sub_header3']; ?></h4>
                <p><?php echo $pageContent['three_column_sub_paragraph3']; ?></p>
            </div>
        </div>
    </div>
</div>