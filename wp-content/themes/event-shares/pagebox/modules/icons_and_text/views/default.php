<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconsAndText $module
 */

$module = $this->getModule();

?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <?= createTaskLink('EV-19') ?>
        <div class="row" id="three-column-boxes">


            <div class="col-lg-12"><h2 id="top-header"><?= $this->getInput( 'title' ) ?></h2></div>
			<?php foreach ( $this->getRepeater( 'sections' ) as $index => $section ) :

				$sectionEditor = $section->getEditor( 'sectionEditor' )->getValue();
				$sectionImageID = $section->getMedia( 'sectionImage' )->getImage()->getId();
				?>
                <div class="col-lg-4">
                    <div class="svg-wrapper first-svg"> <?php echo wp_get_attachment_image( $sectionImageID, 'full', false, [ 'class' => 'style-svg' ] ) ?></div>
                    <p><?= $sectionEditor ?></p>

					<?php

					$buttonText = $section->getInput( 'sectionButton' );
					$url        = $section->getInput( 'sectionButtonUrl' );
					$blank      = $section->getInput( 'sectionButtonBlank' )->getValue() ? 'target=_blank' : "";
//
					if ( ! empty( $buttonText ) && isset( $buttonText ) ) :
						?>
                        <a href="<?= $url ?>" class="button " <?= $blank ?> ><?= $buttonText ?></a>

						<?php
					endif;
					?>
                </div>

				<?php
			endforeach;
			?>
        </div>
    </div>
</div>