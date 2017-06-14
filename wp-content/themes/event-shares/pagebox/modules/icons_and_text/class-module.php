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
			'description' => 'Three columns with image and text'
		];
	}

	/**
	 * @return array Fields configuration.
	 */
	protected function fields() {
		return [
			//Title
            'typeOfHeader'       => [
                'type'        => 'input:switch',
                'label'       => 'Type of header (Title/Description)',
                'description' => 'Please select type of header',
                'default'     => false
            ],
			'title'           => [
				'type'        => 'input:text',
				'label'       => 'Title',
				'description' => 'Please enter title'
			],
			'titleColor'      => [
				'type'    => 'input:color',
				'label'   => 'Title color',
				'default' => '#002842',
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
				'fields' => [
					'sectionImage'       => [
						'type'        => 'media:image',
						'label'       => 'Set background image First Section',
						'multiple'    => false,
						'unique'      => false,
						'aspectRatio' => '16:9',
					],
					'sectionEditor'      => [
						'type'  => 'editor',
						'label' => 'Set Text for section'
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
			'titleInnerSize'  => [
				'type'        => 'input:text',
				'label'       => 'Description Title size',
				'description' => 'Please enter description Title size px',
				'default'     => '25px',
				'sass'        => true
			],
			'titleInnerColor' => [
				'type'    => 'input:color',
				'label'   => 'Description description Title color',
				'default' => '#002842',
				'sass'    => true
			],

			'descriptionSize'  => [
				'type'        => 'input:text',
				'label'       => 'Description  size',
				'description' => 'Please enter title size px',
				'default'     => '14px',
				'sass'        => true
			],
			'descriptionColor' => [
				'type'    => 'input:color',
				'label'   => 'Description Title color',
				'default' => '#292b2c',
				'sass'    => true
			],
            'sectionIconColor'   => [
	            'type'    => 'input:color',
	            'label'   => 'Icon (if exist) color',
	            'default' => '#56c1a3',
	            'sass'    => true
            ],
//            'sectionIconColorHover'   => [
//	            'type'    => 'input:color',
//	            'label'   => 'Icon (if exist) color',
//	            'default' => '#56c1a3',
//	            'sass'    => true
//            ],
			'backgroundColor'  => [
				'type'    => 'input:color',
				'label'   => 'Background color',
				'default' => '#ffffff',
				'sass'    => true
			],
		];
	}
}