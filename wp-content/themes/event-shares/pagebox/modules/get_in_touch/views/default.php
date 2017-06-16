<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\GetInTouch $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <?= createTaskLink('EV-50') ?>
        <div class="row">
            <div class="col-lg-12 get-in-touch">
	            <?php
	            $url   = $this->getSelect( 'buttonUrl' )->getValue()['permalink'];
	            if (empty($url) && !isset($url)){
	                $url = get_permalink(23);
                }
	            $blank = $this->getInput( 'buttonBlankLink' )->getValue() ? 'target=_blank' : "";
	            ?>
                <h2><a href="<?=$url?>" <?=$blank?>>
                <?=$this->getInput('title')?>
                </a></h2>
            </div>
        </div>
    </div>
</div>