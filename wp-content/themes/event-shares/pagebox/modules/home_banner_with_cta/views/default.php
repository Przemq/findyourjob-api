<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\HomeBanner $module
 */

$module       = $this->getModule();
$bgImage      = $this->getMedia( 'bgImage' )->getImage()->getUrl( 'normal' );
$title        = $this->getInput( 'title' );
$titleInner   = $this->getInput( 'titleInner' );
$description  = $this->getEditor( 'description' )->getContent();
$buttonLeft   = $this->getInput( 'buttonLeftTitle' );
$buttonMiddle = $this->getInput( 'buttonMiddleTitle' );
$buttonRight  = $this->getInput( 'buttonRightTitle' );
?>
<div class="<?= $module->getClass() ?>">

    <div class="container">
        <?= createTaskLink('EV-16') ?>
        <div class="row"">
            <div class="col-lg-6 text-content">
                <h2><?= $title ?><span id="header-second-color"><?= $titleInner ?></span></h2>

				<?= $description ?>
				<?php
//                Left button
				if ( $this->getInput( 'buttonLeftOn' )->getValue() )
					:?>
					<?php
					$url   = $this->getSelect( 'buttonUrlLeft' )->getValue()['permalink'];
					$blank = $this->getInput( 'buttonLeftBlankLink' )->getValue() ? 'target=_blank' : "";
					?>
                    <a href="<?= $url ?>" <?= $blank ?> class="btn btn-primary learn-more-button">
                        <span class="align-middle"><?= $buttonLeft ?></span>
                    </a>
					<?php
				endif;
				?>

	            <?php
//                Middle Button
	            if ( $this->getInput( 'buttonMiddleOn' )->getValue() )
		            :?>
		            <?php
		            $url   = $this->getSelect( 'buttonUrlMiddle' )->getValue()['permalink'];
		            $blank = $this->getInput( 'buttonMiddleBlankLink' )->getValue() ? 'target=_blank' : "";
		            ?>
                    <a href="<?= $url ?>" <?= $blank ?> class="btn btn-primary learn-more-button">
                        <span class="align-middle"><?= $buttonMiddle ?></span>
                    </a>
		            <?php
	            endif;
	            ?>
	            <?php
//                Right Button
	            if ( $this->getInput( 'buttonRightOn' )->getValue() )
		            :?>
		            <?php
		            $url   = $this->getSelect( 'buttonUrlRight' )->getValue()['permalink'];
		            $blank = $this->getInput( 'buttonRightBlankLink' )->getValue() ? 'target=_blank' : "";
		            ?>
                    <a href="<?= $url ?>" <?= $blank ?> class="btn btn-primary learn-more-button">
                        <span class="align-middle"><?= $buttonRight ?></span>
                    </a>
		            <?php
	            endif;
	            ?>
            </div>
            <div class="col-lg-6 shapes">
                <div class="shape-image">
                    <img src="<?= THEME_IMAGES_URI ?>/sample-image.jpg">
                    <img class="svg-image image-punch" src="<?= THEME_IMAGES_URI ?>/punch-01.svg" alt="">
                </div>

            </div>

        </div>
    </div>
</div>