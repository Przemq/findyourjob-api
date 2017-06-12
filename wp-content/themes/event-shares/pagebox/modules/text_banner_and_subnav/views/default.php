<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\SubnavAndText $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container-fluid">
        <div class="container" id="sub-nav">
            <?= createTaskLink('EV-33') ?>
            <div class="row">
                <div class="col-lg-12">

                    <ul class="nav nav-tabs hidden-sm-down" role="tablist" style="border-bottom-color: black">
                        <li class="nav-item single-li-item">
                            <a class="nav-link active single-link" data-toggle="tab" href="#our-firm" role="tab" >Our Firm</a>
                            <div class="line">

                            </div>
                        </li>
                        <li class="nav-item single-li-item">
                            <a class="nav-link single-link" data-toggle="tab" href="#the-team" role="tab">The Team</a>
                            <div class="line hidden">

                            </div>
                        </li>
                        <li class="nav-item single-li-item">
                            <a class="nav-link single-link" data-toggle="tab" href="#etf-education" role="tab">ETF Education</a>
                            <div class="line">

                            </div>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="our-firm" role="tabpanel"><p class="col-lg-8 offset-lg-2 offset-sm-0">1 Lorem ipsum dolor quam, sit amet, vitae et ullamcorper, vitae  netus neque morbi mauris sed vel tempor.</p></div>
                        <div class="tab-pane" id="the-team" role="tabpanel"><p class="col-lg-8 offset-lg-2 offset-sm-0">2 Lorem ipsum dolor sit amet, duis vitae et ullamcorper, quam, neque morbi mauris sed vel tempor.</p></div>
                        <div class="tab-pane" id="etf-education" role="tabpanel"><p class="col-lg-8 offset-lg-2 offset-sm-0">3 Lorem ipsum dolor si quam,t amet, duis vitae et ullamquam, corper, morbi mauris sed vel tempor.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>