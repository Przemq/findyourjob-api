<?php
get_header();

global $post; ?>

<div class="container-fluid archive p-x-0">
    <div class="slides slider">
        <div class="background slide-1 parallax-window" data-speed="0.4" data-natural-height="600" data-bleed="-22"
             data-z-index="0" data-parallax="scroll" data-image-src="">
            <div class="transparency">
                <div class="container">

                    <div class="row">
                        <div class="title-box">
                            <div class="left-corner">
                            </div>
                            <h2 class="auto-position">

                                <?php if ( is_category() ): ?>
                                Category: <?php echo single_cat_title(); ?>  </h2>
                            <?php endif; ?>

                            <?php if ( is_tag() ): ?>
                                Tag: <?php echo single_tag_title(); ?>  </h2>
                            <?php endif; ?>

                            <div class="right-corner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <h2 class="category-title"><?php the_archive_title( '' ); ?></h2>

    <div class="category-list clearfix">
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) : the_post();
                $post_id = $post->ID;; ?>
                <div class="category-item col-md-12 p-x-0">

                    <p class="date"><?php echo get_the_date( 'd.m.Y', $post_id ); ?></p>
                    <h2 class="title"><a
                                href="<?php echo get_permalink( $post_id ); ?>"><?php echo get_post( $post_id )->post_title; ?></a>
                    </h2>

                    <p class="excerpt"><?php echo wp_trim_words( $post->post_excerpt, 20, '...' ); ?></p>


                </div>
                <?php
            endwhile;
            wp_reset_query();; ?>
        <?php } else { ?>
            <div class="no-results">
                <h2>Nothing Found</h2>
                <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
            </div>
        <?php }; ?>
        <?php if ( $wp_query->max_num_pages >= 2 ) {
            ; ?>
            <div class="col-md-12">
                <div class="pagination">
                    <?php $pagination = array(
                        'prev_next' => true,
                        'prev_text' => __( 'PREV' ),
                        'next_text' => __( 'NEXT' ),
                    ); ?>
                    <div class="numbered">
                        <?php echo paginate_links( $pagination ); ?>
                    </div>
                </div>
            </div>
        <?php }; ?>
    </div>
</div>


<?php get_footer(); ?>

