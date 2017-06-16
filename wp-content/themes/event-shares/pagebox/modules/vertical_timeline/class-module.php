<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class VerticalTimeLine extends AbstractModule implements StaticCacheInterface {

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Vertical timeline',
			'description' => 'Vertical timeline with events'
		];
	}

	/**
	 * @return array Fields configuration.
	 */
	protected function fields() {
		return [
			'title'           => [
				'type'        => 'input:text',
				'label'       => 'Title',
				'description' => 'Please enter title'
			],
            'backgroundColor'           => [
                'type'        => 'input:color',
                'label'       => 'Background color',
                'description' => 'Please select color',
                'default' => '#F4F4F4',
                'sass' => true
            ],
		];
	}
}