<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class Contact extends AbstractModule implements StaticCacheInterface {

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Contact Form',
			'description' => 'Contact module',
			'js'          => [
				'depends' => [ 'jquery' ]
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
				'description' => 'Main contacts title',
				'default'     => 'Contacts'
			],
			'backgroundColor' => [
				'type'    => 'input:color',
				'label'   => 'Background color',
				'default' => '#ffffff',
				'sass'    => true
			],

			'addresses' => [
				'type'   => 'repeater',
				'label'  => 'Addresses',
				'fields' => [
					'title'       => [
						'type'        => 'input:text',
						'label'       => 'Title',
						'description' => 'Please enter title'
					],
					'isTitle'     => [
						'type'        => 'input:switch',
						'label'       => 'Title(off/on)',
						'description' => 'Please pick option',
						'default'     => 1
					],
					'description' => [
						'type'        => 'editor',
						'label'       => 'Description',
						'description' => 'Please enter description'
					],
					'button'      => [
						'type'    => 'input:text',
						'label'   => 'Button Text',
						'default' => '',
					],
					'isPermalink' => [
						'type'    => 'input:switch',
						'label'   => 'Use Permalink Link',
						'default' => 1
					],
					'buttonUrl'   => [
						'type'    => 'input:text',
						'label'   => 'Button Url',
						'default' => '#'
					],
					'pageLink'    => [
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
					'buttonBlank' => [
						'type'    => 'input:switch',
						'label'   => 'Button Url New target',
						'default' => 1,
					],
				],

			],

			'contactFormShortCode' => [
				'type'        => 'input:text',
				'label'       => 'Contact Form 7 Shortcode',
				'description' => ''
			],

			'subscriptionDescription' => [
				'type'        => 'editor',
				'label'       => 'Subscription Description',
				'description' => 'Please enter description'
			],
			'messageAfterSentOK'      => [
				'type'        => 'editor',
				'label'       => 'Message after form is submited',
				'description' => 'Please enter message'
			],

			'buttonTextColor'       => [
				'type'    => 'input:color',
				'label'   => 'Button Text color',
				'default' => '#002841',
				'sass'    => true

			],
			'buttonBackgroundColor' => [
				'type'    => 'input:color',
				'label'   => 'Button Background color',
				'default' => '#56c1a3',
				'sass'    => true
			],
			'buttonBorderColor'     => [
				'type'    => 'input:color',
				'label'   => 'Button border color',
				'default' => '#56c1a3',
				'sass'    => true
			],

			'buttonTextHoverColor'                  => [
				'type'    => 'input:color',
				'label'   => 'Button text hover color',
				'default' => '#56c1a3',
				'sass'    => true

			],
			'buttonBackgroundHoverColorTransparent' => [
				'type'    => 'input:switch',
				'label'   => 'Button Background Hover Transparent',
				'default' => 1,
				'sass'    => true
			],
			'buttonBackgroundHoverColor'            => [
				'type'    => 'input:color',
				'label'   => 'Button Background Hover color',
				'default' => '#56c1a3',
				'sass'    => true
			],

			'buttonBorderHoverColor' => [
				'type'    => 'input:color',
				'label'   => 'Button Border Hover color',
				'default' => '#56c1a3',
				'sass'    => true
			],

		];
	}
}