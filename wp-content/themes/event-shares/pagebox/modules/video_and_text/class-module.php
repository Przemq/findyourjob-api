<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Api\Repeater;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class VideoAndText extends AbstractModule implements StaticCacheInterface {
	/**
	 * Module config
	 * @return array Module configuration.
	 */
	protected function config() {
		return [
			'version'     => '1.0.0',
			'title'       => 'Video And Text',
			'description' => 'Video And Text component module',
			'js'          => [
				'depends' => [ 'jquery']
			]
		];
	}

	/**
	 * @return array Fields configuration.
	 */
	protected function fields() {
		return [
			'title'       => [
				'type'  => 'input:text',
				'label' => 'Set title ',
                'description' => 'Please, enter title',
			],
            'titleFontSize'       => [
                'type'  => 'input:text',
                'label' => 'Set text size in px ',
                'description' => 'Please, enter text size',
                'default' => '25px',
                'sass' => true,
            ],
            'titleColor'       => [
                'type'  => 'input:color',
                'label' => 'Title color ',
                'description' => 'Please, select title color',
                'default' => '#1e2c32',
                'sass' => true,
            ],
            'videoURL' => [
                'type' => 'input:text',
                'label' => 'YouTube video id',
                'description' => 'Please, enter YouTube video id(the last part of video link eg: fLexgOxsZu0)'
            ],
            'paragraphText'       => [
                'type'  => 'editor',
                'label' => 'Paragraph text ',
                'description' => 'Please, enter paragraph text',
            ],
            'paragraphFontSize'       => [
                'type'  => 'input:text',
                'label' => 'Set paragraph size in px ',
                'description' => 'Please, enter paragraph text size',
                'default' => '18px',
                'sass' => true,
            ],
            'paragraphColor'       => [
                'type'  => 'input:color',
                'label' => 'Paragraph color ',
                'description' => 'Please, select paragraph color',
                'default' => '#1e2c32',
                'sass' => true,
            ],
            'buttonText'       => [
                'type'  => 'input:text',
                'label' => 'Share button text ',
                'default' => 'Share',
                'description' => 'Please, enter share button text',
            ],
            'buttonColor'       => [
                'type'  => 'input:color',
                'label' => 'Share button text color ',
                'description' => 'Please, select share button text color',
                'default' => '#56c1a3',
                'sass' => true,
            ],
		];

	}
}