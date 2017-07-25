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
                'label' => 'Enter address header',
            ],
            'subAddress' => [
                'type' => 'editor',
                'label' => 'Enter address',
            ],
            'addressFontSize' => [
                'type' => 'input:text',
                'label' => 'Address header font size',
                'default' => '16px',
                'sass' => true
            ],
            'headerAddressColor' => [
                'type' => 'input:color',
                'label' => 'Address header address color',
                'default' => '#000000',
                'sass' => true
            ],
            'subAddressFontSize' => [
                'type' => 'input:text',
                'label' => 'Sub address font size',
                'default' => '14px',
                'sass' => true
            ],
            'subAddressColor' => [
                'type' => 'input:color',
                'label' => 'Sub address color',
                'default' => '#000000',
                'sass' => true
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
            'titleColor' => [
                'type' => 'input:color',
                'label' => 'Title color',
                'default' => '#002842',
                'sass' => true
            ],
            'titleSize' => [
                'type' => 'input:text',
                'label' => 'Title font size',
                'default' => '30px',
                'sass' => true
            ],
            'description' => [
                'type' => 'editor',
                'label' => 'Map description',
                'description' => 'Please enter description'
            ],
            'descriptionColor' => [
                'type' => 'input:color',
                'label' => 'Description color',
                'default' => '#000000',
                'sass' => true
            ],
            'descriptionSize' => [
                'type' => 'input:text',
                'label' => 'Description font size',
                'default' => '14px',
                'sass' => true
            ],
            'markerColor' => [
                'type' => 'input:color',
                'label' => 'Map marker color',
                'default' => '#008080',
            ],
            'markerStrokeColor' => [
                'type' => 'input:color',
                'label' => 'Marker stroke color',
                'default' => '#515151',
            ],

        ];
    }
}