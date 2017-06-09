<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\MenuAboutFlyout $module
 */

$module          = $this->getModule();
$title           = $this->getInput( 'title' )->getValue();
$permalink       = $this->getInput( 'permalink' )->getValue();
$pageLink        = $this->getSelect( 'pageLink' )->getValue()['permalink'];
$isBlank         = $this->getInput( 'isBlank' )->getValue();
$newTarget       = $isBlank ? 'target=_blank' : '';
$link            = $this->getInput( 'isPermalink' )->getValue() ? $permalink : $pageLink;
$backgroundImage = "";
if ( $this->getInput( 'isImage' )->getValue() ) {
	$bgImageUrl      = $this->getMedia( 'backgroundImage' )->getImage()->getUrl( 'full' );
	$backgroundImage = 'style="background-image:url(' . $bgImageUrl . ')"';
}
?>
<li class="<?= $module->getClass() ?> <?=$module->isActive($link)?>">
    <a href="<?= $link ?>" <?= $newTarget ?>>
		<?= $title ?>
    </a>
    <ul class="row sub-menu-flex sub-menu" <?= $backgroundImage ?>>
		<?php
		foreach ( $this->getRepeater( 'boxes' ) as $index => $box )
			:
			$buttonText = $box->getInput( 'buttonText' );
			?>
            <li class="col-lg-4 col-sm-12">
                <div class="menu-special-hover">
                    <h4><?= $box->getInput( 'buttonText' ) ?></h4>
					<?= $box->getEditor( 'description' )->getContent(); ?>
					<?php if ( ! empty( $buttonText ) && $buttonText !== "" ) : ?>
                    <a href="<?= $box->getInput( 'permalink' ) ?>"
                       class="learn-description"><?= $buttonText ?></a>
                </div>
				<?php
				endif;
				?>
            </li>
			<?php
		endforeach;
		?>
    </ul>


</li>