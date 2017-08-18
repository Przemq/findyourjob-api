<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\OnAjaxInterface;
use Nurture\Pagebox\Module\View\StaticCacheInterface;
use WP_Query;

class InsightsBoxes extends AbstractModule implements OnAjaxInterface, StaticCacheInterface {


	public function colsTabs() {
		$colsize  = 'col-lg-2'; //default
		$widthCol = $this->getSection()['width'];

		switch ( $widthCol ) {
			case 100:
				$colsize = 'col-lg-2';
				break;
			case 75:
				$colsize = 'col-lg-2';
				break;
			case 50:
				$colsize = 'col-12';
				break;
			case 25:
				$colsize = 'col-12';
				break;
		}

		return $colsize;
	}

	public function changeNav() {
		$display  = 'nav-hidden'; //default
		$widthCol = $this->getSection()['width'];

		switch ( $widthCol ) {
//            case 100:
//                $display = 'nav-hidden';
//                break;
//            case 75:
//                $display  = 'nav-hidden';
//                break;
			case 50:
				$display = 'nav-show';
				break;
			case 25:
				$display = 'nav-show';
				break;
		}

		return $display;
	}

	public function changeNavTabs() {
		$display  = 'nav-hidden'; //default
		$widthCol = $this->getSection()['width'];

		switch ( $widthCol ) {
			case 100:
				$display = 'nav-show big-resolutions';
				break;
			case 75:
				$display = 'nav-show big-resolutions';
				break;
			case 50:
				$display = 'nav-hidden';
				break;
			case 25:
				$display = 'nav-hidden';
				break;
		}

		return $display;
	}

	public function paddingControl() {
		$display  = ''; //default
		$widthCol = $this->getSection()['width'];

		switch ( $widthCol ) {
			case 100:
				$display = '';
				break;
			case 75:
				$display = '';
				break;
			case 50:
				$display = 'small-padding';
				break;
			case 25:
				$display = 'small-padding';
				break;
		}

		return $display;
	}

	/**
	 * This function runs only for AJAX request.
	 * Use this function to register AJAX WP action.
	 * This function should be fast as possible.
	 *
	 * @return void
	 */
	public function onAjax() {
		add_action( 'wp_ajax_filterInsights', [ $this, 'filterInsights' ] );
		add_action( 'wp_ajax_nopriv_filterInsights', [ $this, 'filterInsights' ] );
	}

//	Filter when user use buttons filters

	public function filterInsights() {

		if ( isset( $_POST['cat'] ) && ! empty( $_POST['cat'] ) ) {
			$postCategory = $_POST['cat'];
		} else {
			$postCategory = null;
		}
		if ( isset( $_POST['topic'] ) && ! empty( $_POST['topic'] ) ) {
			$topic = $_POST['topic'];
		} else {
			$topic = null;
		}
		if ( isset( $_POST['timeline'] ) && ! empty( $_POST['timeline'] ) ) {
			$timeline = $_POST['timeline'];
		} else {
			$timeline = null;
		}
		if ( isset( $_POST['paginationNumber'] ) && ! empty( $_POST['paginationNumber'] ) ) {
			$paginationNumber = $_POST['paginationNumber'];
		} else {
			$paginationNumber = null;
		}
		if ( isset( $_POST['nothingFoundText'] ) && ! empty( $_POST['nothingFoundText'] ) ) {
			$nothingFound = $_POST['nothingFoundText'];
		} else {
			$nothingFound = 'Nothing Found';
		}

		$args         = [
			'posts_per_page' => '9',
			'paged'          => $paginationNumber,
			'category_name'  => $postCategory,
			'tag'            => $topic,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'tax_query'      => array(
				array(
					'taxonomy' => 'timeline',
					'field'    => 'id',
					'terms'    => $timeline,
				)
			),

		];
		$insightQuery = new WP_Query( $args );

		if ( $insightQuery->have_posts() ) : ?>
            <div class="article-boxes row">
				<?php
				while ( $insightQuery->have_posts() ) : $insightQuery->the_post();
					?>
                    <div class="col-lg-4 single-article">
                        <div class="content-wrapper">
                            <div class="image-container">
								<?php the_post_thumbnail( 'full', array( 'class' => 'style-svg article-icon' ) ) ?>
                            </div>
                            <div class="publication-info col-lg-12">
								<?php
								$author = ( ! empty( get_post_meta( get_the_ID(), '_event_shares_author', true ) )
									? get_post_meta( get_the_ID(), '_event_shares_author', true ) : '' );

                                $enableDate = get_post_meta(get_the_ID(), '_event_shares_enable_date', 1);
                                $dateFormat = get_post_meta(get_the_ID(), '_event_shares_date_format', 1);

                                $date = '';
                                if ($enableDate == 'on'):
                                    if ($dateFormat == 'uk'):
                                        $date =  get_the_date('d.m.Y');
                                    else:
                                        $date = get_the_date('m.d.Y');
                                    endif;
                                endif; ?>

								<?= $date ?> <?= '| ' . $author ?>
                            </div>
                            <div class="col-lg-12"><h3 class="title-insight"><?= get_the_title() ?></h3></div>
                            <div class="col-lg-12"><p><?php the_excerpt() ?></p></div>
							<?php
							$readButton = ( ! empty( get_post_meta( get_the_ID(), '_event_shares_button_text', true ) )
								? get_post_meta( get_the_ID(), '_event_shares_button_text', true ) : 'READ NOW' );

							$link = ( ! empty( get_post_meta( get_the_ID(), '_event_shares_link', true ) )
								? get_post_meta( get_the_ID(), '_event_shares_link', true ) : get_the_permalink() );

							?>

                            <div class="col-lg-12 buttons"><a
                                        href="<?= $link ?>"><?= $readButton ?></a></div>
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
            </div>
			<?php

		else :?>
            <h3 class="nothingfound"><?= $nothingFound ?></h3>
		<?php endif; ?>
		<?php

		if ( $insightQuery->max_num_pages > 1 ): ; ?>
            <div class="container pagePagination">
                <div class="row">
					<?php
					$pagination = array(
						'current'            => $paginationNumber,
						'end_size'           => 1,
						'mid_size'           => 5,
						'total'              => $insightQuery->max_num_pages,
						'prev_next'          => true,
						'before_page_number' => '<strong>',
						'after_page_number'  => '</strong>'
					);
					?>
                    <div class="pagination-wrapper">
                        <div class="numbered">
							<?php echo $this->paginate_links_ajax( $pagination ); ?>
                        </div>
                    </div>
                </div>
            </div>
		<?php endif; ?>
		<?php
		die();
	}


	/**
	 * Retrieve paginated links for ajax  (few changes paginate_links).
	 */

	function paginate_links_ajax( $args = '' ) {
		global $wp_query, $wp_rewrite;

		// Setting up default values based on the current URL.
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$url_parts    = explode( '?', $pagenum_link );

		// Get max pages and current page out of the current query, if available.
		$total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
		$current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		// Append the format placeholder to the base URL.
		$pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

		// URL base depends on permalink settings.
		$format = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		$defaults = array(
			'base'               => $pagenum_link,
			// http://example.com/all_posts.php%_% : %_% is replaced by format (below)
			'format'             => $format,
			// ?page=%#% : %#% is replaced by the page number
			'total'              => $total,
			'current'            => $current,
			'show_all'           => false,
			'prev_next'          => true,
			'prev_text'          => __( '&laquo; Previous' ),
			'next_text'          => __( 'Next &raquo;' ),
			'end_size'           => 1,
			'mid_size'           => 2,
			'type'               => 'plain',
			'add_args'           => array(),
			// array of query args to add
			'add_fragment'       => '',
			'before_page_number' => '',
			'after_page_number'  => ''
		);

		$args = wp_parse_args( $args, $defaults );

		if ( ! is_array( $args['add_args'] ) ) {
			$args['add_args'] = array();
		}

		// Merge additional query vars found in the original URL into 'add_args' array.
		if ( isset( $url_parts[1] ) ) {
			// Find the format argument.
			$format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
			$format_query = isset( $format[1] ) ? $format[1] : '';
			wp_parse_str( $format_query, $format_args );

			// Find the query args of the requested URL.
			wp_parse_str( $url_parts[1], $url_query_args );

			// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
			foreach ( $format_args as $format_arg => $format_arg_value ) {
				unset( $url_query_args[ $format_arg ] );
			}

			$args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
		}

		// Who knows what else people pass in $args
		$total = (int) $args['total'];
		if ( $total < 2 ) {
			return;
		}
		$current  = (int) $args['current'];
		$end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
		if ( $end_size < 1 ) {
			$end_size = 1;
		}
		$mid_size = (int) $args['mid_size'];
		if ( $mid_size < 0 ) {
			$mid_size = 2;
		}
		$add_args   = $args['add_args'];
		$r          = '';
		$page_links = array();
		$dots       = false;

		if ( $args['prev_next'] && $current && 1 < $current ) :
			$link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
			$link = str_replace( '%#%', $current - 1, $link );
			if ( $add_args ) {
				$link = add_query_arg( $add_args, $link );
			}
			$link .= $args['add_fragment'];

			/**
			 * Filters the paginated links for the given archive pages.
			 *
			 * @since 3.0.0
			 *
			 * @param string $link The paginated link URL.
			 */
			$prevNumber   = $current - 1;
			$page_links[] = '<a class="page-numbers" href="/' . $prevNumber . '">' . $args['prev_text'] . '</a>';
		endif;
		for ( $n = 1; $n <= $total; $n ++ ) :
			if ( $n == $current ) :
				$page_links[] = "<span class='page-numbers current'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</span>";
				$dots         = true;
			else :
				if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
					$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
					$link = str_replace( '%#%', $n, $link );
					if ( $add_args ) {
						$link = add_query_arg( $add_args, $link );
					}
					$link .= $args['add_fragment'];

					/** This filter is documented in wp-includes/general-template.php */
					$page_links[] = "<a class='page-numbers' href='/" . $n . "'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a>";
					$dots         = true;
                elseif ( $dots && ! $args['show_all'] ) :
					$page_links[] = '<span class="page-numbers dots">' . __( '&hellip;' ) . '</span>';
					$dots         = false;
				endif;
			endif;
		endfor;
		if ( $args['prev_next'] && $current && $current < $total ) :
			$link = str_replace( '%_%', $args['format'], $args['base'] );
			$link = str_replace( '%#%', $current + 1, $link );
			if ( $add_args ) {
				$link = add_query_arg( $add_args, $link );
			}
			$link .= $args['add_fragment'];

			/** This filter is documented in wp-includes/general-template.php */
			$page_links[] = '<a class="page-numbers" href="/' . ( $current + 1 ) . '">' . $args['next_text'] . '</a>';
		endif;
		switch ( $args['type'] ) {
			case 'array' :
				return $page_links;

			case 'list' :
				$r .= "<ul class='page-numbers'>\n\t<li>";
				$r .= join( "</li>\n\t<li>", $page_links );
				$r .= "</li>\n</ul>\n";
				break;

			default :
				$r = join( "\n", $page_links );
				break;
		}

		return $r;
	}


//	Use when user use pagination filter

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Insights Boxes',
			'description' => 'Tiles with articles',
			'js'          => [
				'depends' => [ 'jquery', 'bootstrap', 'matchHeight' ]
			],
		];
	}

	/**
	 * @return array Fields configuration.
	 */
	protected function fields() {
		return [
			//Title
			'filterBy'                   => [
				'type'        => 'input:text',
				'label'       => 'Filter By Text',
				'description' => 'Enter text for filter by:',
				'default'     => 'Filter By'
			],
			'textforAll'                 => [
				'type'    => 'input:text',
				'label'   => 'Filter text for all categorys/topics',
				'default' => 'All'
			],
			'nothingFound'               => [
				'type'    => 'input:text',
				'label'   => 'Text where no posts/articles found',
				'default' => 'Nothing Found'
			],
			'backgroundColor'            => [
				'type'    => 'input:color',
				'label'   => 'Background color',
				'default' => '#EBEBEB',
				'sass'    => true
			],
			'filterText'                 => [
				'type'     => 'repeater',
				'label'    => 'Filter Text',
				'maxItems' => 6,
				'fields'   => [
					'title'            => [
                        'type'        => 'input:text',
                        'label'       => 'Title',
                        'description' => 'Please enter title'
                    ],
                    'tabID'            => [
                        'type'        => 'input:text',
                        'label'       => 'tabID',
                        'description' => 'Option for News & Insights flyout menu'
                    ],
					'categoryTimeLine' => [
						'type'     => 'select',
						'label'    => 'Choose category',
						'multiple' => false,
						'options'  => [
							'allowClear' => true
						],
						'values'   => function () {
							$values = [];
							$terms  = get_terms( 'timeline', array(
								'hide_empty' => false,
							) );
							foreach ( $terms as $term ) {
								$values[] = [
									'id'   => $term->term_id,
									'slug' => $term->slug,
									'name' => $term->name
								];
							}

							return $values;
						}
					],
					'description'      => [
						'type'        => 'editor',
						'label'       => 'Text below filter',
						'description' => 'Please enter text under filter'
					],
				]
			],
			'inactiveFilterTextColor'            => [
				'type'    => 'input:color',
				'label'   => 'Inactive filter color',
				'default' => '#a6a6a6',
				'sass'    => true
			],
            'inactiveFilterTextColorHover'            => [
                'type'    => 'input:color',
                'label'   => 'Inactive filter hover color',
                'default' => '#2F4F4F',
                'sass'    => true
            ],
            'filterActiveTextColor'       => [
                'type'    => 'input:color',
                'label'   => 'Active filter color',
                'default' => '#002841',
                'sass'    => true
            ],
			'filterActiveTextColorHover'       => [
				'type'    => 'input:color',
				'label'   => 'Active filter color on hover',
				'default' => '#0080ff',
				'sass'    => true
			],
			'filterTextSize'             => [
				'type'    => 'input:text',
				'label'   => 'Filter text size',
				'default' => '18px',
				'sass'    => true
			],
			'filterDescriptionTextColor' => [
				'type'    => 'input:color',
				'label'   => 'Text under filter color',
				'default' => '#292b2c',
				'sass'    => true
			],
			'filterDescriptionTextSize'  => [
				'type'    => 'input:text',
				'label'   => 'Text under filter size',
				'default' => '16px',
				'sass'    => true
			],

			'iconColor' => [
				'type'    => 'input:color',
				'label'   => 'Icons color',
				'default' => '#55c2a2',
				'sass'    => true
			],

			'iconColorHover' => [
				'type'    => 'input:color',
				'label'   => 'Icons hover color',
				'default' => '#16a57a',
				'sass'    => true
			],

			'buttonColor' => [
				'type'        => 'input:color',
				'label'       => 'Button color',
				'description' => 'Button "Read Now" color',
				'default'     => '#55c2a2',
				'sass'        => true
			],

			'buttonColorHover' => [
				'type'        => 'input:color',
				'label'       => 'Button color hover',
				'description' => 'Button "Read Now" color hover',
				'default'     => '#292b2c',
				'sass'        => true
			],

			'isButtonColorBackgroundTransparent'      => [
				'type'    => 'input:switch',
				'label'   => 'Enable Transparent Background',
				'default' => 1,
				'sass'    => true
			],
			'buttonColorBackground'                   => [
				'type'        => 'input:color',
				'label'       => 'Button background color',
				'description' => 'Button "Read Now" background color',
				'default'     => '#16a57a',
				'sass'        => true
			],
			'isButtonColorBackgroundTransparentHover' => [
				'type'    => 'input:switch',
				'label'   => 'Enable Transparent Background on Hover',
				'default' => 1,
				'sass'    => true
			],
			'buttonColorBackgroundHover'              => [
				'type'    => 'input:color',
				'label'   => 'Button background hover color',
				'default' => '#16a57a',
				'sass'    => true
			],
            'numerationFontSize'              => [
                'type'    => 'input:text',
                'label'   => 'Pagination font size',
                'description' => 'Please, enter pagination font size',
                'default' => '18px',
                'sass'    => true
            ],
            'activePageColor'              => [
                'type'    => 'input:color',
                'label'   => 'Actual page number color',
                'description' => 'Color of page number if there are more than 9 posts',
                'default' => '#56c2a3',
                'sass'    => true
            ],
            'nextPageColor'              => [
                'type'    => 'input:color',
                'label'   => 'Next page number color',
                'description' => 'Color of next page number if there are more than 9 posts',
                'default' => '#002841',
                'sass'    => true
            ],
            'nextPageHoverColor'              => [
                'type'    => 'input:color',
                'label'   => 'Next page number hover color',
                'description' => 'Hover color of next page number if there are more than 9 posts',
                'default' => '#56c2a3',
                'sass'    => true
            ],


		];
	}


}
