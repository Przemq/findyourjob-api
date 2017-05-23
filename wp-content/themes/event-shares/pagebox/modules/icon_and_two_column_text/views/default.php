<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\IconWithTwoColumnText $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container"><?php include_once('pageContent.php'); ?> <a class="task-number" target="_blank"
                                                                        href="https://nurture.atlassian.net/browse/EV-18">EV-18</a>
        <div class="row" id="home-page-our-etfs">
            <div class="col-lg-2 offset-lg-1 col-sm-3 offset-sm-4" style="text-align: center">
                <img src="<?= THEME_IMAGES_URI; ?>/Event%20Shares%20Icon-01-01.svg" id="home-firm-icon">
            </div>
            <div class="col-lg-4" id="left-column">
                <h4><?php echo $pageContent['home_our_etfs_header']; ?></h4>
                <p><?php echo $pageContent['home_our_etfs_paragraph']; ?></p>
            </div>
            <div class="col-lg-4">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>ABXD</th>
                        <td>EVENTSHARES EMERGING ETFS</td>
                    </tr>
                    <tr>
                        <th>ADCX</th>
                        <td>EVENTSHARES EMERGING MARKETING</td>
                    </tr>
                    <tr>
                        <th>GSDR</th>
                        <td>EVENTSHARES EQULITY MARKETS</td>
                    </tr>
                    <tr>
                        <th>SFRW</th>
                        <td>EVENTSHARES EMERGING MARKETS</td>
                    </tr>
                    <tr>
                        <th>DDFT</th>
                        <td>EVENTSHARES EQULITY MARKETS</td>
                    </tr>
                    <tr>
                        <th>JHGT</th>
                        <td>EVENTSHARES SHORT MARKETS</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>