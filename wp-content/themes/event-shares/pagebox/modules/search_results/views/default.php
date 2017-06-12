<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\SearchResults $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container-fluid">
        <div class="container">
            <?= createTaskLink('EV-37') ?>
            <?php include_once('pageContent.php'); ?>
            <div class="row" id="page-results">
                <div id="single-result">
                    <div class="col-lg-12"><h4 id="search-top-header"><?php echo $pageContent['page_results']; ?></h4>
                    </div>

                    <div class="single-result col-lg-9">
                        <h4><?php echo $pageContent['result_header']; ?></h4>
                        <p><?php echo $pageContent['result_paragraph']; ?><a
                                    id="read-more"><?php echo $pageContent['read_more']; ?></a></p>
                    </div>
                </div>
                <div id="single-result">
                    <div class="single-result col-lg-9">
                        <h4><?php echo $pageContent['result_header']; ?></h4>
                        <p><?php echo $pageContent['result_paragraph']; ?><a
                                    id="read-more"><?php echo $pageContent['read_more']; ?></a></p>
                    </div>
                </div>
                <div id="single-result">
                    <div class="single-result col-lg-9">
                        <h4><?php echo $pageContent['result_header']; ?></h4>
                        <p><?php echo $pageContent['result_paragraph']; ?><a
                                    id="read-more"><?php echo $pageContent['read_more']; ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="article-container">
        <div class="container">
            <div class="row" id="article-results">
                <div class="col-lg-12"><h4 id="search-top-header">article results</h4>
                </div>

                <div class="col-lg-4 single-article">
                    <div class="tile-wrapper">
                        <img class="article-icon" src="<?= THEME_IMAGES_URI; ?>/ES%20Piggy%20Bank%20Icon-01-01.svg">
                        <div class="publication-info col-lg-12">
                            <?php echo $pageContent['article_date'] . ' | ' . $pageContent['article_author']; ?>
                        </div>
                        <div class="col-lg-12"><h4><?php echo $pageContent['article_title']; ?></h4></div>
                        <div class="col-lg-12"><p><?php echo $pageContent['article_paragraph']; ?></p></div>
                        <div class="col-lg-12" style="text-align: left"><a href="#">READ NOW</a></div>
                    </div>
                </div>

                <div class="col-lg-4 single-article">
                    <div class="tile-wrapper">
                        <img class="article-icon" src="<?= THEME_IMAGES_URI; ?>/ES%20Piggy%20Bank%20Icon-01-01.svg">
                        <div class="publication-info col-lg-12">
                            <?php echo $pageContent['article_date'] . ' | ' . $pageContent['article_author']; ?>
                        </div>
                        <div class="col-lg-12"><h4><?php echo $pageContent['article_title']; ?></h4></div>
                        <div class="col-lg-12"><p><?php echo $pageContent['article_paragraph']; ?></p></div>
                        <div class="col-lg-12" style="text-align: left"><a href="#">READ NOW</a></div>
                    </div>
                </div>

                <div class="col-lg-4 single-article">
                    <div class="tile-wrapper">
                        <img class="article-icon" src="<?= THEME_IMAGES_URI; ?>/ES%20Piggy%20Bank%20Icon-01-01.svg">
                        <div class="publication-info col-lg-12">
                            <?php echo $pageContent['article_date'] . ' | ' . $pageContent['article_author']; ?>
                        </div>
                        <div class="col-lg-12"><h4><?php echo $pageContent['article_title']; ?></h4></div>
                        <div class="col-lg-12"><p><?php echo $pageContent['article_paragraph']; ?></p></div>
                        <div class="col-lg-12" style="text-align: left"><a href="#">READ NOW</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>