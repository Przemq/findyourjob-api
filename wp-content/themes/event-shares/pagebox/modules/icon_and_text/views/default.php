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
        <div class="row" id="top-page-image-with-text">
            <div class="col-12">
                <div id="firm-icon">
                    <img class="style-svg"
                         src="<?= $this->getMedia('imageUrl')->getImage()->getUrl() ?>" alt="event shares icon">
                </div>
            </div>
            <div class="button-wrapper">
                <div class="col-lg-6 offset-lg-3"><?= $this->getEditor('textUnderImage')->getValue(); ?>
                    <a href="<?php if ($enableInternalLinks) echo $internalUrl; else echo $externalLink; ?>"
                       class="button" <?php if (!$showLink) echo 'style="display:none;"' ?>><?= $linkText ?></a>
                </div>
            </div>
        </div>
    </div>
</div>