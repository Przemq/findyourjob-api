<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\MenuAboutFlyout $module
 */

$module = $this->getModule();
$title = $this->getInput('title')->getValue();
$permalink = $this->getInput('permalink')->getValue();
$pageLink = $this->getSelect('pageLink')->getValue()['permalink'];
$postID = $this->getSelect('pageLink')->getValue()['postID'];
$isBlank = $this->getInput('isBlank')->getValue();
$newTarget = $isBlank ? 'target=_blank' : '';
$link = $this->getInput('isPermalink')->getValue() ? $permalink : $pageLink;
$backgroundImage = "";
$gridNumber = $this->getSelect('grid-number')->getValue()['id'];
$repeater = $this->getRepeater('boxes');

if ($this->getInput('isImage')->getValue()) {
    $bgImageUrl = $this->getMedia('backgroundImage')->getImage()->getUrl('full');
    $backgroundImage = 'style="background-image:url(' . $bgImageUrl . ')"';
}
?>
<li class="flyout-module-wrapper <?= $module->getClass() ?> <?= $module->isParent($postID) ?>  <?= $module->hasChildrens($repeater) ?> <?= $module->isActive($link) ?>">

    <a class="main-link" href="<?= $link ?>" <?= $newTarget ?>>
        <?= $title ?>
    </a>
    <ul class="row sub-menu-flex sub-menu" <?= $backgroundImage ?>>
        <?php
        foreach ($repeater as $index => $box)
            /* @var \Nurture\Pagebox\Module\Scope $box */
//		    Links for buttons
            :
            $permalink = $box->getInput('permalink')->getValue();
            $pageLink = $box->getSelect('pageLink')->getValue()['permalink'];
            $isBlank = $box->getInput('isBlank')->getValue();
            $newTarget = $isBlank ? 'target=_blank' : '';
            $link = $box->getInput('isPermalink')->getValue() ? $permalink : $pageLink;
            $buttonText = $box->getInput('buttonText');
            $tabID = $box->getInput('insightID')->getValue();

            // Create correct link
            if (!empty($tabID)) {
                $link = $link . '#' . $tabID;
            }


            ?>
            <li class="col-lg-<?= $gridNumber ?> col-sm-12">
                <div class="menu-special-hover">
                    <a href="<?= $link; ?>" <?= $newTarget ?> class="to-refresh-tab">
                        <h4><?= $box->getInput('title')->getValue(); ?></h4>
                    </a>
                    <?php if (!empty($box->getInput('subTitle')->getValue())): ?>
                        <a href="<?= $link; ?>" <?= $newTarget ?> class="to-refresh-tab"><h5><?= $box->getInput('subTitle')->getValue() ?></h5>
                        </a>
                    <?php endif; ?>
                    <?= $box->getEditor('description')->getContent(); ?>
                    <?php if (!empty($buttonText) && $buttonText !== "") : ?>
                </div>
                <?php endif;
                ?>
                <a href="<?= $link; ?>" <?= $newTarget ?>
                   class="learn-description to-refresh-tab"><?= $buttonText ?></a>
            </li>

            <?php
        endforeach;
        ?>
    </ul>


    <ul class="row sub-menu-mobile-flex">
        <?php
        foreach ($this->getRepeater('boxes') as $index => $box)
            /* @var \Nurture\Pagebox\Module\Scope $box */
//		    Links for buttons
            :
            $permalink = $box->getInput('permalink')->getValue();
            $pageLink = $box->getSelect('pageLink')->getValue()['permalink'];
            $isBlank = $box->getInput('isBlank')->getValue();
            $newTarget = $isBlank ? 'target=_blank' : '';
            $link = $box->getInput('isPermalink')->getValue() ? $permalink : $pageLink;
            $tabID = $box->getInput('insightID')->getValue();
            ?>
            <li class="col-lg-<?= $gridNumber ?> col-sm-12 <?= $module->isActive($link) ?>">
                <h4><a href="<?= $link; ?>" <?= $isBlank ?>><?= $box->getInput('title') ?></a></h4>
            </li>
            <?php
        endforeach;
        ?>
    </ul>

</li>