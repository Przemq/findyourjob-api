<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\InsightsBoxes $module
 */

$module = $this->getModule();
$hash = $module->getHash();
$uniqID = uniqid(rand(1, 999));
$timeLineActiveId = $this->getRepeater('filterText')[0]->getSelect('categoryTimeLine')->getValue()['id'];
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = [
    'posts_per_page' => '9',
    'orderby' => 'date',
    'order' => 'DESC',
    'post_type' => 'post',
    'paged' => $paged,
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'timeline',
            'field' => 'id',
            'terms' => $timeLineActiveId,
        )
    ),
];

$isEmpty = $this->getRepeater('filterText')->count() > 0 ? false : true;
$categorys = get_categories();
$topics = get_tags();
$insightQuery = new WP_Query($args);
?>
<div class="insight-wrapper <?= $module->getClass() ?>">

    <!-- Filter Wrapper  -->
    <div class="filter-wrapper">
        <?= createTaskLink('EV-45') ?>

        <div class="container" id="sub-nav">


            <?= createTaskLink('EV-32') ?>
            <a href="#" class="nav-tabs-dropdown <?= $module->changeNav() ?> mob-nav"><?= get_the_title(); ?></a>
            <ul class="nav-tabs-wrapper nav-tabs nav-tabs-horizontal list-inline row no-gutters <?= $module->changeNavTabs() ?>"
                role="tablist" <?= $isEmpty ? 'style="padding-top:20px"' : ""; ?> >
                <?php foreach ($this->getRepeater('filterText') as $index => $filter) : ?>
                    <li class="nav-item custom-nav-item list-inline-item <?= $module->colsTabs() ?>">
                        <?php
                        $category = $filter->getSelect('categoryTimeLine')->getValue()['id'];
                        ?>
                        <a <?php echo ($index == 0) ? 'class="active"' : '' ?>
                                href="#htab-<?= $index ?>-<?= $uniqID ?>" data-category="<?= $category ?>"
                                data-toggle="tab" aria-expanded="true" id="<?= $filter->getInput('tabID')->getValue(); ?>">
                            <?= $filter->getInput('title') ?>
                        </a></li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <?php foreach ($this->getRepeater('filterText') as $index => $filter) : ?>
                    <div role="tabpanel"
                         class="tab-pane<?php echo ($index == 0) ? ' active' : '' ?> <?= $module->paddingControl() ?>"
                         id="htab-<?= $index ?>-<?= $uniqID ?>">
                        <div class="text-content justify-content-center">
                            <?= $filter->getEditor('description')->getValue(); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row filter">
                <div class="filter-by col-5 col-lg-3"><?= $this->getInput('filterBy') ?></div>
                <div class="buttons col-7 col-lg-9">
                    <div class="custom-dropdown dropdown category-dropdown">

                        <a data-picked="" class="dropdown-button current-category" data-toggle="dropdown">
                            Category
                        </a>

                        <div class="dropdown-menu custom-dropdown-menu">
                            <a class="dropdown-item" data-value="" href="#"><?= $this->getInput('textforAll') ?></a>
                            <?php foreach ($categorys as $index => $cat) : ?>
                                <a class="dropdown-item" data-value="<?= $cat->slug ?>" href="#"><?= $cat->name ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="custom-dropdown dropdown topic-dropdown">
                        <a data-picked="" class="dropdown-button current-topic " data-toggle="dropdown">
                            Topic
                        </a>
                        <div class="dropdown-menu custom-dropdown-menu">
                            <a class="dropdown-item" data-value="" href="#"><?= $this->getInput('textforAll') ?></a>
                            <?php foreach ($topics as $index => $topic) : ?>
                                <a class="dropdown-item" data-value="<?= $topic->slug ?>"
                                   href="#"><?= $topic->name ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loader -->
    <div class="loading col-12">
        <div class="loader">

        </div>
    </div>
    <!-- Boxes -->

    <div class="container-fluid px-0" id="insights-post-wrapper">

        <div class="container">
            <?= createTaskLink('EV-31') ?>
            <?php
            // Declare variable and send it also to ajax req
            $nothingFound = $this->getInput('nothingFound');

            ?>
            <div class="article-boxes-wrapper">
                <input id="nothingFound" type="hidden" name="nothingFound" value="<?= $nothingFound ?>">
                <?php if ($insightQuery->have_posts()) : ?>

                    <div class="article-boxes row">
                        <?php while ($insightQuery->have_posts()) : $insightQuery->the_post();
                            $link = get_post_meta(get_the_ID(), '_event_shares_link', true);
                            ?>

                            <div class="col-lg-4 single-article">
                                <div class="content-wrapper">
                                    <div class="image-container">
                                        <?php the_post_thumbnail('full', array('class' => 'style-svg article-icon')) ?>
                                    </div>
                                    <div class="publication-info col-lg-12 px-0">
                                        <?php
                                        $author = get_post_meta(get_the_ID(), '_event_shares_author', true);
                                        $enableDate = get_post_meta(get_the_ID(), '_event_shares_enable_date', 1);
                                        $dateFormat = get_post_meta(get_the_ID(), '_event_shares_date_format', 1);
                                        ?>

                                        <?php
                                        $date = '';
                                        if ($enableDate == 'on'):
                                            if ($dateFormat == 'uk'):
                                             $date =  get_the_date('d.m.Y');
                                            else:
                                              $date = get_the_date('m.d.Y');
                                            endif;
                                        endif;
                                        $separator =' ';
                                        if($date == '' && $author == '' && $enableDate != 'on'){
                                            $separator = '';
                                        }
                                        else {
                                            $separator = ' | ';
                                        }
                                        ?>

                                        <?= $date . $separator . $author ?>

                                    </div>
                                    <div class="col-lg-12 px-0"><h3 class="title-insight"><?= get_the_title() ?></h3>
                                    </div>
                                    <div class="col-lg-12 hidden-sm-down px-0"><?php the_excerpt() ?></div>

                                    <?php
                                    $readButton = get_post_meta(get_the_ID(), '_event_shares_button_text', true);
                                    ?>

                                    <div class="col-lg-12 buttons px-0"><a
                                                href="<?= $link ?>" target="_blank"><?= $readButton ?></a></div>
                                </div>
                            </div>

                        <?php endwhile; ?>

                        <script>
                            $(document).ready(function () {

                                $('.content-wrapper').on('click', function () {
                                    var link = $(this).find('.buttons a').attr('href');
                                    window.open(link, '_blank');
                                })
                            });

                        </script>
                        <!--Pagination-->
                        <?php if ($insightQuery->max_num_pages > 1): ; ?>
                            <div class="container pagePagination">
                                <div class="row">
                                    <?php
                                    $pagination = array(
                                        'base' => str_replace(999, '%#%', esc_url(get_pagenum_link(999))),
                                        'format' => '?paged=%#%',
                                        'end_size' => 1,
                                        'mid_size' => 5,
                                        'total' => $insightQuery->max_num_pages,
                                        'prev_next' => true,
                                        'before_page_number' => '<strong>',
                                        'after_page_number' => '</strong>'
                                    );
                                    ?>
                                    <div class="pagination-wrapper">
                                        <div class="numbered">
                                            <?php echo $module->paginate_links_ajax($pagination); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                else:?>
                    <h3 class="nothingfound"><?= $nothingFound ?></h3>
                    <?php
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</div>

<?php  dump($readButton) ?>