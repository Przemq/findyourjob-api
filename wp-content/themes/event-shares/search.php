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
	'post_type'      => array( 'post', 'page' ),
	'date_query'     => array( $date ),
	'posts_per_page' => 3,
	'paged'          => $paged,
	'category_name'  => $category
);
?>
    <div class="search-results search-content pb-4" role="main">
<?= createTaskLink( 'EV-37' ) ?>
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

    <div class="pt-4">
        <div class="SearchResults">

            <div class="col results page-results">

                <div class="container">

                    <div class="top d-inline-block">
                        <div class="title float-left">
                            <h2><strong>Page</strong> results</h2>
                        </div>
                    </div>
                    <div>
						<?php while ( $search_query->have_posts() ) :
							$search_query->the_post();
							global $post;
							$post_id = $post->ID;
							$link    = get_permalink( $post_id );
							$more    = 'Read more';
							$target  = '';
							$excerpt = get_the_excerpt( $post_id );
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
							?>
                            <div class="single-result">
                                <h4><?php echo $title; ?></h4>
                                <p class="d-inline"><?php echo $excerpt; ?>Lorem ipsum dolor sit amet,
                                    consectetur
                                    adipiscing elit.
                                    Nullam pulvinar euismod eros, a laoreet leo. Quisque ac turpis id mi
                                    euismod
                                    tristique. In sit amet urna sed leo semper iaculis sit amet vitae
                                    lectus.
                                    Aenean
                                    feugiat imperdiet sollicitudin.</p>
                                <a class="d-inline" href="<?php echo $link; ?>"<?php echo $target; ?>>
                                    READ MORE
                                </a>
                            </div>
						<?php endwhile; ?>
                    </div>
                </div>

                <!--See more button -->
                <div class="container">
                    <div class="see-more">
                        <a class="float-right" href="#">See more<i></i></a>
                    </div>
                </div>

            </div>

            <div class="col results insights-results pb-4">
                <div class="container">

                    <div class="row">
                        <div class="top d-inline-block">
                            <div class="title float-left">
                                <h2><strong>Article</strong> results</h2>
                            </div>
                        </div>

                        <div class="row">

                            <a href="#" class="outline insights col-12 col-md-4 pt-3">
                                <div class="tag"><h6>Equities</h6></div>
                                <img src="<?= THEME_IMAGES_URI; ?>/Image.png">
                                <div class="description">
                                    <div class="date">
                                        <h5>23 Nov 2016 <span>| By Ian Ormiston</span></h5>
                                    </div>
                                    <div class="text">
                                        <h4> Nulla purus nunc, tur lacus id</h4>
                                        <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                            at. </p>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="outline insights col-12 col-md-4 pt-3">
                                <div class="tag"><h6>Equities</h6></div>
                                <img src="<?= THEME_IMAGES_URI; ?>/Layer2.png">
                                <div class="description">
                                    <div class="date">
                                        <h5>23 Nov 2016 <span>| By Ian Ormiston</span></h5>
                                    </div>
                                    <div class="text">
                                        <h4> Nulla purus nunc, tur lacus id</h4>
                                        <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                            at. </p>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="outline insights col-12 col-md-4 pt-3">
                                <div class="tag"><h6>Equities</h6></div>
                                <img src="<?= THEME_IMAGES_URI; ?>/Layer103.png">
                                <div class="description">
                                    <div class="date">
                                        <h5>23 Nov 2016 <span>| By Ian Ormiston</span></h5>
                                    </div>
                                    <div class="text">
                                        <h4> Nulla purus nunc, tur lacus id</h4>
                                        <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                            at. </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="border-bottom"></div>
                    </div>
                </div>

                <!--See more button -->
                <div class="container">
                    <div class="see-more">
                        <a class="float-right" href="#">See more<i></i></a>
                    </div>
                </div>
            </div>

            <div class="col results video-results pb-3">
                <div class="container">

                    <div class="top d-inline-block">
                        <div class="title float-left">
                            <h2><strong>Video</strong> results</h2>
                        </div>
                    </div>

                    <div class="row">
                        <a href="#" class="insights col-12 col-md-4 pb-3">
                            <div class="tag"><h6>Equities</h6></div>
                            <img src="<?= THEME_IMAGES_URI; ?>/Layer2.png">
                            <div class="description">
                                <div class="date">
                                    <h5>23 Nov 2016 <span>| By Ian Ormiston</span></h5>
                                </div>
                                <div class="text">
                                    <h4> Nulla purus nunc, tur lacus id</h4>
                                    <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                        at. </p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="insights col-12 col-md-4 pb-3">
                            <div class="tag"><h6>Equities</h6></div>
                            <img src="<?= THEME_IMAGES_URI; ?>/Layer103.png">
                            <div class="description">
                                <div class="date">
                                    <h5>23 Nov 2016 <span>| By Ian Ormiston</span></h5>
                                </div>
                                <div class="text">
                                    <h4> Nulla purus nunc, tur lacus id</h4>
                                    <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                        at. </p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="insights col-12 col-md-4 pb-3">
                            <div class="tag"><h6>Equities</h6></div>
                            <img src="<?= THEME_IMAGES_URI; ?>/Image.png">
                            <div class="description">
                                <div class="date">
                                    <h5>23 Nov 2016 <span>| By Ian Ormiston</span></h5>
                                </div>
                                <div class="text">
                                    <h4> Nulla purus nunc, tur lacus id</h4>
                                    <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                        at. </p>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="border-bottom"></div>
                    <div class="see-more">
                        <a class="float-right" href="#">See more<i></i></a>
                    </div>
                </div>
            </div>

            <div class="col results events-results">
                <div class="container">
                    <div class="row">

                        <div class="top d-inline-block mb-4">
                            <div class="title float-left">
                                <h2><strong>Events</strong> results</h2>
                            </div>
                        </div>

                        <div class="row margin-fix mb-4">
                            <a href="#" class="outline col-12 col-md-3 col-lg-3 mb-3">
                                <div class="box col">
                                    <span style="color: black;">London, UK</span>
                                    <div class="text">
                                        <h6>UK Finance Awards 2016</h6>
                                        <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                            at. </p>
                                    </div>
                                    <div class="date">
                                        <p>Oct 23 2017</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="outline col-12 col-md-3 col-lg-3 mb-3">
                                <div class="box col">
                                    <span style="color: black;">London, UK</span>
                                    <div class="text">
                                        <h6>UK Finance Awards 2016</h6>
                                        <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                            at. </p>
                                    </div>
                                    <div class="date">
                                        <p>Oct 23 2017</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="outline col-12 col-md-3 col-lg-3 mb-3">
                                <div class="box col">
                                    <span style="color: black;">London, UK</span>
                                    <div class="text">
                                        <h6>UK Finance Awards 2016</h6>
                                        <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                            at. </p>
                                    </div>
                                    <div class="date">
                                        <p>Oct 23 2017</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="outline col-12 col-md-3 col-lg-3">
                                <div class="box col">
                                    <span style="color: black;">London, UK</span>
                                    <div class="text">
                                        <h6>UK Finance Awards 2016</h6>
                                        <p>Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                                            at. </p>
                                    </div>
                                    <div class="date">
                                        <p>Oct 23 2017</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="border-bottom"></div>


                    </div>
                </div>

                <!--See more button -->
                <div class="container">
                    <div class="see-more">
                        <a class="float-right" href="#">See more<i></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!--Pagination-->
        <!--				<?php /*if ( $search_query->max_num_pages > 1 ): ; */ ?>
					<div class="pagePagination">
						<div class="container">
							<div class="row">
								<?php /*$pagination = array(
									'end_size'           => 1,
									'mid_size'           => 3,
									'total'              => $search_query->max_num_pages,
									'prev_next'          => false,
									'before_page_number' => '<strong>',
									'after_page_number'  => '</strong>'
								); */ ?>
								<li class="prev-link"><?php /*previous_posts_link( '<i class="arrow-black"></i>', $search_query->max_num_pages ) */ ?></li>
								<div class="numbered">
									<?php /*echo paginate_links( $pagination ); */ ?>
								</div>
								<li class="next-link"><?php /*next_posts_link( '<i class="arrow-black"></i>', $search_query->max_num_pages ) */ ?></li>
							</div>
						</div>
					</div>
				--><?php /*endif; */ ?>

    </div>

    <div class="container">
		<?= createTaskLink( 'OMGI-74' ) ?>
        <div>
            <div class="box s12 m5 l5">
                <form>
                    <div class="title text-center">Contact <b>Us</b></div>
                    <div class="col-12 mb-4">
                        <p class="text-center"> Duis hendrerit luctus velit, vitae tincidunt purus condimentum
                            at. </p>
                    </div>

                    <div class="input-field col-12 col-md-6 col-lg-6 pt-1 pr-1 pl-0">
                        <input id="first_name" type="text" class="validate">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field col-12 col-md-6 col-lg-6 pt-1 pl-1 pr-0">
                        <input id="last_name" type="text" class="validate">
                        <label for="last_name">Surname</label>
                    </div>
                    <div class="input-field col-12 px-0 mt-1 pt-1">
                        <input id="email" type="email" class="validate">
                        <label for="email">Email address</label>
                    </div>
                    <div class="text-right">
                        <a class="button more full waves-effect font-weight-bold initialism" href="#">Get in
                            touch</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
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


<?php get_footer(); ?>