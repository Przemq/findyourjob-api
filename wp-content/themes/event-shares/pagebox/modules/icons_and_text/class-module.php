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
			'title'            => [
				'type'        => 'input:text',
				'label'       => 'Title',
				'description' => 'Please enter title'
			],
			'titleColor'       => [
				'type'    => 'input:color',
				'label'   => 'Title color',
				'default' => '#002842',
				'sass'    => true
			],
			'titleSize'        => [
				'type'        => 'input:text',
				'label'       => 'Title size',
				'description' => 'Please enter title size (px)',
				'default'     => '25px',
				'sass'    => true
			],
//	        Repeater
			'sections'         => [
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
					'sectionButtonBlank' => [
						'type'    => 'input:switch',
						'label'   => 'Target Blank:',
						'default' => 1,
					],
				],
			],
//			End Repeater
			'titleInnerSize'   => [
				'type'        => 'input:text',
				'label'       => 'Title Inner size',
				'description' => 'Please enter title size (px)',
				'default'     => '25px',
				'sass'    => true
			],
			'titleInnerColor'  => [
				'type'    => 'input:color',
				'label'   => 'Title color',
				'default' => '#002842',
				'sass'    => true
			],

			'descriptionColor' => [
				'type'    => 'input:color',
				'label'   => 'Description color',
				'default' => '#292b2c',
				'sass'    => true
			],
			'descriptionSize'  => [
				'type'        => 'input:text',
				'label'       => 'Description size',
				'description' => 'Please enter title size (px)',
				'default'     => '14px',
				'sass'    => true
			],
			'sectionIconColor'      => [
				'type'    => 'input:color',
				'label'   => 'Icon (if exist) color',
				'default' => '#56C1A3',
				'sass'    => true
			],
			'sectionIconColorHover' => [
				'type'    => 'input:color',
				'label'   => 'Icon color on hover',
				'default' => '#002841',
				'sass'    => true
			],

		];
	}
}