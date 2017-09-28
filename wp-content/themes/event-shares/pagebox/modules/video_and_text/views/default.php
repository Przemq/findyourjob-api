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
$stockTwits = 'https://stocktwits.com/widgets/share?body='.$linkToPage;

$module = $this->getModule();
$title = $this->getInput('title')->getValue();
$paragraphText = $this->getEditor('paragraphText')->getValue();
$videoURL = $this->getInput('videoURL')->getValue();
$buttonText = $this->getInput('buttonText')->getValue();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container-fluid">
        <div class="container">
            <?= createTaskLink('EV-243') ?>
            <div class="row video-and-text">
                <div class="col-lg-7 col-12 video-container">
                            <iframe id="video-iframe" src="https://www.youtube.com/embed/<?= $videoURL ?>"></iframe>
                </div>
                <div class="col-lg-5 col-12 text-container">
                    <h4><?= $title; ?></h4>
                    <?= $paragraphText; ?>
                    <div class="share-icons row">
                        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-3 toggle-icons">
                            <img class="style-svg" src="<?= THEME_IMAGES_URI ?>/shareIconArrow.svg" alt="share icon">
                            <div class="share-button"><?= $buttonText ?></div>
                        </div>
                        <div class="col-md-10 col-sm-10 col-cs-10 col-lg-9 icons">
                            <ul>
                                <li class="aos-init" data-aos="zoom-in-left" data-aos-delay="1s"><a
                                            href="<?= $facebook ?>"
                                            target="_blank">
                                        <div class="icon"><img
                                                    src="<?= THEME_IMAGES_URI; ?>/white_facebook.svg" alt="facebook icon"></div>
                                    </a></li>
                                <li class="aos-init" data-aos="zoom-in-left" data-aos-delay="2s"><a
                                            data-aos-delay="300ms"
                                            href="<?= $twitter ?>"
                                            target="_blank">
                                        <div class="icon"><img
                                                    src="<?= THEME_IMAGES_URI; ?>/Twitter_white.svg" alt="twitter icon"></div>
                                    </a></li>
                                <li class="aos-init" data-aos="zoom-in-left" data-aos-delay="3s"><a
                                            href="<?= $linked ?>"
                                            target="_blank">
                                        <div class="icon"><img src="<?= THEME_IMAGES_URI; ?>/Linkedin_white.svg" alt="linkedIn icon"></div>
                                    </a>
                                </li>
                                <li class="aos-init" data-aos="zoom-in-left" data-aos-delay="3s"><a
                                            href="<?= $stockTwits ?>"
                                            target="_blank">
                                        <div class="icon"><img style="padding: 13px"
                                                               src="<?= THEME_IMAGES_URI; ?>/StockTwits-Logo-White.svg" alt="stockTwits icon">
                                        </div>
                                    </a>
                                </li>
                                <li class="aos-init copyLink" data-aos="zoom-in-left" data-aos-delay="3s">
                                    <div class="icon"><img style="padding: 12px"
                                                           src="<?= THEME_IMAGES_URI; ?>/copyLink.svg" alt="copy link icon">
                                    </div>
                                </li>
                            </ul>
                            <form class="copyLinkText">
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                           value="<?= get_permalink() ?>" placeholder="" id="copy-input">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
