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
		add_action( 'wp_ajax_filterInsightsNoPagination', [ $this, 'filterInsightsNoPagination' ] );
		add_action( 'wp_ajax_filterInsightsNoPagination', [ $this, 'filterInsightsNoPagination' ] );
	}

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

		$args         = [
			'posts_per_page' => '3',
			'category_name'  => $postCategory,
			'tag'            => $topic,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_type'      => 'post',
			'post_status'    => 'publish',

		];
		$insightQuery = new WP_Query( $args );

		if ( $insightQuery->have_posts() ) : ?>
            <div class="article-boxes row">
			<?php
			while ( $insightQuery->have_posts() ) : $insightQuery->the_post();
				?>
                <div class="col-lg-4 single-article">
                    <div class="content-wrapper">
						<?php the_post_thumbnail('full',array('class'=>'article-icon'))?>
                        <div class="publication-info col-lg-12">
							<?php the_date('d.m.Y')?> | <?php the_author()?>
                        </div>
                        <div class="col-lg-12"><h3><?= get_the_title() ?></h3></div>
                        <div class="col-lg-12"><p><?php the_excerpt()?></p></div>
                        <div class="col-lg-12" style="text-align: left"><a href="<?=get_the_permalink()?>">READ NOW</a></div>
                    </div>
                </div>
			<?php endwhile;

		else :?>
            <h3>No Insights Found</h3>
		<?php endif; ?>
        </div>
		<?php

//Pagiantion
		if ( $insightQuery->max_num_pages > 1 ): ; ?>
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
                        <div class="numbered">
							<?php echo paginate_links( $pagination ); ?>
                        </div>
                    </div>
                </div>
            </div>
		<?php endif;
		die();
	}


	public function filterInsightsNoPagination() {

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
		if ( isset( $_POST['paginationNumber'] ) && ! empty( $_POST['paginationNumber'] ) ) {
			$paginationNumber = $_POST['paginationNumber'];
		} else {
			$paginationNumber = null;
		}
		$args         = [
			'posts_per_page' => '3',
            'paged' => $paginationNumber,
			'category_name'  => $postCategory,
			'tag'            => $topic,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_type'      => 'post',
			'post_status'    => 'publish',

		];
		$insightQuery = new WP_Query( $args );

		if ( $insightQuery->have_posts() ) : ?>
            <div class="article-boxes row">
            <?php
			while ( $insightQuery->have_posts() ) : $insightQuery->the_post();
				?>
                <div class="col-lg-4 single-article">
                    <div class="content-wrapper">
						<?php the_post_thumbnail('full',array('class'=>'article-icon'))?>
                        <div class="publication-info col-lg-12">
							<?php the_date('d.m.Y')?> | <?php the_author()?>
                        </div>
                        <div class="col-lg-12"><h3><?= get_the_title() ?></h3></div>
                        <div class="col-lg-12"><p><?php the_excerpt()?></p></div>
                        <div class="col-lg-12" style="text-align: left"><a href="<?=get_the_permalink()?>">READ NOW</a></div>
                    </div>
                </div>
			<?php endwhile;
			?>
            </div>
            <?php

		else :?>
            <h3>No Insights Found</h3>
		<?php endif; ?>
        <?php

		if ( $insightQuery->max_num_pages > 1 ): ; ?>
            <div class="container pagePagination">
                <div class="row">
					<?php
					$pagination = array(
                        'current' => $paginationNumber,
						'end_size'           => 1,
						'mid_size'           => 5,
						'total'              => $insightQuery->max_num_pages,
						'prev_next'          => false,
						'before_page_number' => '<strong>',
						'after_page_number'  => '</strong>'
					);
					?>
                    <div class="pagination-wrapper">
                        <div class="numbered">
							<?php echo paginate_links( $pagination ); ?>
                        </div>
                    </div>
                </div>
            </div>
		<?php endif;?>
		<?php
		die();
	}

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
				'depends' => [ 'jquery', 'bootstrap' ]
			],
		];
	}

	/**
	 * @return array Fields configuration.
	 */
	protected function fields() {
		return [
			//Title
			'title'           => [
				'type'        => 'input:text',
				'label'       => 'Title',
				'description' => 'Please enter title'
			],
			'titleColor'      => [
				'type'    => 'input:color',
				'label'   => 'Title color',
				'default' => '#282780',
				'sass'    => true
			],
			'backgroundColor' => [
				'type'    => 'input:color',
				'label'   => 'Background color',
				'default' => '#EBEBEB',
				'sass'    => true
			],
		];
	}
}
