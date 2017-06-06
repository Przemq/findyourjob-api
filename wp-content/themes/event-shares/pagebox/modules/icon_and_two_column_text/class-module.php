<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
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
			'description' => 'Icon and two column witch text'
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


			'rows'            => [
				'type'   => 'repeater',
				'label'  => 'Table',
				'fields' => [
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
			'backgroundColor' => [
				'type'    => 'input:color',
				'label'   => 'Background color',
				'default' => '#EBEBEB',
				'sass'    => true
			],
		];
	}
}