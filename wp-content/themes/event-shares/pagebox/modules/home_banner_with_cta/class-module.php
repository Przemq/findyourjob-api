<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class HomeBanner extends AbstractModule implements StaticCacheInterface {

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Home Banner With CTA',
			'description' => 'Home Banner'
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
				'default' => '#ffffff',
				'sass'    => true
			],
			'titleInner'      => [
				'type'        => 'input:text',
				'label'       => 'Title colorful',
				'description' => 'Please enter fancy title'
			],
			'titleInnerColor' => [
				'type'        => 'input:color',
				'label'       => 'Title colorful color',
				'description' => 'Please enter fancy title color',
				'default'     => '#55C2A2',
				'sass'        => true
			],
			'titleSize'       => [
				'type'        => 'input:text',
				'label'       => 'Title size',
				'description' => 'Please enter title size (px)',
				'default'     => '54px',
				'sass'        => true
			],
			'description'     => [
				'type'        => 'editor',
				'label'       => 'Description',
				'description' => 'Please enter description',
				'default'     => ''
			],
			'descriptionColor' => [
				'type'        => 'input:color',
				'label'       => 'Description color',
				'description' => 'Please enter fancy description color',
				'default'     => '#ffffff',
				'sass'        => true
			],
			'descriptionSize'       => [
				'type'        => 'input:text',
				'label'       => 'Description size',
				'description' => 'Please enter description size (px)',
				'default'     => '14px',
				'sass'        => true
			],
			'backgroundColor' => [
				'type'        => 'input:color',
				'label'       => 'Background color',
				'description' => 'Please enter color',
				'default'     => '#002841',
				'sass'        => true
			],
			// Image
			'bgImage'         => [
				'type'        => 'media:image',
				'label'       => 'Set background image',
				'multiple'    => false,
				'unique'      => false,
				'aspectRatio' => '16:9',
			],
//	        Buttons

			'buttonLeftTitle'     => [
				'type'    => 'input:text',
				'label'   => 'Button Left title',
				'default' => ""
			],
			'buttonUrlLeft'       => [
				'type'     => 'select',
				'label'    => 'Page select',
				'multiple' => false,
				'options'  => [
					'allowClear' => true
				],
				'values'   => function () {
					return Select::postFilter( get_pages( [ 'posts_per_page' => - 1 ] ), [
						'postID'    => function ( \WP_Post $post ) {
							return $post->ID;
						},
						'permalink' => function ( \WP_Post $post ) {
							return get_permalink( $post->ID );
						}
					] );
				}
			],
			'buttonLeftBlankLink' => [
				'type'    => 'input:switch',
				'label'   => 'Link new target:',
				'default' => 1,
			],
			'buttonLeftOn'        => [
				'type'    => 'input:switch',
				'label'   => 'Display',
				'default' => 1,
			],

//	        Left Button End

			'buttonMiddleTitle'     => [
				'type'    => 'input:text',
				'label'   => 'Button Middle title',
				'default' => ""
			],
			'buttonUrlMiddle'       => [
				'type'     => 'select',
				'label'    => 'Page select',
				'multiple' => false,
				'options'  => [
					'allowClear' => true
				],
				'values'   => function () {
					return Select::postFilter( get_pages( [ 'posts_per_page' => - 1 ] ), [
						'postID'    => function ( \WP_Post $post ) {
							return $post->ID;
						},
						'permalink' => function ( \WP_Post $post ) {
							return get_permalink( $post->ID );
						}

					] );
				}
			],
			'buttonMiddleBlankLink' => [
				'type'    => 'input:switch',
				'label'   => 'Link new target:',
				'default' => 1,
			],
			'buttonMiddleOn'        => [
				'type'    => 'input:switch',
				'label'   => 'Display',
				'default' => 0,
			],

//			Next button
			'buttonRightTitle'      => [
				'type'    => 'input:text',
				'label'   => 'Button Right title',
				'default' => ""
			],
			'buttonUrlRight'        => [
				'type'     => 'select',
				'label'    => 'Page select',
				'multiple' => false,
				'options'  => [
					'allowClear' => true
				],
				'values'   => function () {
					return Select::postFilter( get_pages( [ 'posts_per_page' => - 1 ] ), [
						'postID'    => function ( \WP_Post $post ) {
							return $post->ID;
						},
						'permalink' => function ( \WP_Post $post ) {
							return get_permalink( $post->ID );
						}
					] );
				}
			],
			'buttonRightBlankLink'  => [
				'type'    => 'input:switch',
				'label'   => 'Link new target:',
				'default' => 1,
			],
			'buttonRightOn'         => [
				'type'    => 'input:switch',
				'label'   => 'Display',
				'default' => 0,
			],
		];
	}
}