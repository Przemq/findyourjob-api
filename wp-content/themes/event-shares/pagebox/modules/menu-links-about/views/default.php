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
$postID          = $this->getSelect( 'pageLink' )->getValue()['postID'];
$isBlank         = $this->getInput( 'isBlank' )->getValue();
$newTarget       = $isBlank ? 'target=_blank' : '';
$link            = $this->getInput( 'isPermalink' )->getValue() ? $permalink : $pageLink;
$backgroundImage = "";
$gridNumber      = $this->getSelect( 'grid-number' )->getValue()['id'];


if ( $this->getInput( 'isImage' )->getValue() ) {
	$bgImageUrl      = $this->getMedia( 'backgroundImage' )->getImage()->getUrl( 'full' );
	$backgroundImage = 'style="background-image:url(' . $bgImageUrl . ')"';
}
?>
<?= createTaskLink( 'EV-36' ) ?>
<li class="<?= $module->getClass() ?> <?= $module->isParent( $postID ) ?> <?= $module->isActive( $link ) ?>">

    <a href="<?= $link ?>" <?= $newTarget ?>>
		<?= $title ?>
    </a>
    <ul class="row sub-menu-flex sub-menu" <?= $backgroundImage ?>>
		<?php
		foreach ( $this->getRepeater( 'boxes' ) as $index => $box )

//		    Links for buttons
			:
			$permalink = $box->getInput( 'permalink' )->getValue();
			$pageLink = $box->getSelect( 'pageLink' )->getValue()['permalink'];
			$isBlank = $box->getInput( 'isBlank' )->getValue();
			$newTarget = $isBlank ? 'target=_blank' : '';
			$link = $box->getInput( 'isPermalink' )->getValue() ? $permalink : $pageLink;
			$buttonText = $box->getInput( 'buttonText' );
			?>
            <li class="col-lg-<?= $gridNumber ?> col-sm-12">
                <div class="menu-special-hover">
                    <h4><?= $box->getInput( 'title' ) ?></h4>
					<?= $box->getEditor( 'description' )->getContent(); ?>
					<?php if ( ! empty( $buttonText ) && $buttonText !== "" ) : ?>
                    <a href="<?= $link ?>" <?= $isBlank ?>
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