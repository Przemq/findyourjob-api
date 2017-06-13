<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class Map extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Map',
            'description'   => 'Contact Map'
        ];
    }
    /**
     * @return array Fields configuration.
     */
    protected function fields()
    {
        return [
	        //Title

	        'latitude' => [
		        'type' => 'input:text',
		        'label' => 'Enter latitude',
		        'default' => '51.5069479',
	        ],
            'longitude' => [
                'type' => 'input:text',
                'label' => 'Enter Longitude',
                'default' => '-0.1507966',
            ],
            'address' => [
                'type' => 'editor',
                'label' => 'Enter address',
            ],
            'enableTitle' => [
                'type' => 'input:switch',
                'label' => 'Enable title? (NO/YES)',
                'default' => false,
            ],
            'title' => [
                'type' => 'input:text',
                'label' => 'Map title',
                'description' => 'Please enter title'
            ],
            'description' => [
                'type' => 'editor',
                'label' => 'Map description',
                'description' => 'Please enter description'
            ],
            'titleColor' => [
                'type' => 'input:color',
                'label' => 'Title color',
                'default' => '#002842',
                'sass' => true
            ],
            'titleSize' => [
                'type' => 'input:text',
                'label' => 'Title size',
                'default' => '30px',
                'sass' => true
            ],

        ];
    }
}