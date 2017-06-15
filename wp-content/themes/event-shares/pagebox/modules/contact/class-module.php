<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class Contact extends AbstractModule implements StaticCacheInterface {

	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Contact Form',
			'description' => 'Contact module',
			'js' => [
				'depends' => ['']
			],

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
				'description' => 'CONTACTS'
			],
			'backgroundColor' => [
				'type'    => 'input:color',
				'label'   => 'Background color',
				'default' => '#ffffff',
				'sass'    => true
			],

			'addresses' => [
				'type'   => 'repeater',
				'label'  => 'Addresses',
				'fields' => [
					'title'       => [
						'type'        => 'input:text',
						'label'       => 'Title',
						'description' => 'Please enter title'
					],
					'isTitle'       => [
						'type'        => 'input:switch',
						'label'       => 'Title(off/on)',
						'description' => 'Please pick option',
						'default' => 1
					],
					'description' => [
						'type'        => 'editor',
						'label'       => 'Description',
						'description' => 'Please enter description'
					],
				],

			],

			'contactFormShortCode' => [
				'type'        => 'input:text',
				'label'       => 'Contact Form 7 Shortcode',
				'description' => ''
			],

			'subscriptionDescription' => [
				'type'        => 'editor',
				'label'       => 'Subscription Description',
				'description' => 'Please enter description'
			],
		];
	}
}