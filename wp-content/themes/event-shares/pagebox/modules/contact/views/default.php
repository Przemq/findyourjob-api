<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\Contact $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container flip-container">
        <?= createTaskLink('EV-29') ?>
        <div class="flipper">
            <div class="row front">
                <div class="flex-lg-row col-lg-6 col-sm-12 contacts">
                    <div class="row">
                        <div class="col-lg-12"><h4><?= $this->getInput('title'); ?></h4></div>
                        <?php foreach ($this->getRepeater('addresses') as $index => $address) : ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 padding-bottom">
                                <?php if ($address->getInput('isTitle')->getValue()) : ?>
                                    <div>
                                        <h5><?= $address->getInput('title') ?></h5>
                                    </div>
                                <?php else: ?>
                                    <div style="padding-top: 26px"></div>
                                <?php endif; ?>
                                <?= $address->getEditor('description')->getContent(); ?>
                                <?php
                                $permalink = $address->getInput('permalink')->getValue();
                                $buttonText = $address->getInput('button');
                                $description = $address->getEditor('description')->getContent();
                                $pageLink = $address->getSelect('pageLink')->getValue()['permalink'];
                                $isBlank = $address->getInput('isBlank')->getValue();
                                $newTarget = $isBlank ? 'target=_blank' : '';
                                $link = $address->getInput('isPermalink')->getValue() ? $permalink : $pageLink;
                                ?>
                                <?php if ($buttonText != "" && !empty($buttonText)): ?>
                                    <div class="button-wrapper">
                                        <a class="button" <?= $newTarget ?> href="<?= $link ?>"><?= $buttonText ?></a>
                                    </div>
                                <?php endif
                                ?>

                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12 contact-form">

                    <?php if (shortcode_exists('contact-form-7')) {
                        echo do_shortcode($this->getInput('contactFormShortCode'));
                    }
                    ?>
                    <?= $this->getEditor('subscriptionDescription')->getContent(); ?>
                </div>
            </div>
            <div class="back">
                <div class="message"><?= $this->getEditor('messageAfterSentOK')->getContent(); ?></div>
            </div>

            <!-- Modal -->
            <div id="subscribe-modal" class="modal fade" role="dialog" tabindex="-1" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="container">
                        <div class="row">
                            <div class="box col-12 col-md-6 col-lg-6">
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address*</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                               aria-describedby="emailHelp" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">User information*</label>
                                        <select class="form-control" id="exampleSelect1">
                                            <option>I am individual investor</option>
                                            <option>I am Financial Advisor / RIA Wirehouse</option>
                                            <option>I am Family Office Institutional</option>
                                            <option>I am Investor Non-US Investor</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary button">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>