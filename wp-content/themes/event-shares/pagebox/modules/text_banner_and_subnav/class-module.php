<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class SubnavAndText extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
            'version' => '1.0.0',
            'title' => 'Text Banner & Subnav',
            'description' => 'Subnav with text banner',
            'js' => [
                'depends' => ['bootstrap']
            ],
        ];
    }

    /**
     * @return array Fields configuration.
     */
    protected function fields()
    {
        return [
            'timeline' => [
                'type' => 'repeater',
                'label' => 'Timeline',
	            'fields' =>[
		            'title' => [
			            'type' => 'input:text',
			            'label' => 'Title',
			            'description' => 'Please enter title'
		            ],
		            'isTab' => [
			            'type'  => 'input:switch',
			            'label' => 'Is Tab?',
			            'default' => 0
		            ],
		            'isPermalinkTitle' => [
			            'type'  => 'input:switch',
			            'label' => 'Use Permalink Link Title',
			            'default' => 1
		            ],
		            'titleURL'       => [
			            'type'    => 'input:text',
			            'label'   => 'Title Url ',
			            'default' => '#'
		            ],
		            'pageLinkTitle'       => [
			            'type'     => 'select',
			            'label'    => 'Select pagelink for title',
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
		            'titleBlank'     => [
			            'type'    => 'input:switch',
			            'label'   => 'Title Url New target',
			            'default' => 0,
		            ],
		            'description' => [
			            'type' => 'editor',
			            'label' => 'Description',
			            'description' => 'Please enter description'
		            ],

		            'button'          => [
			            'type'    => 'input:text',
			            'label'   => 'Button Text',
			            'default' => '',
		            ],
		            'isPermalink' => [
			            'type'  => 'input:switch',
			            'label' => 'Use Permalink Link',
			            'default' => 1
		            ],
		            'buttonUrl'       => [
			            'type'    => 'input:text',
			            'label'   => 'Button Url',
			            'default' => '#'
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
		            'buttonBlank'     => [
			            'type'    => 'input:switch',
			            'label'   => 'Button Url New target',
			            'default' => 1,
		            ],
	            ],

            ],
            'activeTab' => [
	            'type'    => 'input:text',
	            'label'   => 'Active tab number (please enter desired tab number)',
	            'default' => '1',
            ],
            'backgroundColor' => [
	            'type'    => 'input:color',
	            'label'   => 'Background Color',
	            'default' => '#ffffff',
	            'sass'    => true
            ],
            'inactiveTabColor' => [
                'type' => 'input:color',
                'label' => 'Inactive tab color',
                'default' => '#a6a6a6',
                'sass' => true
            ],
            'titleColor' => [
	            'type' => 'input:color',
	            'label' => 'Title color',
	            'default' => '#a6a6a6',
	            'sass' => true
            ],
            'titleColorHover' => [
	            'type' => 'input:color',
	            'label' => 'Title color hover',
	            'default' => '#002841',
	            'sass' => true
            ],
            'titleSize' => [
	            'type' => 'input:text',
	            'label' => 'Title size',
	            'default' => '18px',
	            'sass' => true
            ],
            'descriptionColor' => [
	            'type' => 'input:color',
	            'label' => 'Description color',
	            'default' => '#000000',
	            'sass' => true
            ],
            'descriptionSize' => [
	            'type' => 'input:text',
	            'label' => 'Description size',
	            'default' => '23px',
	            'sass' => true
            ],
        ];
    }

    public function colsTabs()
    {
        $colsize = 'col-lg-2'; //default
        $widthCol = $this->getSection()['width'];

        switch ($widthCol) {
            case 100:
                $colsize = 'col-lg-2';
                break;
            case 75:
                $colsize = 'col-lg-2';
                break;
            case 50:
                $colsize = 'col-12';
                break;
            case 25:
                $colsize = 'col-12';
                break;
        }

        return $colsize;
    }

    public function changeNav()
    {
        $display = 'nav-hidden'; //default
        $widthCol = $this->getSection()['width'];

        switch ($widthCol) {
//            case 100:
//                $display = 'nav-hidden';
//                break;
//            case 75:
//                $display  = 'nav-hidden';
//                break;
            case 50:
                $display = 'nav-show';
                break;
            case 25:
                $display = 'nav-show';
                break;
        }

        return $display;
    }

    public function changeNavTabs()
    {
        $display = 'nav-hidden'; //default
        $widthCol = $this->getSection()['width'];

        switch ($widthCol) {
            case 100:
                $display = 'nav-show big-resolutions';
                break;
            case 75:
                $display = 'nav-show big-resolutions';
                break;
            case 50:
                $display = 'nav-hidden';
                break;
            case 25:
                $display = 'nav-hidden';
                break;
        }

        return $display;
    }

    public function paddingControl()
    {
        $display = ''; //default
        $widthCol = $this->getSection()['width'];

        switch ($widthCol) {
            case 100:
                $display = '';
                break;
            case 75:
                $display = '';
                break;
            case 50:
                $display = 'small-padding';
                break;
            case 25:
                $display = 'small-padding';
                break;
        }
        return $display;
    }
}