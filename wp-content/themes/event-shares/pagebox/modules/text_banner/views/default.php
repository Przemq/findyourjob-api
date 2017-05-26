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
            <div class="row large-text-banner">
                <div class="col-lg-8 offset-lg-2">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis pellentesque sodales.
                    Vestibulum vel nunc.
                </div>
            </div>
        </div>
    </div>
</div>