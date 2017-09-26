<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\HomeBanner $module
 */

$module = $this->getModule();
$bgImage = $this->getMedia('bgImage')->getImage()->getUrl('large');
$title = $this->getInput('title');
$description = $this->getEditor('description')->getContent();
$buttonLeft = $this->getInput('buttonLeftTitle');
$buttonMiddle = $this->getInput('buttonMiddleTitle');
$buttonRight = $this->getInput('buttonRightTitle');
?>
<div class="<?= $module->getClass() ?>">

    <div class="container header-container">
        <?= createTaskLink('EV-16') ?>

        <div class="bottom-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 119 93.4">
                <defs>
                    <style>.a {
                            fill: #56c1a2;
                        }</style>
                </defs>
                <title>header-shape</title>
                <path class="a"
                      d="M65.1,1.3c7.2,2.6,10.1,8.1,13.4,14.8,6,12.1,12.5,23.8,18.8,35.8L119,93.4H85L59.8,45.1c-1.3.3-1.6,1.2-1.9,1.9L35,90.6a4.6,4.6,0,0,0-.9,2.8H0c-.2-1.5.8-2.5,1.4-3.7L9.5,74.2Q25.8,43.1,42.1,11.9c2.3-4.5,6.6-8.9,11.4-10.5C54.1,1.2,59.8-1.6,65.1,1.3Z"/>
            </svg>
        </div>

        <div class="row">

            <div class="col-lg-6 push-lg-6 shape">
                <div class="shape-image">

                    <div class="parallax-window" data-parallax="scroll" data-image-src="<?= $bgImage ?>"></div>
                    <svg class="image-punch" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 263.6 219.7"><title>
                            pu01</title>
                        <path d="M222.1,0A10.1,10.1,0,0,1,221,5.8L144.6,151c-4.8,9.1-19.9,9.1-24.7,0L42.7,5.8A10.1,10.1,0,0,1,41.5,0H0V219.7H263.6V0Z"/>
                    </svg>
                </div>
                <div class="parallax-mask-fix"></div>
            </div>

            <div class="col-lg-6 pull-lg-6 text-content" id="home-banner">
                <?= $this->getEditor('title')->getValue(); ?>
                <?= $description ?>
                <?php
                //                Left button
                if ($this->getInput('buttonLeftOn')->getValue())
                    :?>
                    <?php
                    $url = $this->getSelect('buttonUrlLeft')->getValue()['permalink'];
                    $blank = $this->getInput('buttonLeftBlankLink')->getValue() ? 'target=_blank' : "";
                    ?>
                    <a href="<?= $url ?>" <?= $blank ?> class="btn btn-primary learn-more-button">
                        <span class="align-middle"><?= $buttonLeft ?></span>
                    </a>
                    <?php
                endif;
                ?>

                <?php
                //                Middle Button
                if ($this->getInput('buttonMiddleOn')->getValue())
                    :?>
                    <?php
                    $url = $this->getSelect('buttonUrlMiddle')->getValue()['permalink'];
                    $blank = $this->getInput('buttonMiddleBlankLink')->getValue() ? 'target=_blank' : "";
                    ?>
                    <a href="<?= $url ?>" <?= $blank ?> class="btn btn-primary learn-more-button">
                        <span class="align-middle"><?= $buttonMiddle ?></span>
                    </a>
                    <?php
                endif;
                ?>
                <?php
                //                Right Button
                if ($this->getInput('buttonRightOn')->getValue())
                    :?>
                    <?php
                    $url = $this->getSelect('buttonUrlRight')->getValue()['permalink'];
                    $blank = $this->getInput('buttonRightBlankLink')->getValue() ? 'target=_blank' : "";
                    ?>
                    <a href="<?= $url ?>" <?= $blank ?> class="btn btn-primary learn-more-button">
                        <span class="align-middle"><?= $buttonRight ?></span>
                    </a>
                    <?php
                endif;
                ?>
            </div>


        </div>
    </div>
</div>