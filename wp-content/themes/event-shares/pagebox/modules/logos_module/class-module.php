<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class LogosModule extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Logos module',
            'description'   => 'Logos module with text header'
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