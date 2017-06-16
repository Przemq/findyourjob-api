<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\VerticalTimeLine $module
 */

$module = $this->getModule();
$titleHeader = $this->getInput('typeOfHeader')->getValue();

?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <?= createTaskLink('EV-63') ?>
        <div class="row">
            <div class="col-12 header"><h4>our history</h4></div>
            <div class="col-6 mx-auto description">Our founders envisioned a sophisticated, tailored approach to
                investing around mutli-dimensional events and themes. In August 2016,we filed our first documents with
                the SEC and started building what is now EventShares.
            </div>
        </div>

        <!-- timeline -->
        <div class="row">
            <div class="timeline hidden-sm-down">
                <ul class="days">
                    <li class="day">
                        <div class="events">
                            <h4>In the Beginning..</h4>
                            <p>Financial industry veterans noticed that no on was doing frictionless, in-experience
                                trading execution - and they saw an opportunity.</p>
                        </div>
                    </li>

                    <li class="day">
                        <div class="events">
                            <h4>And then We Created TRADEIT</h4>
                            <p>We hired a few designers and developers and created a mobile first way of placing orders
                                and managing your accounts in app.</p>
                        </div>
                    </li>


                    <li class="day">
                        <div class="events">
                            <h4>Hard Work Pays Off</h4>
                            <p>Tradelt in now partnered with over 90 financial mobile apps, sites, and social media
                                platforms. The company has quickly linked over $10BN in assets and processed over $3.7BN
                                in orders.</p>
                        </div>
                    </li>

                    <li class="day">
                        <div class="events">
                            <h4>And Here We Are Now</h4>
                            <p>Our headcount has doubled since the summer, and we are looking for great (and easy to
                                use) investment products we have in the pipeline.</p>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <!-- end timeline -->

    </div>
</div>