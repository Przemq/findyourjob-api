<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\LogosModule $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <?= createTaskLink('EV-49') ?>
        <div class="row" id="in-the-media">
            <div class="col-lg-12">
				<?php if ( $this->getInput( 'titleSwitch' )->getValue() ) : ?>
                    <h4><?=$this->getInput('title')?></h4>
					<?php
				endif;
				?>
            </div>
            <div class="col-lg-12 image-container">
				<?php foreach ( $this->getRepeater( 'logos' ) as $index => $section ) :
					$ImageID = $section->getMedia( 'logoImage' )->getImage()->getId();
					$isBlank = $section->getInput( 'logoBlank' )->getValue() ? ' target=_blank ' : "";
					?>
                    <a <?= $isBlank ?> href="<?= $section->getInput( 'logoUrl' ) ?>">
						<?php echo wp_get_attachment_image( $ImageID, 'full', false, [ 'class' => 'media-image' ] ) ?>
                    </a>
					<?php
				endforeach;
				?>
            </div>
        </div>
    </div>
</div>