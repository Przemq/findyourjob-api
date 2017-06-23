<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\InsightsBoxes $module
 */

$module = $this->getModule();
$hash   = $module->getHash();
$uniqID = uniqid( rand( 1, 999 ) );

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
dump( $paged );
$args = [
	'posts_per_page' => '3',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_type'      => 'post',
	'paged'          => $paged,
	'post_status'    => 'publish',
];

$categorys    = get_categories();
$topics       = get_tags();
$insightQuery = new WP_Query( $args );

//dump( $insightQuery );
dump( $insightQuery );
?>
<div class="insight-wrapper <?= $module->getClass() ?>">

    <!-- Filter Wrapper  -->
    <div class="filter-wrapper">
        <div class="container" id="sub-nav">
			<?= createTaskLink( 'EV-32' ) ?>
            <a href="#" class="nav-tabs-dropdown <?= $module->changeNav() ?>">Dropdown-nav</a>
            <ul class="nav-tabs-wrapper nav-tabs nav-tabs-horizontal list-inline row no-gutters <?= $module->changeNavTabs() ?>"
                role="tablist">
				<?php for ( $i = 0; $i < 6; $i ++ ) : ?>
                    <li class="nav-item custom-nav-item list-inline-item <?= $module->colsTabs() ?>">

                        <a <?php echo ( $i == 0 ) ? 'class="active"' : '' ?>
                                href="#htab-<?= $i ?>-<?= $uniqID ?>" data-toggle="tab" aria-expanded="true">In the
                            Media <?= $i ?></a></li>
				<?php endfor ?>
            </ul>
            <div class="tab-content">
				<?php for ( $i = 0; $i < 6; $i ++ ) : ?>
                    <div role="tabpanel"
                         class="tab-pane<?php echo ( $i == 0 ) ? ' active' : '' ?> <?= $module->paddingControl() ?>"
                         id="htab-<?= $i ?>-<?= $uniqID ?>">
                        <div class="text-content justify-content-center">
                            <!--                      PLACE FOR CONTENT  --> <?= $i ?>
                        </div>
                    </div>
				<?php endfor ?>
            </div>
            <div class="row filter">
                <div class="filter-by col-5 col-lg-3">filter by</div>
                <div class="buttons col-7 col-lg-9">
                    <div class="custom-dropdown dropdown category-dropdown">

                        <a data-picked="" class="dropdown-button current-category" data-toggle="dropdown">
                            Category
                        </a>

                        <div class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" data-value="" href="#">All</a>
							<?php foreach ( $categorys as $index => $cat ) : ?>
                                <a class="dropdown-item" data-value="<?= $cat->slug ?>" href="#"><?= $cat->name ?></a>
							<?php endforeach; ?>
                        </div>
                    </div>
                    <div class="custom-dropdown dropdown topic-dropdown">
                        <a data-picked="" class="dropdown-button current-topic " data-toggle="dropdown">
                            Topic
                        </a>
                        <div class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" data-value="" href="#">All</a>
							<?php foreach ( $topics as $index => $topic ) : ?>
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

    <div class="container-fluid" id="insights-post-wrapper">
		<?php include_once( 'pageContent.php' ) ?>
        <div class="container">
			<?= createTaskLink( 'EV-31' ) ?>
			<?php if ( $insightQuery->have_posts() ) : ?>
            <div class="article-boxes-wrapper">
                <div class="article-boxes row">
				<?php while ( $insightQuery->have_posts() ) : $insightQuery->the_post() ?>

                    <div class="col-lg-4 single-article">
                        <div class="tile-wrapper">
                            <img class="article-icon" src="<?= THEME_IMAGES_URI; ?>/ES Bags Money Icon-01-01.svg">
                            <div class="publication-info col-lg-12">
								<?php echo $pageContent['article_date'] . ' | ' . $pageContent['article_author']; ?>
                            </div>
                            <div class="col-lg-12"><h3><?= get_the_title() ?></h3></div>
                            <div class="col-lg-12"><p><?php echo $pageContent['article_paragraph']; ?></p></div>
                            <div class="col-lg-12" style="text-align: left"><a href="#">READ NOW</a></div>
                        </div>
                    </div>
				<?php endwhile; ?>
            </div>
            <!--Pagination-->
			<?php if ( $insightQuery->max_num_pages > 1 ): ; ?>
                <div class="container pagePagination">
                    <div class="row">
						<?php
						$pagination = array(
							'end_size'           => 1,
							'mid_size'           => 5,
							'total'              => $insightQuery->max_num_pages,
							'prev_next'          => false,
							'before_page_number' => '<strong>',
							'after_page_number'  => '</strong>'
						);
						?>
                        <div class="pagination-wrapper">
                            <span class="prev-link"><?php previous_posts_link( 'Previous' ) ?></span>
                            <div class="numbered">
								<?php
								?>
								<?php echo paginate_links( $pagination ); ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php endif; ?>
        </div>


	<?php
	endif;
	wp_reset_postdata();
	?>
    </div>
</div>
</div>
