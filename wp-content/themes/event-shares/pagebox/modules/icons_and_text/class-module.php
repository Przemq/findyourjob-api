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
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Icons and text',
            'description'   => 'Three columns with image and text'
        ];
    }

    /**
     * @return array Fields configuration.
     */
    protected function fields()
    {
        return [
	        //Title
	        'title' => [
		        'type' => 'input:text',
		        'label' => 'Title',
		        'description' => 'Please enter title'
	        ],
	        'titleColor' => [
		        'type' => 'input:color',
		        'label' => 'Title color',
		        'default' => '#002842',
		        'sass' => true
	        ],
//	        First Section
	        'firstSectionSwitch'       => [
		        'type'    => 'input:switch',
		        'label'   => 'SVG(Marker) / Image:',
		        'default' => 0,
	        ],
	        'firstSectionIconColor' => [
		        'type' => 'input:color',
		        'label' => 'Title color',
		        'default' => '#002842',
		        'sass' => true
	        ],
	        'firstSectionImage'          => [
		        'type'        => 'media:image',
		        'label'       => 'Set background image First Section',
		        'multiple'    => false,
		        'unique'      => false,
		        'aspectRatio' => '16:9',
	        ],
	        'firstSectionEditor' =>[
	        	'type'=>'editor',
		        'label' =>'Set Text for first Section'
	        ]
        ];
    }
}