<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class GetInTouch extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Get in Touch',
            'description'   => 'Get in touch banner,'
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
		        'label' => 'Enter Text',
		        'description' => 'Please enter title'
	        ],
	        'titleColor' => [
		        'type' => 'input:color',
		        'label' => 'Title color',
		        'default' => '#ffffff',
		        'sass' => true
	        ],
	        'titleSize' => [
		        'type' => 'input:text',
		        'label' => 'Text size',
		        'default' => '30px',
		        'sass' => true
	        ],
	        'buttonUrl'       => [
		        'type'     => 'select',
		        'label'    => 'Choose page to redirect',
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
	        'buttonBlankLink' => [
		        'type'    => 'input:switch',
		        'label'   => 'Link new target:',
		        'default' => 1,
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