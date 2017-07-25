<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconAndText $module
 */

$module = $this->getModule();
$internalUrl = $this->getSelect('linkUrl')->getValue()['permalink'];
$externalLink = $this->getInput('externalLink')->getValue();
$linkText = $this->getInput('linkText')->getValue();
$showLink = $this->getInput('isLinkEnable')->getValue();
$enableInternalLinks = $this->getInput('enableInternalLink')->getValue();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <?= createTaskLink('EV-22') ?>
        <div class="icon-and-text">
            <div class="col-lg-12">
                <img class="img-fluid style-svg" id="firm-icon"
                     src="<?= $this->getMedia('imageUrl')->getImage()->getUrl() ?>">
            </div>
            <div class="col-lg-6 offset-lg-3"><?= $this->getEditor('textUnderImage')->getValue(); ?>
                <a href="<?php if ($enableInternalLinks) echo $internalUrl; else echo $externalLink; ?>"
                   class="button" <?php if (!$showLink) echo 'style="display:none;"' ?>><?= $linkText ?></a>

            </div>
        </div>
    </div>
</div>