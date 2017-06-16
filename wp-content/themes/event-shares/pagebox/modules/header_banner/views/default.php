<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\HeaderBanner $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <?= createTaskLink('EV-23') ?>
        <div class="row header-banner">
            <div class="col-lg-5">
                <h2>about us</h2>
                <p>Lorem ipsum dolor sit  amet, consectetur adipiscing elit. Nulla interdum sapien sapien, vel efficitur
                    dui vehicula laoreet. Sed facilisis ornare tellus a mattis. Mauris volutpat enim eget nibh finibus,
                    quis tempor orci pretium.</p>
            </div>
        </div>
    </div>
</div>