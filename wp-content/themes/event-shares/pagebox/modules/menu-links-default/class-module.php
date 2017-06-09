<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;
use Nurture\Pagebox\Module\Fields\Builder\Select;

class MenuLinksDefault extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Menu links Default',
            'description'   => 'Menu links module default'
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