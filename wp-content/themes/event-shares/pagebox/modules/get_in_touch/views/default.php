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
        <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-50">EV-50</a>
        <div class="row">
            <div class="col-lg-12 get-in-touch">
	            <?php
	            $url   = $this->getSelect( 'buttonUrl' )->getValue()['permalink'];
	            if (empty($url) && !isset($url)){
	                $url = get_permalink(23);
                }
	            $blank = $this->getInput( 'buttonBlankLink' )->getValue() ? 'target=_blank' : "";
	            ?>
                <a href="<?=$url?>" <?=$blank?>>
                <?=$this->getInput('title')?>
                </a>
            </div>
        </div>
    </div>
</div>