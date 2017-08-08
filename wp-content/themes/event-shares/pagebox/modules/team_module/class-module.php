<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class TeamModule extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Team Module',
            'description'   => 'Team Module,',
			'js'          => [
	    'depends' => [ 'jquery','bootstrap']
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
	        'title' => [
		        'type' => 'input:text',
		        'label' => 'Title',
		        'description' => 'Please enter title'
	        ],
	        'titleColor' => [
		        'type' => 'input:color',
		        'label' => 'Title color',
		        'default' => '#1E2C32',
		        'sass' => true
	        ],
	        'titleSize' => [
		        'type' => 'input:text',
		        'label' => 'Title size (px)',
		        'default' => '25px',
		        'sass' => true
	        ],
	        'isDescriptionUnderTitleSwitch' =>[
                'type' => 'input:switch',
		        'label' => "Text Under Title (Off/On)",
		        'default' => 0
	        ],
	        'descriptionUnderTitle' =>[
		        'type' => 'editor',
		        'label' => "Enter Text Under Title",
		        'default' => ''
	        ],
	        'descriptionUnderTitleColor' => [
		        'type'    => 'input:color',
		        'label'   => 'Description under title color',
		        'default' => '#000',
		        'sass'    => true
	        ],
	        'descriptionUnderTitleSize'  => [
		        'type'    => 'input:text',
		        'label'   => 'Description under title  size (px)',
		        'default' => '14px',
		        'sass'    => true
	        ],
	        'tabs' =>[
		        'type' => 'repeater',
		        'label' => "Team Member",
		        'maxItems' => 20,
		        'fields' => [
			        'teamTitle'      => [
				        'type'        => 'input:text',
				        'label'       => 'Title',
				        'description' => 'Please enter team Name'
			        ],
			        'jobTitle'      => [
				        'type'        => 'input:text',
				        'label'       => 'Job Title',
				        'description' => 'Please enter Job Title'
			        ],
                    'imageSwitch' =>[
                        'type' => 'input:switch',
                        'label'   => "Enable member photo",
                        'description' => 'Eneable or disable photo (OFF/ON)',
                        'default' => false
                    ],
                    'image' =>[
                        'type' => 'media:image',
                        'label'   => "Team member photo",
                        'description' => 'Please, select photo',
                        'default' => ''
                    ],
			        'quote' =>[
				        'type' => 'editor',
				        'label' => "Enter Quote",
				        'default' => ''
			        ],
			        'leftDescriptionPanel' =>[
				        'type' => 'editor',
				        'label'   => "Left Description Panel",
				        'default' => ''
			        ],
			        'rightDescriptionPanel' =>[
				        'type' => 'editor',
				        'label'   => "Right Description Panel",
				        'default' => ''
			        ],

		        ]
	        ],
	        'teamTitleColor' => [
		        'type'    => 'input:color',
		        'label'   => 'Team text name color',
		        'default' => '#002841',
		        'sass'    => true
	        ],
	        'teamTitleSize'  => [
		        'type'    => 'input:text',
		        'label'   => 'Team name font size (px)',
		        'default' => '18px',
		        'sass'    => true
	        ],
	        'jobTitleColor' => [
		        'type'    => 'input:color',
		        'label'   => 'Job Title color',
		        'default' => '#000',
		        'sass'    => true
	        ],
	        'jobTitleSize'  => [
		        'type'    => 'input:text',
		        'label'   => 'Job Title size (px)',
		        'default' => '14px',
		        'sass'    => true
	        ],

	        'quoteColor' => [
		        'type'    => 'input:color',
		        'label'   => 'Quote color',
		        'default' => '#56c2a3',
		        'sass'    => true
	        ],
	        'quoteSize'  => [
		        'type'    => 'input:text',
		        'label'   => 'Quote size (px)',
		        'default' => '18px',
		        'sass'    => true
	        ],
	        'innerDescriptionColor' => [
		        'type'    => 'input:color',
		        'label'   => 'Team inner description color',
		        'default' => '#fff',
		        'sass'    => true
	        ],
	        'innerDescriptionSize'  => [
		        'type'    => 'input:text',
		        'label'   => 'Team inner description (px)',
		        'default' => '14px',
		        'sass'    => true
	        ],

	        'tabBackgroundColor' => [
		        'type' => 'input:color',
		        'label' => 'Tab background color',
		        'default' => '#002841',
		        'sass' => true
	        ],
	        'backgroundColor' => [
                'type' => 'input:color',
                'label' => 'Background color',
                'default' => '#ffffff',
                'sass' => true
            ],
        ];
    }
}
