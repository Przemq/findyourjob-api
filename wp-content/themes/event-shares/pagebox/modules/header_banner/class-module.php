<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;
use Nurture\Pagebox\Module\Fields\Builder\Select;

class HeaderBanner extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Header Banner',
            'description'   => 'Header banner with text and image in background'
        ];
    }
    /**
     * @return array Fields configuration.
     */
    protected function fields()
    {
        return [
	        'headerText' => [
		        'type' => 'input:text',
		        'label' => 'Header title',
		        'description' => 'Please enter title'
	        ],
	        'headerColor' => [
		        'type' => 'input:color',
		        'label' => 'Header color',
		        'default' => '#ffffff',
		        'sass' => true
	        ],
            'headerSize' => [
                'type' => 'input:text',
                'label' => 'Header font size',
                'description' => 'Please enter font size ',
                'default' => '54px',
                'sass' => true
            ],
            'isAllCaps' => [
                'type' => 'input:switch',
                'label' => 'Text in title all CAPS',
                'description' => 'Enable or disable uppercase text',
                'default' => true,
                'sass' => true
            ],
            'paragraphText' => [
                'type' => 'editor',
                'label' => 'Text under header',
                'description' => 'Please enter text'
            ],
            'descriptionColor' => [
                'type' => 'input:color',
                'label' => 'Description color',
                'default' => '#ffffff',
                'sass' => true
            ],
            'descriptionFontSize' => [
                'type' => 'input:text',
                'label' => 'Description font size',
                'description' => 'Please enter description font size ',
                'default' => '14px',
                'sass' => true
            ],
            'buttonRepeater' => [
                'type' => 'repeater',
                'label' => 'Buttons',
                'maxItems' => 3,
                'fields' => [
                    'buttonText' => [
                        'type' => 'input:text',
                        'label' => 'Button text',
                        'default' => 'Learn more'
                    ],
                    'enableInternalLink' => [
                        'type' => 'input:switch',
                        'label' => 'Enable internal link? (NO/YES)',
                        'default' => false
                    ],
                    'internalUrl' => [
                        'type' => 'select',
                        'label' => 'Select page',
                        'multiple' => false,
                        'options' => [
                            'allowClear' => true
                        ],
                        'values' => function () {
                            return Select::postFilter(get_pages(['posts_per_page' => -1]), [
                                'permalink' => function (\WP_Post $post) {
                                    return get_permalink($post->ID);
                                }
                            ]);
                        }
                    ],
                    'externalUrl' => [
                        'type' => 'input:text',
                        'label' => 'External link',
                        'description' => 'Please enter external URL'
                    ],

                ],
            ],
            'buttonColor'           => [
                'type'        => 'input:color',
                'label'       => 'Button color',
                'description' => 'Please select color',
                'default' => '#56C1A3',
                'sass' => true
            ],
            'buttonHoverColor'           => [
                'type'        => 'input:color',
                'label'       => 'Button hover color',
                'description' => 'Please select color',
                'default' => 'transparent',
                'sass' => true
            ],
            'buttonTextColor'           => [
                'type'        => 'input:color',
                'label'       => 'Button text color',
                'description' => 'Please select color',
                'default' => '#002841',
                'sass' => true
            ],
            'buttonHoverTextColor'           => [
                'type'        => 'input:color',
                'label'       => 'Button hover text color',
                'description' => 'Please select color',
                'default' => '#56C1A3',
                'sass' => true
            ],
            'isImageBackground' => [
                'type' => 'input:switch',
                'label' => 'Enable image background? (NO/YES)',
                'description' => 'Please select option',
                'default' => false,
            ],
            'imageBackground' => [
                'type' => 'media:image',
                'label' => 'Select background image',
                'description' => 'Please select background image',
            ],
            'backgroundColor' => [
                'type' => 'input:color',
                'label' => 'Background color',
                'default' => '#002841',
                'sass' => true
            ],
        ];
    }
}