<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\LogosModuleNew $module
 */

$module = $this->getModule();
$internalLink = $this->getSelect('internalUrl')->getValue()['permalink'];
$externalButtonLink = $this->getInput('externalURL')->getValue();
$buttonLink = '';

if (empty($internalLink)) {
    $buttonLink = $externalButtonLink;
} else {
    $buttonLink = $internalLink;
}

?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <div class="row">

            <div class="slick-container col-12 image-container">
                <?php foreach ($this->getRepeater('logos') as $index => $section) :
                    /* @var \Nurture\Pagebox\Module\Scope $section */
                    $image = $section->getMedia('logoImage')->getImage()->getUrl();
                    $isBlank = $section->getInput('logoBlank')->getValue() ? ' target=_blank ' : "";
                    $isInternal = $section->getInput('enableInternalLink')->getValue();
                    $internalLink = $section->getSelect('internalUrl')->getValue()['permalink'];
                    ?>
                    <div>
                        <a class="box col-12" <?= $isBlank ?>
                           href="<?php if ($isInternal) echo $internalLink; else echo $section->getInput('logoUrl') ?>">
                            <img class="style-svg" src="<?= $image ?>" alt="logo image">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-12 button-wrapper">
                <?php if ($this->getInput('buttonSwitch')->getValue()) : ?>
                    <a href="<?= $buttonLink ?>"
                       class="logo-button"><?= $this->getInput('buttonText')->getValue(); ?></a>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>