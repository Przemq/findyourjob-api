<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\MenuLinksDefault $module
 */

$module    = $this->getModule();
$title     = $this->getInput( 'title' )->getValue();
$permalink = $this->getInput( 'permalink' )->getValue();
$pageLink  = $this->getSelect( 'pageLink' )->getValue()['permalink'];
$isBlank   = $this->getInput( 'isBlank' )->getValue();
$newTarget = $isBlank ? 'target=_blank' : '';
$link      = $this->getInput( 'isPermalink' )->getValue() ? $permalink : $pageLink;
$postID = $this->getSelect( 'pageLink' )->getValue()['postID']

?>


<?= createTaskLink( 'EV-36' ) ?>
<li class="<?= $module->getClass() ?> <?= $module->isParent( $postID ) ?> <?= $module->isActive( $link ) ?>">
    <a href="<?= $link ?>" <?= $newTarget ?>>
		<?= $title ?>
    </a>
</li>