<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class SearchResults extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Search Results',
            'description'   => 'Pages and articles search results'
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
            'topBackground' => [
                'type' => 'input:color',
                'label' => 'Page results background color',
                'default' => '#ffffff',
                'sass' => true
            ],
            'bottomBackground' => [
                'type' => 'input:color',
                'label' => 'Article results background color',
                'default' => '#EBEBEB',
                'sass' => true
            ],
        ];
    }
}