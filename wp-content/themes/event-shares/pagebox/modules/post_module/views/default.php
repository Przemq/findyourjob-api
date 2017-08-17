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
$showPublicationInfo = $this->getInput('showPublicationInfo')->getValue();
$showPostData = $this->getInput('showPostData')->getValue();
$showImage = $this->getInput('showImage')->getValue();
$image = $this->getMedia('image')->getImage()->getUrl();
?>
<div class="<?= $module->getClass() ?> articleTextModule" xmlns:javascript="http://www.w3.org/1999/xhtml">

    <div class="container">
        <?php //createTaskLink('OMGI-85') ?>

        <div class="row">
            <div class="col-12">
                <?php if (!empty($this->getInput('switchMedia')->getValue())) : ?>
                    <div class="col-12 fixed-action-btn">
                        <a>
                            <div class="social-icon"><img
                                        src="<?= THEME_IMAGES_URI; ?>/White_social_media_icon.svg"></div>
                        </a>
                        <ul>
                            <li><a class="aos-init" data-aos="zoom-in-left" data-aos-delay="150ms"
                                   href="<?= $facebook ?>" target="_blank">
                                    <div class="icon"><img
                                                src="<?= THEME_IMAGES_URI; ?>/white_facebook.svg"></div>
                                </a></li>
                            <li><a class="aos-init" data-aos="zoom-in-left" data-aos-delay="300ms"
                                   href="<?= $twitter ?>" target="_blank">
                                    <div class="icon"><img
                                                src="<?= THEME_IMAGES_URI; ?>/Twitter_white.svg"></div>
                                </a></li>
                            <li><a class="aos-init" data-aos="zoom-in-left" data-aos-delay="450ms" href="<?= $linked ?>"
                                   target="_blank">
                                    <div class="icon"><img
                                                src="<?= THEME_IMAGES_URI; ?>/Linkedin_white.svg"></div>
                                </a></li>
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
            <article class="<?php if($showImage) echo 'col-lg-8'; else echo 'col-lg-12' ?> col-12">

                <div class="text" <?php if($showPostData) echo 'style="padding-top:40px;"' ?>>
                    <?= $this->getEditor('articleText')->getValue() ?>
                </div>
            </article>
            <?php if($showImage): ?>
            <div class="image-container col-lg-4 col-12">
                <img src="<?= $image ?>" alt="article image">
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

