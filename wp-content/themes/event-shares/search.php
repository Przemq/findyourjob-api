<?php

/**
 *  Template Name: Search page
 */

get_header();

$isBackgroundImageID = wpx_theme_get_option( 'wpx_theme_search_results_background_image_id' );
$opacity             = wpx_theme_get_option( 'wpx_theme_search_results_background_opacity' );

?>
    <style>
        <?php
		   if (!empty($isBackgroundImageID) && $isBackgroundImageID ==!"" ) :
		   $backgroundID = (int) $isBackgroundImageID;
		   $backgroundUrl = wp_get_attachment_image_url($backgroundID,'full');

		   ?>
        .search-results .large-header:before {
            background-image: url("<?=$backgroundUrl?>");
            background-size: cover;
            background-position: center;
            opacity: <?=$opacity?>;
        }

        <?php else: ?>
        .search-results .large-header {
            background-color: <?=wpx_theme_get_option( 'wpx_theme_search_results_background_color' )?>;
        }

        <?php
		endif;

			 ?>
        .search-results .large-header .large-header-inner .large-header-content h1 {
            font-size: <?=wpx_theme_get_option( 'wpx_theme_search_results_title_size' )?>;
            color: <?=wpx_theme_get_option( 'wpx_theme_search_results_title_color' )?>;
        }

        .search-results .large-header .large-header-inner .large-header-content h4 {
            font-size: <?=wpx_theme_get_option( 'wpx_theme_search_results_none_size' )?>;
            color: <?=wpx_theme_get_option( 'wpx_theme_search_results_none_color' )?>;
        }

        .search-results .large-header .large-header-inner .large-header-content p {
            font-size: <?=wpx_theme_get_option( 'wpx_theme_search_results_text_size' )?>;
            color: <?=wpx_theme_get_option( 'wpx_theme_search_results_text_color' )?>;
        }

        .search-results .large-header .large-header-inner .large-header-content p strong, .highlight {
            color: <?=wpx_theme_get_option( 'wpx_theme_search_results_highlight' )?>;
        }
    </style>

<?= createTaskLink( 'EV-37' ) ?>
<?php
// Get Custom styles/images


//
$keys = implode( '|', explode( ' ', get_search_query() ) );

if ( isset( $_GET['date'] ) && ! empty( $_GET['date'] ) ) {
	$date = array(
		'year'  => substr( $_GET['date'], 0, 4 ),
		'month' => substr( $_GET['date'], 5 )
	);
} else {
	$date = '';
}

if ( isset( $_GET['category'] ) && ! empty( $_GET['category'] ) ) {
	$category = $_GET['category'];
} else {
	$category = '';

}

$date_string = ! empty( $_GET['date'] ) ? date_format( date_create( $_GET['date'] ), 'F Y' ) : '';

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$s     = get_search_query();
$args  = array(
	's'              => $s,
	'post_type'      => array( 'page' ),
	'date_query'     => array( $date ),
	'posts_per_page' => 5,
	'paged'          => $paged,
	'category_name'  => $category
);
?>
    <div class="search-results search-content pb-4" role="main">
    <div class="large-header">
    <div class="overlay"></div>
    <div class="container">

    <div class="row  large-header-inner">
    <div class="col-12 large-header-content">
    <h1><?= wpx_theme_get_option( "wpx_theme_search_results_title" ) ?></h1>
<?php
$search_query = new WP_Query( $args );
if ( $search_query->have_posts() ) {
	?>
	<?php if ( $search_query->found_posts == 1 ) : ?>
        <p><?= sprintf( wpx_theme_get_option( "wpx_theme_search_results_one" ), $search_query->found_posts ) ?>
            <strong>'<?= ( empty( $category ) ) ? get_query_var( 's' ) : $category ?>'</strong>
        </p>
		<?php
	else:
		?>
        <p><?= sprintf( wpx_theme_get_option( "wpx_theme_search_results_many" ), $search_query->found_posts ) ?>
            <strong>'<?= ( empty( $category ) ) ? get_query_var( 's' ) : $category ?>'</strong>
        </p>
	<?php endif; ?>

    </div>
    </div>
    </div>
    </div>

    <div class="search-results-content-wrapper">
        <div class="search-results-content">

            <div class="container page-post-results">

                <div class="row">

                    <div class="col-12 top d-inline-block">
                        <div class="title">
                            <h2>Page results</h2>
                        </div>
                    </div>
                    <div class="col-12 all-results">
						<?php while ( $search_query->have_posts() ) :
							$search_query->the_post();
							global $post;
							$post_id        = $post->ID;
							$link           = get_permalink( $post_id );
							$target         = '';
							$excerpt        = get_the_excerpt( $post_id );
							if ( strlen( $excerpt ) > 200 ) {
								$excerpt = substr( $excerpt, 0, 200 ) . '...';
							}
							if ( ! empty( $search_query->query['s'] ) ) {
								$excerpt = preg_replace( '/(' . $keys . ')/iu', '<strong class="search-highlight">\0</strong>', $excerpt );
							}
							$title   = html_entity_decode( $post->post_title );
							$content = get_the_content( $post_id );
							$keys    = implode( '|', explode( ' ', get_search_query() ) );
							$title   = preg_replace( '/(' . $keys . ')/iu', '<strong class="search-highlight">\0</strong>', $title );
							$more    = ! empty( wpx_theme_get_option( 'wpx_theme_search_results_readme' ) ) ?
								wpx_theme_get_option( 'wpx_theme_search_results_readme' ) : 'Read more';
                            $excerptExample = $excerpt;
							?>
                            <div class="single-result">
                                <h4><?php echo $title; ?></h4>
                                <p class="d-inline"><?php echo ! empty( $excerpt ) ? $excerpt : $excerptExample; ?></p>
                                <a class="d-inline" href="<?php echo $link; ?>"<?php echo $target; ?>>
									<?= $more ?>
                                </a>
                            </div>
						<?php endwhile; ?>
                    </div>
                    <!--See more button -->
                    <!--                    <div class="container">-->
                    <!--                        <div class="see-more">-->
                    <!--                            <a data-post-type="posts,pages" class="see-more-button float-right" href="#">See more<i></i></a>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                </div>-->

                </div>


            </div>
			<?php
			$argsArticles = array(
				's'              => $s,
				'post_type'      => array( 'post' ),
				'date_query'     => array( $date ),
				'posts_per_page' => 5,
				'paged'          => $paged,
				'category_name'  => $category
			);

			?>
			<?php
			$search_article = new WP_Query( $argsArticles );
			if ( $search_article->have_posts() ) :

			?>
            <div class="container-fluid articles-results articles-images">
                <div class="container">
                    <div class="row">

                        <div class="col-12 px-0 px-md-3 top d-inline-block">
                            <div class="title">
                                <h2>ARTICLE RESULTS</h2>
                            </div>
                        </div>
                        <div class="all-results mx-md-0 row">
							<?php endif;
							?>
							<?php while ( $search_article->have_posts() ) :
								$more_article = ! empty( wpx_theme_get_option( 'wpx_theme_search_results_readme' ) ) ?
									wpx_theme_get_option( 'wpx_theme_search_results_readme' ) : 'Read more';
								$search_article->the_post();
								?>

                                <div class="col-md-4 col-sm-6 col-12 single-result">
                                    <div class="single-background">
                                        <div class="image">
											<?php the_post_thumbnail( 'large', array( 'class' => 'style-svg max-imageWidth' ) ); ?>
                                        </div>
                                        <div class="author">
                                            <span><?php the_date( 'd.m.Y', '', '' ); ?> | <?php the_author() ?></span>
                                        </div>
                                        <div class="title-article title-article-equal"><?php the_title() ?></div>
                                        <?php the_excerpt() ?>
                                        <div class="see_more">
                                            <a class="d-inline" href="<?php the_permalink() ?> ">
												<?= $more_article ?></a>
                                        </div>
                                    </div>
                                </div>

							<?php endwhile;
							?>
                        </div>
                    </div>
                </div>
            </div>


            <!--Pagination-->
			<?php if ( $search_query->max_num_pages > 1 ): ; ?>
                <div class="container pagePagination">
                    <div class="row px-3">
						<?php
						$pagination = array(
							'end_size'           => 1,
							'mid_size'           => 5,
							'total'              => $search_query->max_num_pages,
							'prev_next'          => false,
							'before_page_number' => '<strong>',
							'after_page_number'  => '</strong>'
						);
						?>
                        <div class="pagination-wrapper">
                            <span class="prev-link"><?php previous_posts_link( 'Previous' ) ?></span>
                            <div class="numbered">
								<?php echo paginate_links( $pagination ); ?>
                            </div>
                            <span class="next-link"><?php next_posts_link( 'Next', $search_query->max_num_pages ) ?></span>
                        </div>
                    </div>
                </div>
			<?php endif; ?>

        </div>
    </div>

    <!--If no results found-->
<?php } else { ?>

	<?php if ( empty( $category ) ) : ?>
        <h4><?= sprintf( wpx_theme_get_option( 'wpx_theme_search_results_none' ), get_query_var( 's' ) ) ?></h4>
		<?php
	else:
		?>
        <h4><?= sprintf( wpx_theme_get_option( 'wpx_theme_search_results_none' ), $category ) ?></h4>
		<?php
	endif;

	?>
    <!--    Close search-results and its childs if no any posts-->
    </div>
    </div>
    </div>
    </div>
<?php } ?>


<?php wp_reset_query(); ?>


<?php
get_footer();
?>
<script>
    var options = {
        byRow: false,
        property: 'height',
        target: null,
        remove: false
    };
    function makeEqualsSearchResults(options) {
        $('.title-article-equal').matchHeight('remove').matchHeight(options);
    }
    makeEqualsSearchResults(options);
</script>
