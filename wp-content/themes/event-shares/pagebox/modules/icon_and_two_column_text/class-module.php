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
						'label' => 'Enter link if applicable',
					],
					'rowUrlBlank' => [
						'type'  => 'input:switch',
						'label' => 'Link new target',
						'default' => 1
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
				'label'   => 'Display',
				'default' => 1,
			],
			'rowColor'        => [
				'type'    => 'input:color',
				'label'   => 'Row color',
				'default' => '#1B1B1B',
				'sass'    => true
			],
			'rowSize'         => [
				'type'    => 'input:text',
				'label'   => 'Row size px()',
				'default' => '14px',
				'sass'    => true
			],
			'etfsColorHover' => [
				'type'    => 'input:color',
				'label'   => 'ETFS hover color',
				'default' => '#56c1a3',
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