<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\ArticleText $module
 */
global $post;

$module = $this->getModule();

$linkToPage = urlencode(get_the_permalink());
$facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $linkToPage;
$twitter = 'https://twitter.com/home?status=' . $linkToPage;
$linked = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $linkToPage . '&title=EventShares';
$seekingAlpha = 'https://seekingalpha.com/user/48568128/comments';
$stockTwits = 'https://stocktwits.com/eventsharesetfs';

$showPublicationInfo = $this->getInput('showPublicationInfo')->getValue();
$showPostData = $this->getInput('showPostData')->getValue();
$showMedia = $this->getInput('showMedia')->getValue();
$image = $this->getMedia('image')->getImage()->getUrl();
$externalURL = $this->getInput('backButtonURL')->getValue();
$internalLink = $this->getSelect('internalLink')->getValue()['permalink'];
$backButtonText = $this->getInput('backButtonText')->getValue();
$footnotesRepeater = $this->getRepeater('footnotes');
$enableFootnotes = $this->getInput('enableFootnotes')->getValue();

$buttonLink = '';
if (empty($internalLink)) {
    $buttonLink = $externalURL;
} else {
    $buttonLink = $internalLink;
}

$typeOfMedia = $this->getSelect('typeOfMedia')->getValue()['id'];
$videoURL = $this->getInput('videoURL')->getValue();
?>
<div class="<?= $module->getClass() ?> articleTextModule" xmlns:javascript="http://www.w3.org/1999/xhtml">
    <div class="container">
        <?php //createTaskLink('OMGI-85') ?>

        <div class="row">
            <div class="col-12">
                <div class="printIcon hidden-md-down"><a href="javascript:window.print();">
                        <img src="<?= THEME_IMAGES_URI; ?>/printIcon.svg"><span>Print</span></a></div>
                <?php if (!empty($this->getInput('switchMedia')->getValue())) : ?>
                    <div class="col-12 fixed-action-btn">
                        <a>
                            <div class="social-icon aos-init" data-aos="zoom-in-right" data-aos-delay="1s"><img
                                        src="<?= THEME_IMAGES_URI; ?>/White_social_media_icon.svg"></div>
                        </a>
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
                <?php endif; ?>

                <?php if ($showPostData): ?>
                    <h2><?= get_the_title(); ?></h2>
                    <?php
                    $dateFormat = get_post_meta(get_the_ID(), '_event_shares_date_format', 1);
                    $author = get_post_meta(get_the_ID(), '_event_shares_author', true);
                    $enableDate = get_post_meta(get_the_ID(), '_event_shares_enable_date', 1);
                    $date = '';
                    if ($enableDate == 'on'):
                        if ($dateFormat == 'uk'):
                            $date = get_the_date('d.m.Y');
                        else:
                            $date = get_the_date('m.d.Y');
                        endif;
                    endif; ?>
                    <?php if ($showPublicationInfo): ?>
                        <div class="publication-info"> <?= $date . ' | ' . $author ?></div>
                    <?php endif; ?>
                <?php endif ?>
            </div>
            <article class="col-12">

                <div class="text" <?php if ($showPostData) echo 'style="padding-top:40px;"' ?>>
                    <?= $this->getEditor('articleText')->getValue() ?>
                </div>
            </article>
            <?php if ($showMedia): ?>
                <div class="media-container col-12">
                    <?php if ($typeOfMedia == 'image'): ?>
                        <img src="<?= $image ?>" alt="article image">
                    <?php endif; ?>
                    <?php if ($typeOfMedia == 'video'): ?>
                        <iframe
                                src="https://www.youtube.com/embed/<?= $videoURL ?>">
                        </iframe>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="related-posts col-md-4 col-12">
                    <?php
                    // TODO Tomek pomuszzz
                    $postArray = array(
                        'posts_per_page' => 5,
                        'tax_query' => array(
                            'relation' => 'OR',
                            array(
                                'taxonomy' => 'category',
                                'field' => 'id',
                                'terms' => wp_get_post_categories(get_the_ID()),
                            ),
//                        array(
//                            'taxonomy' => 'post_tag',
//                            'field' => 'id',
//                            'terms' => wp_get_post_tags(get_the_ID()),
//                        ),
                        ),
                        'post_type' => 'post',
                        'post__not_in' => array(get_the_ID())
                    );

                    $posts = '';
                    $posts = new WP_Query($postArray);
                    ?>
                    <div class="related">Related posts:</div>
                    <?php while ($posts->have_posts()): ?>
                        <?php $posts->the_post();
                        $post = $posts->post;
                        $ID = $post->ID;
                        ?>
                        <a class="post-link" href="<?= get_permalink($ID); ?>"><?= get_the_title($ID); ?></a><br>
                    <?php endwhile; ?>
                </div>
                <?php if ($enableFootnotes): ?>
                    <div class="col-md-8 col-12 footnotes">
                        <h6>FOOTNOTES</h6>
                        <?php foreach ($footnotesRepeater as $single):
                            /* @var \Nurture\Pagebox\Module\Scope $single */
                            $footnotesText = $single->getEditor('footnotesText')->getValue();
                            ?>
                            <?= $footnotesText ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <hr>
                <a href="<?= $buttonLink ?>">
                    <img src="<?= THEME_IMAGES_URI; ?>/quadratic-button.svg" class="back-to-all-entries">
                    <?= $backButtonText ?></a>
            </div>
        </div>
    </div>
</div>


