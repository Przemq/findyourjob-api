<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconTextAndCTA $module
 */

$module      = $this->getModule();
$title       = $this->getInput( 'title' );
$description = $this->getEditor( 'description' )->getContent();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
		<?= createTaskLink( 'EV-27' ) ?>
        <div class="row banner-with-download-button">
            <div class="col-lg-8 offset-lg-2 offset-sm-0">
                <div data-aos="fade-right" class="aos-init aos-animate mx-auto magnifier-icon">
					<?php $sectionImageID = $this->getMedia( 'sectionImage' )->getImage()->getId(); ?>
					<?php echo wp_get_attachment_image( $sectionImageID, 'full', false, [ 'class' => 'style-svg' ] ) ?>

                </div>
                <div data-aos-delay="200" data-aos="fade-left"class="aos-init aos-animate">
                <h4 class="title"><?= $title ?></h4>
				<?= $description ?>
				<?php foreach ( $this->getRepeater( 'buttons' ) as $index => $button ):

					?>
					<?php
					$buttonText = $button->getInput( 'buttonTitle' );
					$blank      = $button->getInput( 'buttonBlankLink' )->getValue() ? 'target=_blank' : "";
					if ( $button->getInput( 'isPermalink' )->getValue() ) {
						$url = $button->getInput( 'buttonPermalink' );
					} else {
						$url = $button->getSelect( 'buttonUrl' )->getValue()['permalink'];

					}


					if ( $button->getInput( 'buttonHasImage' )->getValue() ) :
						$buttonID = $button->getMedia( 'buttonImage' )->getImage()->getId();
						?>

                        <a href="<?= $url ?>" <?= $blank ?> class="btn btn-primary download-button">
                            <span><?php echo wp_get_attachment_image( $buttonID, 'full', false, [ 'class' => 'style-svg download-icon' ] ) ?></span>
                            <span class="align-middle"><?= $buttonText ?></span>
                        </a>
					<?php else: ?>
                        <a href="<?= $url ?>" <?= $blank ?> class="btn btn-primary download-button">
                            <span class="align-middle"><?= $buttonText ?></span>
                        </a>

						<?php

					endif;
					?>


					<?php
				endforeach;
				?>
                </div>

            </div>
        </div>
    </div>
</div>