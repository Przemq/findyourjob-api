<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class TextBanner extends AbstractModule implements StaticCacheInterface {

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Text Banner',
			'description' => 'Simple, plain text banner'
		];
	}
	/**
	 * @return array Fields configuration.
	 */
	protected function fields() {
		return [
			//Title
			'Text'            => [
				'type'        => 'editor',
				'label'       => 'Text Banner',
				'description' => 'Please enter Banner text'
			],
			'bannerColor'     => [
				'type'    => 'input:color',
				'label'   => 'Text Banner color',
				'default' => '#182328',
				'sass'    => true
			],
			'bannerSize'      => [
				'type'    => 'input:text',
				'label'   => 'Text Banner size (px)',
				'default' => '23px',
				'sass'    => true
			],
			'backgroundColor' => [
				'type'    => 'input:color',
				'label'   => 'Background Color',
				'default' => '#ffffff',
				'sass'    => true
			],
			'buttonSwitch'    => [
				'type'    => 'input:switch',
				'label'   => 'Button Switch',
				'default' => 0,
			],
			'button'          => [
				'type'    => 'input:text',
				'label'   => 'Button Text',
				'default' => '',
			],
			'isPermalink' => [
				'type'  => 'input:switch',
				'label' => 'Use Permalink Link',
				'default' => 1
			],
			'buttonUrl'       => [
				'type'    => 'input:text',
				'label'   => 'Button Url',
				'default' => '#'
			],
			'pageLink'       => [
				'type'     => 'select',
				'label'    => 'Select pagelink for button',
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
			'buttonBlank'     => [
				'type'    => 'input:switch',
				'label'   => 'Button Url New target',
				'default' => 1,
			],

		];
	}
}