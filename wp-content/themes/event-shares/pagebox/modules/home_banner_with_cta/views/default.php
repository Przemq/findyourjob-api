<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\HomeBanner $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-16">EV-16</a>
        <div class="row" id="home-banner">
            <div class="col-lg-6">
                <h2>active <br>weighting <span id="header-second-color">etf</span></h2>
            </div>
            <div class="col-lg-12"></div>
            <div class="col-lg-5">
                <p>Lorem ipsum dolor mollis pellentesque sit amet, consectetur adipiscing elit. Aenean mollis
                    pellentesque sodales.
                    Vestibulum vel nunc consectetur adipiscing elit sed nisi dapibus dictum. Curabitur aliquet tortor
                    vitae pellentesque ultricies.</p>
                <a href="#" class="btn btn-primary" id="learn-more-button">
                    <span class="align-middle">learn more</span>
                </a>
            </div>
        </div>
    </div>
</div>