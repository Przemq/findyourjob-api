<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;
use Nurture\Pagebox\Module\Fields\Builder\Select;

class MenuAboutFlyout extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Menu links About flyout',
            'description'   => 'Menu links module'
        ];
    }

    /**
     * @return array Fields configuration.
     */
    protected function fields()
    {
	    return [
		    'title'         => [
			    'type' => 'input:text',
			    'label' => 'Set title '
		    ],
		    'isPermalink' => [
			    'type'  => 'input:switch',
			    'label' => 'Use Permalink Link',
			    'default' => 1
		    ],
		    'isBlank' => [
			    'type'  => 'input:switch',
			    'label' => 'Link new target',
			    'default' => 1
		    ],
		    'permalink'     => [
			    'type'  => 'input:text',
			    'label' => 'Set link'
		    ],
		    'pageLink'       => [
			    'type'     => 'select',
			    'label'    => 'Select pagelink for button',
			    'multiple' => false,
			    'options'  => [
				    'allowClear' => true
			    ],
			    'values'   => function () {
				    return Select::postFilter( get_pages( [ 'posts_per_page' => - 1 ] ), [
					    'postID'    => function ( \WP_Post $post ) {
						    return $post->ID;
					    },
					    'permalink' => function ( \WP_Post $post ) {
						    return get_permalink( $post->ID );
					    }
				    ] );
			    }
		    ],
		    // Repeater
		    'boxes'         => [
			    'type' => 'repeater',
			    'label' => 'Boxes',
			    'fields' => [
				    'title'      => [
					    'type'        => 'input:text',
					    'label'       => 'Add title',
				    ],
				    'description'      => [
					    'type'        => 'editor',
					    'label'       => 'Set Description',
				    ],
				    'buttonText'      => [
					    'type'        => 'input:text',
					    'label'       => 'Add button text',
				    ],
				    'permalink'     => [
					    'type'  => 'input:text',
					    'label' => 'Set link'
				    ]
			    ],
		    ],


		    'isImage' => [
			    'type'  => 'input:switch',
			    'label' => 'Image instead background',
			    'default' => 0,
			    'sass' => true
		    ],
		    'backgroundImage'        => [
			    'type'        => 'media:image',
			    'label'       => 'Set image for logo',
			    'multiple'    => false,
			    'unique'      => false,
			    'aspectRatio' => '16:9',
		    ],
		    'background' =>[
			    'type' => 'input:color',
			    'label' => 'Background color',
			    'default' => '#ffffff',
			    'sass' => true
		    ],
		    'backgroundOpacity' =>[
			    'type' => 'input:text',
			    'label' => 'Background Opacity (0-1)',
			    'default' => '0.9',
			    'sass' => true
		    ],

		    'boxTitleColor' =>[
			    'type' => 'input:color',
			    'label' => 'Box Title color',
			    'default' => '#002841',
			    'sass' => true
		    ],

		    'boxDescriptionColor' =>[
			    'type' => 'input:color',
			    'label' => 'Box description color',
			    'default' => '#292b2c',
			    'sass' => true
		    ],

		    'boxButtonColor' =>[
			    'type' => 'input:color',
			    'label' => 'Box Button color',
			    'default' => '#56c1a3',
			    'sass' => true
		    ],
		    'boxButtonColorHover' =>[
			    'type' => 'input:color',
			    'label' => 'Box Button color hover',
			    'default' => '#014c8c',
			    'sass' => true
		    ],

		    'boxTitleSize' =>[
			    'type' => 'input:text',
			    'label' => 'Box Title size (px)',
			    'default' => '18px',
			    'sass' => true
		    ],

		    'boxDescriptionSize' =>[
			    'type' => 'input:text',
			    'label' => 'Box description size (px)',
			    'default' => '14px',
			    'sass' => true
		    ],

		    'boxButtonSize' =>[
			    'type' => 'input:text',
			    'label' => 'Box Button size',
			    'default' => '14px',
			    'sass' => true
		    ],
	    ];

    }

	public function isActive($linkUrl){
		global $wp;
		$current_url =home_url(add_query_arg(array(),$wp->request)).'/';
		if ($linkUrl === $current_url){
			return " current-menu-item";
		}
		return "";
	}
}