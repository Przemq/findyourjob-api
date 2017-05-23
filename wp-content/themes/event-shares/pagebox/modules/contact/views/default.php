<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\Contact $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-29">EV-29</a>
        <div class="row">
            <?php include_once('pageContent.php');?>
            <div class="flex-lg-row col-lg-6 col-sm-12" id="contacts">
                <div class="row">
                    <div class="col-lg-12" ><h4><?php echo $pageContent['contacts'] ?></h4></div>
                    <div class="col-lg-4 col-sm-12 padding-bottom" >
                        <h5><?php echo $pageContent['contact_header1'] ?></h5>
                        <span><?php echo $pageContent['contact_paragraph11'] ?><br></span>
                        <span><?php echo $pageContent['contact_paragraph12'] ?><br></span>
                        <span><?php echo $pageContent['contact_paragraph13'] ?></span>
                    </div>
                    <div class="col-lg-4 col-sm-12 offset-lg-2 padding-bottom">
                        <h5>Media Inquiries</h5>
                        <span><?php echo $pageContent['contact_paragraph11'] ?><br></span>
                        <span><?php echo $pageContent['contact_paragraph12'] ?><br></span>
                        <span><?php echo $pageContent['contact_paragraph13'] ?></span>
                    </div>
                    <div class="col-lg-4 col-sm-12 padding-bottom">
                        <h5><?php echo $pageContent['contact_header1'] ?></h5>
                        <span><?php echo $pageContent['contact_paragraph11'] ?><br></span>
                        <span><?php echo $pageContent['contact_paragraph12'] ?><br></span>
                        <span><?php echo $pageContent['contact_paragraph13'] ?></span>
                    </div>
                    <div class="col-lg-4 offset-lg-2 col-sm-12 padding-bottom">
                        <h5><?php echo $pageContent['contact_header1'] ?></h5>
                        <span><?php echo $pageContent['contact_paragraph11'] ?><br></span>
                        <span><?php echo $pageContent['contact_paragraph12'] ?><br></span>
                        <span><?php echo $pageContent['contact_paragraph13'] ?></span>
                    </div>
                </div>
            </div>


            <div id="contact-form" class="col-lg-6 col-sm-12">
                <form class="row">
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control small-input rounded-0" id="first-name"
                               placeholder="First name">
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control small-input rounded-0" id="last-name"
                               placeholder="Last name">
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="tel" class="form-control small-input rounded-0" id="tel-number"
                               placeholder="Tel number">
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="email" class="form-control small-input rounded-0" id="email-address"
                               placeholder="Email address">
                    </div>
                    <div class="form-group col-lg-12">
                        <textarea type="text" class="form-control rounded-0" id="message" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="submit" class="btn btn-primary" id="submit-button">
                            <?php echo $pageContent['send_button']; ?>
                        </button>
                        <p><?php echo $pageContent['contact_form_paragraph']; ?></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>