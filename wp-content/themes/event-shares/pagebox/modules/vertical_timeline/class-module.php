<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class VerticalTimeLine extends AbstractModule implements StaticCacheInterface
{

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
            'version' => '1.0.0',
            'title' => 'Vertical timeline / Heading and text',
            'description' => 'Vertical timeline / Possibility to add only heading and text ',
            'js'          => [
	            'depends' => [ 'jquery','aos.js' ]
            ],
            'css' => [
	            'depends' => ['aos']
            ]
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
                'label' => 'Header text',
            ],
            'headerSize' => [
                'type' => 'input:text',
                'label' => 'Header font size',
                'default' => '25px',
                'sass' => true

            ],
            'headerColor' => [
                'type' => 'input:color',
                'label' => 'Header color',
                'default' => '#1e2c32',
                'sass' => true
            ],
            'description' => [
                'type' => 'editor',
                'label' => 'Module description'
            ],
            'descriptionSize' => [
	            'type' => 'input:text',
	            'label' => 'Description font size',
	            'default' => '14px',
	            'sass' => true

            ],
            'descriptionColor' => [
	            'type' => 'input:color',
	            'label' => 'Description color',
	            'default' => '#1e2c32',
	            'sass' => true
            ],
            'align'        => [
                'type'     => 'select',
                'label'    => 'Description align',
                'multiple' => false,
                'values'   => [
                    [ 'id' => 'center', 'name' => 'Center' ],
                    [ 'id' => 'left', 'name' => 'Left' ],
                    [ 'id' => 'right', 'name' => 'Right' ]
                ],
                'default'  => 'left',
                'sass'     => true
            ],

            'eventRepeater' => [
                'type' => 'repeater',
                'label' => 'Events',
                'fields' => [
                    'eventHeader' => [
                        'type' => 'input:text',
                        'label' => 'TimeLine Header text',
                    ],
                    'eventDescription' => [
                        'type' => 'editor',
                        'label' => 'Event description',
                        'description' => 'Please enter event description'
                    ],
                    'enableButton' => [
                        'type' => 'input:switch',
                        'label' => 'Enable button?',
                        'description' => 'Please select option',
                        'default' => false,
                    ],
                    'buttonText' => [
                        'type' => 'input:text',
                        'label' => 'Button text',
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
            'timelineheaderSize' => [
	            'type' => 'input:text',
	            'label' => 'Timeline header font size',
	            'default' => '24px',
	            'sass' => true
            ],
            'timelineheaderColor' => [
	            'type' => 'input:color',
	            'label' => 'Timeline header font color',
	            'default' => '#1e2c32',
	            'sass' => true
            ],

            'timelineDescriptionSize' => [
	            'type' => 'input:text',
	            'label' => 'Timeline Description font size',
	            'default' => '14px',
	            'sass' => true
            ],
            'timelineDescriptionColor' => [
	            'type' => 'input:color',
	            'label' => 'Timeline description font color',
	            'default' => '#1e2c32',
	            'sass' => true
            ],
            'backgroundColor' => [
                'type' => 'input:color',
                'label' => 'Background color',
                'description' => 'Please select color',
                'default' => '#F4F4F4',
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
            'buttonColor'           => [
                'type'        => 'input:color',
                'label'       => 'Button background color',
                'description' => 'Please select color',
                'default' => '#56C1A3',
                'sass' => true
            ],
            'buttonHoverColor'           => [
                'type'        => 'input:color',
                'label'       => 'Button background hover color',
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
            'lineColor'           => [
                'type'        => 'input:color',
                'label'       => 'Timeline color',
                'description' => 'Please select color',
                'default' => '#56c1a3',
                'sass' => true
            ],
            'dotColor'           => [
                'type'        => 'input:color',
                'label'       => 'Dot color',
                'description' => 'Please select color',
                'default' => '#1e2c32',
                'sass' => true
            ],

        ];
    }
}