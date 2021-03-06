<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class IconTextAndCTA extends AbstractModule implements StaticCacheInterface {

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Icon Text And CTA',
			'description' => 'Icon, text and download button',
			'js'          => [
				'depends' => [ 'jquery','aos.js' ]
			],
			'css' => [
				'depends' => ['aos']
			]
		];
	}

	/**
	 * @return array Fields configuration.
	 */
	protected function fields() {
		return [
			//Title
			'title'            => [
				'type'        => 'input:text',
				'label'       => 'Title',
				'description' => 'Please enter title'
			],
			'titleColor'       => [
				'type'    => 'input:color',
				'label'   => 'Title color',
				'default' => '#282780',
				'sass'    => true
			],
			'titleSize'        => [
				'type'    => 'input:text',
				'label'   => 'Title size px()',
				'default' => '25px',
				'sass'    => true
			],
			'iconColor'        => [
				'type'    => 'input:color',
				'label'   => 'Icon color',
				'default' => '#59C1A2',
				'sass'    => true
			],
			'iconColorHover'        => [
				'type'    => 'input:color',
				'label'   => 'Icon color on hover',
				'default' => '#16a57a',
				'sass'    => true
			],
			'description'      => [
				'type'    => 'editor',
				'label'   => 'Description',
				'default' => 'Please enter description'
			],
			'descriptionColor' => [
				'type'    => 'input:color',
				'label'   => 'Description color',
				'default' => '#000000',
				'sass'    => true
			],
			'descriptionSize'  => [
				'type'    => 'input:text',
				'label'   => 'Description size px()',
				'default' => '14px',
				'sass'    => true
			],


			'buttons'      => [
				'type'   => 'repeater',
				'label'  => 'Buttons',
				'fields' => [
					'buttonTitle'    => [
						'type'    => 'input:text',
						'label'   => 'Button title',
						'default' => ""
					],
					'buttonHasImage' => [
						'type'    => 'input:switch',
						'label'   => 'Buttons has Image (NO/YES)',
						'default' => true,
					],
					'buttonImage'   => [
						'type'        => 'media:image',
						'label'       => 'Set Icon for button',
						'multiple'    => false,
						'unique'      => false,
						'aspectRatio' => '16:9',
					],
					'isPermalink'     => [
						'type'    => 'input:switch',
						'label'   => 'Use document or external link? (Link/Document)',
						'default' => true,
					],
					'internalLink' => [
						'type'    => 'input:text',
						'label'   => 'Button External Link',
						'default' => "#"
					],
                    'permalink'           => [
                        'type'     => 'select',
                        'label'    => 'Select permalink for button',
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
					'buttonUrl'       => [
						'type'     => 'select',
						'label'    => 'Select document',
						'multiple' => false,
						'options'  => [
							'allowClear' => true
						],
                        'values' => function () {
                            return Select::postFilter(get_posts(['post_type' => array('documents'), 'posts_per_page' => -1]), [
                                'postID' => function (\WP_Post $post) {
                                    return $post->ID;
                                },
                                'permalink' => function (\WP_Post $post) {
                                    return get_permalink($post->ID);
                                },
                                'name' => function (\WP_Post $post) {
                                    return $post->post_name;
                                },
                            ]);
                        }
					],
					'buttonBlankLink' => [
						'type'    => 'input:switch',
						'label'   => 'Open link on new tab?',
						'default' => true,
					],

				],
			],
			'sectionImage' => [
				'type'        => 'media:image',
				'label'       => 'Set background image First Section',
				'multiple'    => false,
				'unique'      => false,
				'aspectRatio' => '16:9',
			],

			'buttonTextColor'            => [
				'type'    => 'input:color',
				'label'   => 'Button text color',
				'default' => '#002841',
				'sass'    => true
			],
			'buttonTextColorHover'       => [
				'type'    => 'input:color',
				'label'   => 'Button text color hover',
				'default' => '#56c2a3',
				'sass'    => true
			],
			'buttonBackgroundColor'      => [
				'type'    => 'input:color',
				'label'   => 'Button background color',
				'default' => '#56c2a3',
				'sass'    => true
			],
			'buttonBackgroundColorHover' => [
				'type'    => 'input:color',
				'label'   => 'Button background color hover',
				'default' => 'transparent',
				'sass'    => true
			],
			'backgroundColor'            => [
				'type'    => 'input:color',
				'label'   => 'Background color',
				'default' => '#f4f4f4',
				'sass'    => true
			],
		];
	}
}