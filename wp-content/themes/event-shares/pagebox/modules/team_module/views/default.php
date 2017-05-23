<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\TeamModule $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/EV-24">EV-24</a>
        <div id="board-of-advisors">
            <div class="row">
                <div class="col-lg-12">
                    <?php include_once('pageContent.php') ?>
                    <h4><?php echo $pageContent['board_of_advisors'] ?></h4>
                </div>
                <div class="col-lg-6">
                    <p><?php echo $pageContent['board_of_advisors_paragraph'] ?></p>
                </div>
            </div>
            <div id="employees">
                <div class="row employee-row">

                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header11'] ?></h5>
                        <p><?php echo $pageContent['paragraph11'] ?></p>
                    </div>

                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header12'] ?></h5>
                        <p><?php echo $pageContent['paragraph12'] ?></p>
                    </div>
                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header13'] ?></h5>
                        <p><?php echo $pageContent['paragraph13'] ?></p>
                    </div>
                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header14'] ?></h5>
                        <p><?php echo $pageContent['paragraph14'] ?></p>
                    </div>
                    <div>
                        <div class="row triangle-pointer"></div>
                        <div class="drop-down-item row" id="test">
                            <div class="col-lg-10">
                                <h5>Lorem impsum dolor sit amet, consectetur adipiscing elit. Aenean mollis pellentesque
                                    sodales. Vestibulum vel nunc sed nisi dapibus dictum. Curabitur aliquet tortor vitae
                                    pellentesque ultricies. Ut faucibus vel nunc sed nisi ur et nosa cauntis dapibus
                                    dictum.</h5>
                            </div>
                            <p class="col-lg-6">Lorem impsum dolor sit amet, consectetur adipiscing elit. Aenean mollis
                                pellentesque
                                sodales. Vestibulum vel nunc sed nisi dapibus dictum. Curabitur aliquet tortor vitae
                                pellentesque ultricies. Ut faucibus.Lorem impsum dolor sit amet, consectetur adipiscing
                                elit. Aenean mollis pellentesque
                                sodales. Vestibulum vel nunc sed nisi dapibus dictum. Curabitur aliquet.</p>
                            <p class="col-lg-6">Lorem impsum dolor sit amet, consectetur adipiscing elit. Aenean mollis
                                pellentesque
                                sodales. Vestibulum vel nunc sed nisi dapibus dictum. Curabitur aliquet tortor vitae
                                pellentesque ultricies. Ut faucibus.Lorem impsum dolor sit amet, consectetur adipiscing
                                elit. Aenean mollis pellentesque
                                sodales. Vestibulum vel nunc sed nisi dapibus dictum. Curabitur aliquet.</p>
                            <p class="col-lg-6">Lorem impsum dolor sit amet, consectetur adipiscing elit. Aenean mollis
                                pellentesque
                                sodales. Vestibulum vel nunc sed nisi dapibus dictum. Curabitur aliquet tortor vitae
                                pellentesque ultricies. Ut faucibus.Lorem impsum dolor sit amet, consectetur adipiscing
                                elit.</p>
                            <p class="col-lg-6">Lorem impsum dolor sit amet, consectetur adipiscing elit. Aenean mollis
                                pellentesque
                                sodales. Vestibulum vel nunc sed nisi dapibus dictum. Curabitur aliquet tortor vitae
                                pellentesque ultricies. Ut faucibus.Lorem impsum dolor sit amet, consectetur adipiscing
                                elit.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header21'] ?></h5>
                        <p><?php echo $pageContent['paragraph21'] ?></p>
                    </div>
                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header22'] ?></h5>
                        <p><?php echo $pageContent['paragraph22'] ?></p>
                    </div>
                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header23'] ?></h5>
                        <p><?php echo $pageContent['paragraph23'] ?></p>
                    </div>
                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header24'] ?></h5>
                        <p><?php echo $pageContent['paragraph24'] ?></p>
                    </div>


                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header31'] ?></h5>
                        <p><?php echo $pageContent['paragraph31'] ?></p>
                    </div>
                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header32'] ?></h5>
                        <p><?php echo $pageContent['paragraph32'] ?></p>
                    </div>
                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header33'] ?></h5>
                        <p><?php echo $pageContent['paragraph33'] ?></p>
                    </div>
                    <div class="col-lg-3 col-sm-6 single-team-item">
                        <h5><?php echo $pageContent['header34'] ?></h5>
                        <p><?php echo $pageContent['paragraph34'] ?></p>
                    </div>
                    <!-- test-->

                    <!-- test-->
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.single-team-item').on('click', function () {
            alert('item clicked');
        });
    </script>

</div>
</div>