<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;
use Nurture\Pagebox\Module\Fields\Builder\Select;

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
	        'titleSwitch' => [
		        'type'        => 'input:switch',
		        'label'       => 'Title Off/On',
		        'default' => 1
	        ],

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
	        'titleSize' => [
		        'type' => 'input:text',
		        'label' => 'Title size',
		        'default' => '1.5rem',
		        'sass' => true
	        ],
	        'background' => [
		        'type' => 'input:color',
		        'label' => 'Background color',
		        'default' => '#ffffff',
		        'sass' => true
	        ],
            'logosOpacity' => [
                'type' => 'input:text',
                'label' => 'Image opacity',
                'default' => '1.0',
                'description' => 'Set opacity value(0 - 1)',
                'sass' => true
            ],
            'logosHoverOpacity' => [
                'type' => 'input:text',
                'label' => 'Image hover opacity',
                'default' => '0.5',
                'description' => 'Set hover opacity value(0 - 1)',
                'sass' => true
            ],
            'imageGreyScale' => [
                'type' => 'input:text',
                'label' => 'Image grey scale',
                'default' => '0%',
                'description' => 'Set opacity value(0 - 100%)',
                'sass' => true
            ],
	        'logos' => [
		        'type' => 'repeater',
		        'label' => 'Logos',
		        'fields' => [
                    'enableInternalLink'        => [
                        'type'        => 'input:switch',
                        'label'       => 'Use internal link',
                        'default' => true
                    ],
                    'internalUrl'   => [
                        'type'        => 'select',
                        'label'       => 'Select link',
                        'description' => 'Select article',
                        'multiple'    => false,
                        'options' => [
                            'allowClear' => true,
                        ],
                        'values' => function () {
                            return Select::postFilter(get_posts(['post_type'=>array('post','page'),  'posts_per_page' => - 1 ]), [
                                'postID' => function (\WP_Post $post) {
                                    return $post->ID;
                                },
                                'permalink' => function (\WP_Post $post) {
                                    return get_permalink($post->ID);
                                }
                            ]);
                        }
                    ],
			        'logoUrl'        => [
				        'type'        => 'input:text',
				        'label'       => 'Set logo url',
				        'default' => '#'
			        ],
			        'logoBlank'        => [
				        'type'        => 'input:switch',
				        'label'       => 'New Target Blank',
						'default' => 1
			        ],
			        'logoImage'        => [
				        'type'        => 'media:image',
				        'label'       => 'Set image for logo',
				        'multiple'    => false,
				        'unique'      => false,
				        'aspectRatio' => '16:9',
			        ],
		        ]
	        ],
        ];
    }
}