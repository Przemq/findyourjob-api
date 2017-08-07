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
            'headerSize' => [
                'type' => 'input:text',
                'label' => 'Header font size (in px)',
                'description' => 'Please enter font size',
                'default' => '25px',
                'sass' => true
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
            'contentFontSize' => [
                'type' => 'input:text',
                'label' => 'Content font size',
                'description' => 'Please enter content font size in px',
                'default' => '14px',
                'sass'=> true
            ],
            'backgroundColor' => [
                'type' => 'input:color',
                'label' => 'Background color',
                'default' => '#F4F4F4',
                'sass' => true
            ],
            'paddingBottom' => [
                'type' => 'input:text',
                'label' => 'Padding bottom (in px)',
                'description' => 'Please enter padding',
                'default' => '54px',
                'sass' => true
            ],
        ];
    }
}