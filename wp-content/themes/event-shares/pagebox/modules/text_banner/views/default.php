<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\TextBanner $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container-fluid">
        <div class="container">
            <?= createTaskLink('EV-17') ?>
            <div class="row large-text-banner">
                <div class="col-lg-8 offset-lg-2">

					<?= $this->getEditor( 'Text' )->getContent(); ?>

					<?php
					if ( $this->getInput( 'buttonSwitch' )->getValue() ):
						$url = $this->getInput( 'buttonUrl' );
						$blank = $this->getInput( 'buttonBlank' )->getValue() ? 'target=_blank' : "";
						?>

                        <a href="<?= $url ?>" <?= $blank ?> class="button">
                            <span><?= $this->getInput( 'button' ) ?></span></a>
					<?php endif;
					?>
                </div>
            </div>
        </div>
    </div>
</div>