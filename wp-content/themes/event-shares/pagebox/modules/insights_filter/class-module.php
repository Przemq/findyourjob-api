<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class InsightsFilters extends AbstractModule implements StaticCacheInterface {

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
        	'version'       => '1.0.0',
            'title'         => 'Insights Filters',
            'description'   => 'Filters for articles and pages',
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
            'title' => [
                'type' => 'input:text',
                'label' => 'title'
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