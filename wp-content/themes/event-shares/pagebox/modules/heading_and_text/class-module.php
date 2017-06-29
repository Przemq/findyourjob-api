<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class HeadingAndTExt extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Simple header and text ',
            'description'   => 'Simple header and text below'
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
		        'default' => '#1E2C32',
		        'sass' => true
	        ],
            'content' => [
                'type' => 'editor',
                'label' => 'Content',
                'description' => 'Please enter text'
            ],
            'backgroundColor' => [
                'type' => 'input:color',
                'label' => 'Background color',
                'default' => '#F4F4F4',
                'sass' => true
            ],
        ];
    }
}