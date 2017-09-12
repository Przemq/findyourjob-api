<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class IconsAndText extends AbstractModule implements StaticCacheInterface {

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Icons and text',
			'description' => 'Three columns with image and text',
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
			'title'           => [
				'type'        => 'input:text',
				'label'       => 'Title',
				'description' => 'Please enter title'
			],
            'isDescription'           => [
                'type'        => 'input:switch',
                'label'       => 'Top text is header or description? (default header)',
                'description' => 'Please select top text style',
                'default' => false
            ],
            'paddingUnderTitle'      => [
                'type'    => 'input:text',
                'label'   => 'Padding under title/description',
                'default' => '80px',
                'sass'    => true
            ],
            'paddingUnderButton'      => [
                'type'    => 'input:text',
                'label'   => 'Padding under buttons',
                'default' => '75px',
                'sass'    => true
            ],
			'titleColor'      => [
				'type'    => 'input:color',
				'label'   => 'Title/Description color',
				'default' => '#1e2c32',
				'sass'    => true
			],
			'titleSize'       => [
				'type'        => 'input:text',
				'label'       => 'Title size',
				'description' => 'Please enter title size px',
				'default'     => '25px',
				'sass'        => true
			],
//	        Repeater
			'sections'        => [
				'type'   => 'repeater',
				'label'  => 'Sections',
                'maxItems' => 3,
				'fields' => [
					'sectionImage'       => [
						'type'        => 'media:image',
						'label'       => 'Set background image',
						'multiple'    => false,
						'unique'      => false,
						'aspectRatio' => '16:9',
					],
					'sectionTitle'      => [
						'type'  => 'input:text',
						'label' => 'Section title text'
					],
					'sectionEditor'      => [
						'type'  => 'editor',
						'label' => 'Set text for section'
					],
					'sectionButton'      => [
						'type'    => 'input:text',
						'label'   => 'Button Text:',
						'default' => '',
					],
					'sectionButtonUrl'   => [
						'type'    => 'input:text',
						'label'   => 'Button Url Text:',
						'default' => '#',
					],
                    'enableButton' => [
                        'type'    => 'input:switch',
                        'label'   => 'Enable button (NO/YES)',
                        'default' => false,
                    ],
					'sectionButtonBlank' => [
						'type'    => 'input:switch',
						'label'   => 'Target Blank:',
						'default' => 1,
					],
					'isPermalink'        => [
						'type'    => 'input:switch',
						'label'   => 'Use Permalink Link',
						'default' => 1
					],
					'pageLink'           => [
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
				],
			],
            'sectionTitleColor'   => [
	            'type'    => 'input:color',
	            'label'   => 'Section title color',
	            'default' => '#1e2c32',
	            'sass'    => true
            ],
            'sectionTitleSize'   => [
	            'type'    => 'input:text',
	            'label'   => 'Section title size',
	            'default' => '25px',
	            'sass'    => true
            ],
            'buttonTextColor'   => [
                'type'    => 'input:color',
                'label'   => 'Button text color',
                'default' => '#002841',
                'sass'    => true
            ],
            'buttonTextHoverColor'   => [
                'type'    => 'input:color',
                'label'   => 'Button text hover color',
                'default' => '#56c1a3',
                'sass'    => true
            ],
            'buttonBackgroundColor'   => [
                'type'    => 'input:color',
                'label'   => 'Button background color',
                'default' => '#56c1a3',
                'sass'    => true
            ],
            'buttonBackgroundHoverColor'   => [
                'type'    => 'input:color',
                'label'   => 'Button background hover color',
                'default' => 'white',
                'sass'    => true
            ],
            'buttonFontSize'   => [
                'type'    => 'input:text',
                'label'   => 'Button font size',
                'default' => '16px',
                'sass'    => true
            ],
			'backgroundColor'  => [
				'type'    => 'input:color',
				'label'   => 'Background color',
				'default' => '#ffffff',
				'sass'    => true
			],
            'singleParagraphFontSize'   => [
                'type'    => 'input:text',
                'label'   => 'Single column font size',
                'default' => '14px',
                'sass'    => true
            ],
            'singleParagraphColor'  => [
                'type'    => 'input:color',
                'label'   => 'Single column text color',
                'default' => '#000000',
                'sass'    => true
            ],
		];
	}
}