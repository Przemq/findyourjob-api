<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\HeadingAndTExt $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <?= createTaskLink('EV-20') ?>
        <div class="row">
            <div class="col-8">
                <div class="wrapper">
                <h3><?= $this->getInput('title')->getValue(); ?></h3>
                <?= $this->getEditor('content')->getValue(); ?>
                </div>
            </div>
        </div>
    </div>
</div>