<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;
use Nurture\Pagebox\Module\Fields\Builder\Select;

class LogosModuleNew extends AbstractModule implements StaticCacheInterface
{

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
            'version' => '1.0.0',
            'title' => 'Logos module new Design',
            'description' => 'Logos module with slider',
            'js' => [
                'depends' => ['slick']
            ],
            'css'         => [
                'depends' => ['slick']
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
            'buttonSwitch' => [
                'type' => 'input:switch',
                'label' => 'Button (OFF/ON)',
                'default' => 1
            ],
            'buttonText' => [
                'type' => 'input:text',
                'label' => 'Button text',
                'description' => 'Please enter button text'
            ],
            'internalUrl' => [
                'type' => 'select',
                'label' => 'Select button link',
                'description' => 'Select internal button link',
                'multiple' => false,
                'options' => [
                    'allowClear' => true,
                ],
                'values' => function () {
                    return Select::postFilter(get_posts(['post_type' => array('post', 'page'), 'posts_per_page' => -1]), [
                        'postID' => function (\WP_Post $post) {
                            return $post->ID;
                        },
                        'permalink' => function (\WP_Post $post) {
                            return get_permalink($post->ID);
                        }
                    ]);
                }
            ],
            'externalURL' => [
                'type' => 'input:text',
                'label' => 'External button URL',
                'description' => 'Please enter external URL (working if internal URL is empty)'
            ],
            'buttonColor' => [
                'type' => 'input:color',
                'label' => 'Button color',
                'default' => '#ffffff',
                'sass' => true
            ],
            'buttonTextSize' => [
                'type' => 'input:text',
                'label' => 'Button text size',
                'default' => '16px',
                'sass' => true
            ],
            'buttonHoverColor' => [
                'type' => 'input:color',
                'label' => 'Button hover color',
                'default' => '#45B092',
                'sass' => true
            ],
            'background' => [
                'type' => 'input:color',
                'label' => 'Background color',
                'default' => '#56C1A3',
                'sass' => true
            ],
            'logos' => [
                'type' => 'repeater',
                'label' => 'Logos',
                'maxItems' => 25,
                'fields' => [
                    'enableInternalLink' => [
                        'type' => 'input:switch',
                        'label' => 'Use internal link',
                        'default' => true
                    ],
                    'internalUrl' => [
                        'type' => 'select',
                        'label' => 'Select link',
                        'description' => 'Select article',
                        'multiple' => false,
                        'options' => [
                            'allowClear' => true,
                        ],
                        'values' => function () {
                            return Select::postFilter(get_posts(['post_type' => array('post', 'page'), 'posts_per_page' => -1]), [
                                'postID' => function (\WP_Post $post) {
                                    return $post->ID;
                                },
                                'permalink' => function (\WP_Post $post) {
                                    return get_permalink($post->ID);
                                }
                            ]);
                        }
                    ],
                    'logoUrl' => [
                        'type' => 'input:text',
                        'label' => 'Set logo url',
                        'default' => '#'
                    ],
                    'logoBlank' => [
                        'type' => 'input:switch',
                        'label' => 'New Target Blank',
                        'default' => 1
                    ],
                    'logoImage' => [
                        'type' => 'media:image',
                        'label' => 'Set image for logo',
                        'multiple' => false,
                        'unique' => false,
                        'aspectRatio' => '16:9',
                    ],
                ]
            ],
        ];
    }
}