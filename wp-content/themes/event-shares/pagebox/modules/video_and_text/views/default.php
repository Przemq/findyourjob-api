<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\VideoAndText $module
 */

$linkToPage = urlencode(get_the_permalink());
$facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $linkToPage;
$twitter = 'https://twitter.com/home?status=' . $linkToPage;
$linked = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $linkToPage . '&title=EventShares';
$seekingAlpha = 'https://seekingalpha.com/user/48568128/comments';
$stockTwits = 'https://stocktwits.com/eventsharesetfs';

$module = $this->getModule();
$title = $this->getInput('title')->getValue();
$paragraphText = $this->getEditor('paragraphText')->getValue();
$videoURL = $this->getInput('videoURL')->getValue();
$buttonText = $this->getInput('buttonText')->getValue();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="video-container col-lg-7 col-12">
                    <iframe
                            src="https://www.youtube.com/embed/<?= $videoURL ?>">
                    </iframe>
                </div>
                <div class="col-lg-5 col-12 text-container">
                    <h4><?= $title; ?></h4>
                    <?= $paragraphText; ?>
                    <div class="share-icons row">
                        <div class="share-button col-md-3">
                            <img class="style-svg" src="<?= THEME_IMAGES_URI?>/shareIconArrow.svg">
                            <span><?= $buttonText ?></span></div>
                        <div class="col-md-9 icons">
                            <ul>
                                <li class="aos-init" data-aos="zoom-in-left" data-aos-delay="1s"><a href="<?= $facebook ?>"
                                                                                                    target="_blank">
                                        <div class="icon"><img
                                                    src="<?= THEME_IMAGES_URI; ?>/white_facebook.svg"></div>
                                    </a></li>
                                <li class="aos-init" data-aos="zoom-in-left" data-aos-delay="2s"><a data-aos-delay="300ms"
                                                                                                    href="<?= $twitter ?>"
                                                                                                    target="_blank">
                                        <div class="icon"><img
                                                    src="<?= THEME_IMAGES_URI; ?>/Twitter_white.svg"></div>
                                    </a></li>
                                <li class="aos-init" data-aos="zoom-in-left" data-aos-delay="3s"><a href="<?= $linked ?>"
                                                                                                    target="_blank">
                                        <div class="icon"><img src="<?= THEME_IMAGES_URI; ?>/Linkedin_white.svg"></div>
                                    </a>
                                </li>
                                <li class="aos-init" data-aos="zoom-in-left" data-aos-delay="3s"><a
                                            href="<?= $seekingAlpha ?>"
                                            target="_blank">
                                        <div class="icon"><img style="padding: 6px"
                                                               src="<?= THEME_IMAGES_URI; ?>/Seeking-Alpha-Logo-White.svg">
                                        </div>
                                    </a>
                                </li>
                                <li class="aos-init" data-aos="zoom-in-left" data-aos-delay="3s"><a
                                            href="<?= $stockTwits ?>"
                                            target="_blank">
                                        <div class="icon"><img style="padding: 13px"
                                                               src="<?= THEME_IMAGES_URI; ?>/StockTwits-Logo-White.svg">
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>