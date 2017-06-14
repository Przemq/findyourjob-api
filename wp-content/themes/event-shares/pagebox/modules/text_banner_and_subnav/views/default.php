<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\SubnavAndText $module
 */

$module = $this->getModule();
$hash   = $module->getHash();
$uniqID = uniqid( rand( 1, 999 ) );
?>
<div class="<?= $module->getClass() ?>">


    <div class="container" id="sub-nav">
		<?= createTaskLink( 'EV-33' ) ?>
        <a href="#" class="nav-tabs-dropdown <?= $module->changeNav() ?>">Dropdown-nav</a>
        <ul class="nav-tabs-wrapper nav-tabs nav-tabs-horizontal list-inline row no-gutters <?= $module->changeNavTabs() ?>"
            role="tablist">
			<?php foreach ( $this->getRepeater( 'timeline' ) as $index => $timeLine ):

				$title = $timeLine->getInput( 'title' )->getValue();
				?>
                <li class="nav-item custom-nav-item list-inline-item <?= $module->colsTabs() ?>">
                    <a <?php echo ( $index == 0 ) ? 'class="active"' : '' ?>
                            href="#htab-<?= $index ?>-<?= $uniqID ?>" data-toggle="tab"
                            aria-expanded="true"><?= $title ?>asdsad</a></li>

				<?php
			endforeach;
			?>
        </ul>
    </div>
    <div class="tab-content">
		<?php foreach ( $this->getRepeater( 'timeline' ) as $index => $timeLine ):
			$permalink = $timeLine->getInput( 'permalink' )->getValue();
			$buttonText = $timeLine->getInput( 'button' );
			$description = $timeLine->getEditor( 'description' )->getContent();
			$pageLink = $timeLine->getSelect( 'pageLink' )->getValue()['permalink'];
			$isBlank = $timeLine->getInput( 'isBlank' )->getValue();
			$newTarget = $isBlank ? 'target=_blank' : '';
			$link = $timeLine->getInput( 'isPermalink' )->getValue() ? $permalink : $pageLink;
			?>
            <div role="tabpanel"
                 class="tab-pane<?php echo ( $index == 0 ) ? ' active' : '' ?> <?= $module->paddingControl() ?>"
                 id="htab-<?= $index ?>-<?= $uniqID ?>">
                <div class="container text-content justify-content-center">
					<?= $description ?>
					<?php if ( ! empty( $buttonText ) && $buttonText != "" ):
						?>
                        <div class="button-wrapper">
                            <a class="button" <?= $newTarget ?> href="<?= $link ?>"><?= $buttonText ?></a>
                        </div>
					<?php endif; ?>
                </div>
            </div>
		<?php endforeach; ?>
    </div>
</div>