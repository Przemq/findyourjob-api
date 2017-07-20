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
                <div id="wrapper" class="col-12">

                    <?= $this->getEditor('Text')->getContent(); ?>

                </div>
                <?php
                if ($this->getInput('buttonSwitch')->getValue()):
                    if ($this->getInput('isPermalink')->getValue()) {
                        $url = $this->getInput('buttonUrl');
                    } else {
                        $url = $this->getSelect('pageLink')->getValue()['permalink'];

                    }

                    $blank = $this->getInput('buttonBlank')->getValue() ? 'target=_blank' : "";
                    ?>
                    <a href="<?= $url ?>" <?= $blank ?> class="button" style="margin:auto">
                        <span><?= $this->getInput('button') ?></span></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>