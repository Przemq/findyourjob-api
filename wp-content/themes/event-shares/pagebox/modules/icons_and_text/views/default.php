<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconsAndText $module
 */

$module      = $this->getModule();
$titleHeader = $this->getInput( 'typeOfHeader' )->getValue();
$isDescription = $this->getInput( 'isDescription' )->getValue();

?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
		<?= createTaskLink( 'EV-19' ) ?>
        <div class="row" id="three-column-boxes">


            <div class="col-12 <?php if($isDescription) echo 'description-header'; else echo 'title-header'; ?>" >
                <div class="col-md-8 mx-auto"><?= $this->getInput( 'title' ) ?></div>
            </div>
			<?php foreach ( $this->getRepeater( 'sections' ) as $index => $section ) :

				$sectionEditor = $section->getEditor( 'sectionEditor' )->getValue();
				$sectionImageID = $section->getMedia( 'sectionImage' )->getImage()->getId();
				$isButtonEnable = $section->getInput( 'enableButton' )->getValue();
				?>
                <div data-aos-delay="<?= 200 * $index ?>" data-aos="fade-right"
                     class="aos-init aos-animate col-lg-4 md-padd-bottom">
                    <div class="svg-wrapper first-svg"> <?php echo wp_get_attachment_image( $sectionImageID, 'full', false, [ 'class' => '' ] ) ?></div>
                    <div class="md-padd-top">
                        <h4 class="sub-header"><?= $section->getInput('sectionTitle');?></h4>
                        <?= $sectionEditor ?>
						<?php
						$buttonText = $section->getInput( 'sectionButton' );
						$blank      = $section->getInput( 'sectionButtonBlank' )->getValue() ? 'target=_blank' : "";
						if ( $section->getInput( 'isPermalink' )->getValue() ) {
							$url = $section->getInput( 'sectionButtonUrl' );
						} else {
							$url = $section->getSelect( 'pageLink' )->getValue()['permalink'];

						}
						if ( ! empty( $buttonText ) && isset( $buttonText ) ) :
							?>
                            <a href="<?= $url ?>" class="button " <?= $blank ?> <?php if ( ! $isButtonEnable )
								echo 'style="display:none;"' ?> ><?= $buttonText ?></a>

							<?php
						endif;
						?>
                    </div>
                </div>

				<?php
			endforeach;
			?>
        </div>
    </div>
</div>