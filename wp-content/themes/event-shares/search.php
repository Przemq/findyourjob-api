<?php

get_header(); ?>

    <div class="search-content" role="main">
        <?= createTaskLink('EV-37') ?>
        <div class="container-fluid">
            <div class="transparency"></div>
            <div class="container">
                <div class="search-results-title clearfix">
                    <h2 class="col-xs-12 col-sm-8 col-md-10 col-lg-8 auto-position"> search results </h2>
                </div>
				<?php

				global $query_string;
				$query_args = explode("&", $query_string);

				$search_query = array();
				//  Decode url
				if( strlen($query_string) > 0 ) {
					foreach($query_args as $key => $string) {
						$query_split = explode("=", $string);
						$search_query[$query_split[0]] = urldecode($query_split[1]);
					} // foreach
				} //if

				$search = new WP_Query($search_query);
				?>

                <div class="search-results-cont">
					<?php if ( $search  ->have_posts() ) : ?>
                    <ol>
						<?php

						$i = 1;
						while ( $search ->have_posts() ) : $search  ->the_post();
							?>
                            <li class="title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                            <p class="excerpt">
								<?php the_excerpt(); ?>
                            </p>
							<?php
							$i ++;
						endwhile;
						?>
						<?php else : ?>

                            <div class="no-resoult">
                                nothing to show.
                            </div>

						<?php endif; ?>
                    </ol>
                    <hr>
                </div>
            </div><!-- /.container -->
        </div> <!-- /.search-content -->
    </div>

<?php get_footer();