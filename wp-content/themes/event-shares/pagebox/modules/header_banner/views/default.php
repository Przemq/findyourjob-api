<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\HeaderBanner $module
 */

$module = $this->getModule();
$headerText = $this->getInput('headerText')->getValue();
$paragraphText = $this->getEditor('paragraphText')->getValue();
$isImageBackground = $this->getInput('isImageBackground')->getValue();
$imageBackground = $this->getMedia('imageBackground')->getImage()->getUrl();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container"<?php if ($isImageBackground) echo 'style="background-image:url(' . $imageBackground . ');background-size:cover;"' ?>>
        <?= createTaskLink('EV-23') ?>
        <div class="row header-banner">
            <div class="col-lg-5">
                <h2><?= $headerText ?></h2>
               <?= $paragraphText ?>
            </div>
            <div class="col-8 buttons">
                <?php foreach ($this->getRepeater('buttonRepeater') as $key => $button):
                /* @var \Nurture\Pagebox\Module\Scope $button */
                $buttonText = $button->getInput('buttonText')->getValue();
                    $enableInternalLink = $button->getInput('enableInternalLink')->getValue();
                    $internalUrl = $button->getSelect('internalUrl')->getValue()['permalink'];
                    $externalUrl = $button->getInput('externalUrl')->getValue();
                ?>
                <a href="<?= $enableInternalLink ? $internalUrl : $externalUrl; ?>" class="button header-button"><?= $buttonText ?></a>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>