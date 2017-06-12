<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
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
			'title'      => [
				'type'        => 'input:text',
				'label'       => 'Title',
				'description' => 'Please enter title'
			],
			'titleColor' => [
				'type'    => 'input:color',
				'label'   => 'Title color',
				'default' => '#002842',
				'sass'    => true
			],
			'titleSize'      => [
				'type'        => 'input:text',
				'label'       => 'Title size',
				'description' => 'Please enter title size px',
				'default' => '25px',
				'sass'  => true
			],
//	        Repeater
			'sections'       => [
				'type'   => 'repeater',
				'label'  => 'Sections',
				'fields' => [
					'sectionIconColor'    => [
						'type'    => 'input:color',
						'label'   => 'Icon (if exist) color',
						'default' => '#002842',
						'sass'    => true
					],
					'sectionImage'        => [
						'type'        => 'media:image',
						'label'       => 'Set background image First Section',
						'multiple'    => false,
						'unique'      => false,
						'aspectRatio' => '16:9',
					],
					'sectionEditor'       => [
						'type'  => 'editor',
						'label' => 'Set Text for section'
					],
					'sectionButton'       => [
						'type'    => 'input:text',
						'label'   => 'Button Text:',
						'default' => '',
					],
					'sectionButtonUrl'       => [
						'type'    => 'input:text',
						'label'   => 'Button Url Text:',
						'default' => '#',
					],
					'sectionButtonBlank' => [
						'type'    => 'input:switch',
						'label'   => 'Target Blank:',
						'default' => 1,
					],
				],
			],
			'titleInnerSize'      => [
				'type'        => 'input:text',
				'label'       => 'Description Title size',
				'description' => 'Please enter description Title size px',
				'default' => '25px',
				'sass'  => true
			],
			'titleInnerColor' => [
				'type'    => 'input:color',
				'label'   => 'Description description Title color',
				'default' => '#002842',
				'sass'    => true
			],

			'descriptionSize'      => [
				'type'        => 'input:text',
				'label'       => 'Description  size',
				'description' => 'Please enter title size px',
				'default' => '14px',
				'sass'  => true
			],
			'descriptionColor' => [
				'type'    => 'input:color',
				'label'   => 'Description Title color',
				'default' => '#292b2c',
				'sass'    => true
			],
//			In QUESTION
//			'buttonLinkSize'      => [
//				'type'        => 'input:text',
//				'label'       => 'Button size',
//				'description' => 'Please enter button size px',
//				'default' => '16px',
//				'sass'  => true
//			],
//			'buttonLinkColor' => [
//				'type'    => 'input:color',
//				'label'   => 'Button color',
//				'default' => '#56c1a3',
//				'sass'    => true
//			],
//			'buttonLinkColorHover' => [
//				'type'    => 'input:color',
//				'label'   => 'Button hover color',
//				'default' => '#014c8c',
//				'sass'    => true
//			],
            'backgroundColor' => [
                'type'    => 'input:color',
                'label'   => 'Background color',
                'default' => '#ffffff',
                'sass'    => true
            ],
		];
	}
}