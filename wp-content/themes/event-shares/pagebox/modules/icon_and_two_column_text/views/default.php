<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconWithTwoColumnText $module
 */

$module      = $this->getModule();
$title       = $this->getInput( 'title' );
$description = $this->getEditor( 'description' )->getContent();
$table       = $this->getEditor( 'description' )->getContent();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container"><?= createTaskLink('EV-18') ?>
        <div class="row" id="home-page-our-etfs">
            <div class="col-lg-2 offset-lg-1 col-sm-12 offset-sm-0 col-12 offset-0 svg-image">
                <?php $sectionImageID = $this->getMedia( 'sectionImage' )->getImage()->getId();?>
	            <?php echo wp_get_attachment_image( $sectionImageID, 'full', false, [ 'class' => 'style-svg' ] ) ?>
            </div>
            <div class="col-lg-4 col-12" id="left-column">
                <h4><?= $title ?></h4>
				<?= $description ?>

				<?php
				if ( $this->getInput( 'buttonOn' )->getValue() ):

					$url = $this->getSelect( 'buttonUrl' )->getValue()['permalink'];
					$blank = $this->getInput( 'buttonBlankLink' )->getValue() ? 'target=_blank' : "";
					$button = $this->getInput( 'buttonTitle' );
					?>
                    <a href="<?= $url ?>" <?= $blank ?> class="button">
                        <span class="align-middle"><?= $button ?></span>
                    </a>
					<?php
				endif;
				?>

            </div>
            <div class="col-lg-4 hidden-md-down">
                <table class="table">
                    <tbody>
					<?php
					foreach ( $this->getRepeater( 'rows' ) as $index => $repeater )
						:
						$rowUrl = $repeater->getInput( 'rowUrl' );
						$blank = $repeater->getInput( 'rowUrlBlank' )->getValue() ? 'target=_blank' : "";

						?>
                        <tr class="aos-init" data-aos="zoom-in-left" data-aos-delay="<?=150*$index?>ms">


                            <th><a  href="<?= $rowUrl ?>" <?= $blank ?>>
									<?= $repeater->getInput( 'rowBoldText' ); ?></a></th>
                            <td><a  href="<?= $rowUrl ?>" <?= $blank ?>><?= $repeater->getInput( 'rowText' ); ?></a></td>

                        </tr>


						<?php
					endforeach;
					?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>