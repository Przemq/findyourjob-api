<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class Fund extends AbstractModule implements StaticCacheInterface {

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Fund page',
			'description' => 'Fund page module. It shows funds based on environment. Please set correct environment in wp-config.php - WP_ENVIRONMENT - DEV, STG, PROD.'
		];
	}
	/**
	 * @return array Fields configuration.
	 */
	protected function fields() {
		return [
			'isin'            => [
				'type'        => 'input:text',
				'default' => '1000',
				'label'       => 'Text Banner',
				'description' => 'Please enter Banner text'
			],
        ];
	}
}