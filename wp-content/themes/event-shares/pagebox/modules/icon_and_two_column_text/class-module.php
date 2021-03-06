<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class IconWithTwoColumnText extends AbstractModule implements StaticCacheInterface {

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Icon And Two column Text',
			'description' => 'Icon and two column witch text',
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
				'default' => '#1e2c32',
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
				'label'   => 'Icon color Hover',
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


			'rows' => [
				'type'   => 'repeater',
				'label'  => 'Table',
				'fields' => [
					'rowUrl' => [
						'type'  => 'input:text',
						'label' => 'Enter external link',
					],
                    'linkURL'       => [
                        'type'     => 'select',
                        'label'    => 'Select link',
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
					'rowUrlBlank' => [
						'type'  => 'input:switch',
						'label' => 'Link new target',
						'default' => true
					],
					'rowBoldText' => [
						'type'  => 'input:text',
						'label' => 'Enter row left text',
					],
					'rowText'     => [
						'type'  => 'input:text',
						'label' => 'Enter row right text ',
					],
				],
			],
			'sectionImage'       => [
				'type'        => 'media:image',
				'label'       => 'Set background image First Section',
				'multiple'    => false,
				'unique'      => false,
				'aspectRatio' => '16:9',
			],
			'buttonTitle'     => [
				'type'    => 'input:text',
				'label'   => 'Button title',
				'default' => ""
			],
			'buttonUrl'       => [
				'type'     => 'select',
				'label'    => 'Select page for button',
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
			'buttonBlankLink' => [
				'type'    => 'input:switch',
				'label'   => 'Link new target:',
				'default' => 1,
			],
			'buttonOn'        => [
				'type'    => 'input:switch',
				'label'   => 'Display button',
				'default' => 1,
			],
			'rowColor'        => [
				'type'    => 'input:color',
				'label'   => 'Right side links color',
				'default' => '#1B1B1B',
				'sass'    => true
			],
			'rowSize'         => [
				'type'    => 'input:text',
				'label'   => 'Right side links size in px',
				'default' => '14px',
				'sass'    => true
			],
			'etfsColorHover' => [
				'type'    => 'input:color',
				'label'   => 'Right side links hover color',
				'default' => '#56c1a3',
				'sass'    => true
			],
			'backgroundColor' => [
				'type'    => 'input:color',
				'label'   => 'Background color',
				'default' => '#EBEBEB',
				'sass'    => true
			],
            'buttonBackgroundColor' => [
                'type' => 'input:color',
                'label' => 'Buttons background color',
                'default' => '#56c1a3',
                'sass' => true
            ],
            'buttonTextColor' => [
                'type' => 'input:color',
                'label' => 'Buttons text color',
                'default' => '#002841',
                'sass' => true
            ],
            'buttonBackgroundHoverColor' => [
                'type' => 'input:color',
                'label' => 'Buttons background hover color',
                'default' => '#ffffff',
                'sass' => true
            ],
            'buttonTextColorHover' => [
                'type' => 'input:color',
                'label' => 'Buttons text hover color',
                'default' => '#ffffff',
                'sass' => true
            ],
            'buttonBackgroundHoverOpacity' => [
                'type' => 'input:text',
                'label' => 'Buttons background on hover opacity',
                'description' => 'Please enter opacity (values from 0 to 1)',
                'default' => 0.14,
                'sass' => true
            ],
            'buttonFontSize' => [
                'type' => 'input:text',
                'label' => 'Buttons font size',
                'default' => '16px',
                'sass' => true
            ],

        ];
	}
}