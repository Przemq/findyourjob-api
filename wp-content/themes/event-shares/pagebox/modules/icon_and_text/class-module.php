<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;
use Nurture\Pagebox\Module\Fields\Builder\Select;

class IconAndText extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Icon And Text',
            'description'   => 'One icon and text'
        ];
    }
    /**
     * @return array Fields configuration.
     */
    protected function fields()
    {
        return [
	        //Title
	        'textUnderImage' => [
		        'type' => 'editor',
		        'label' => 'Text under image',
		        'description' => 'Please enter description'
	        ],
            'fontSize' => [
                'type' => 'input:text',
                'label' => 'Font size',
                'default' => '14px',
                'sass' => true
            ],
            'imageUrl' => [
                'type' => 'media:image',
                'label' => 'Image',
                'description' => 'Please select image'
            ],
	        'imageColor' => [
		        'type' => 'input:color',
		        'label' => 'Image color',
		        'default' => '#59c1a2',
		        'sass' => true
	        ],
	        'imageColorHover' => [
		        'type' => 'input:color',
		        'label' => 'Image color on hover',
		        'default' => '#16a57a',
		        'sass' => true
	        ],
            'isLinkEnable' => [
                'type' => 'input:switch',
                'label' => 'Enable link? (NO/YES)',
                'default' => false
            ],
            'linkText' => [
                'type' => 'input:text',
                'label' => 'link text',
                'description' => 'Please enter link text'
            ],
            'enableInternalLink' => [
                'type' => 'input:switch',
                'label' => 'Enable internal link? (NO/YES)',
                'default' => false
            ],
            'linkUrl'       => [
                'type'     => 'select',
                'label'    => 'Select page as a link URL',
                'multiple' => false,
                'options'  => [
                    'allowClear' => true
                ],
                'values'   => function () {
                    return Select::postFilter( get_pages( [ 'posts_per_page' => - 1 ] ), [
                        'permalink' => function ( \WP_Post $post ) {
                            return get_permalink( $post->ID );
                        }
                    ] );
                },
                'default' => ''
            ],
            'externalLink' => [
                'type' => 'input:text',
                'label' => 'External link',
                'description' => 'Please enter external URL'
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