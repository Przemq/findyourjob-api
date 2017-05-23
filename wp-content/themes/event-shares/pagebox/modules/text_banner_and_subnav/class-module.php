<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class SubnavAndText extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Text Banner & Subnav',
            'description'   => 'Subnav with text banner',
            'js' => [
                'depends' => ['bootstrap']
            ],
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
		        'default' => '#282780',
		        'sass' => true
	        ],
        ];
    }
}