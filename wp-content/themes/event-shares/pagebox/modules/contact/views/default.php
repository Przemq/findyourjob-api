<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\Contact $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container flip-container">
		<?= createTaskLink( 'EV-29' ) ?>
        <div class="flipper">
            <div class="row front">
				<?php include_once( 'pageContent.php' ); ?>
                <div class="flex-lg-row col-lg-6 col-sm-12" id="contacts">
                    <div class="row">
                        <div class="col-lg-12"><h4><?= $this->getInput( 'title' ); ?></h4></div>
						<?php foreach ( $this->getRepeater( 'addresses' ) as $index => $address ) : ?>
                            <div class="col-lg-6 col-sm-12 padding-bottom">
								<?php if ( $address->getInput( 'isTitle' )->getValue() ) : ?>
                                    <div>
                                        <h5><?= $address->getInput( 'title' ) ?></h5>
                                    </div>
								<?php else: ?>
                                    <div style="padding-top: 26px"></div>
								<?php endif; ?>

								<?= $address->getEditor( 'description' )->getContent(); ?>
                            </div>
						<?php endforeach; ?>

                    </div>
                </div>
                <div id="contact-form" class="col-lg-6 col-sm-12">

					<?php if ( shortcode_exists( 'contact-form-7' ) ) {
						echo do_shortcode( $this->getInput( 'contactFormShortCode' ) );
					}
					?>
                </div>
            </div>
            <div class="row back">
                <h2>Thank you for message</h2>
        </div>
    </div>
</div>