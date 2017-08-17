<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\View\StaticCacheInterface;

class ArticleText extends AbstractModule implements StaticCacheInterface
{

    /**
     * Module config
     * @return array Module configuration.
     */
    protected function config()
    {
        return [
            'version' => '1.0.0',
            'title' => 'Article Text',
            'description' => 'Module will show article with share social icons optionally. For use on like a a post',
            'js'          => [
                'depends' => [ 'jquery','aos.js', 'bootstrap' ]
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
            'showPostData' => [
                'type' => 'input:switch',
                'label' => 'Show post data?',
                'description' => 'Show post title/ data/author',
                'default' => true,
            ],
            'showPublicationInfo' => [
                'type' => 'input:switch',
                'label' => 'Show Publication info?',
                'description' => 'Show date/ author?',
                'default' => true,
            ],
            'switchMedia' => [
                'type' => 'input:switch',
                'label' => 'Show Button with Social Media icons? (NO/YES) ',
                'description' => 'This button will be at top of the module',
                'default' => true,
            ],
            'articleText' => [
                'type' => 'editor',
                'label' => 'Article text ',
            ],
            'titleFontSize' => [
                'type' => 'input:text',
                'label' => 'Title font size',
                'description' => 'Please, enter title font size',
                'default' => '44px',
                'sass' => true
            ],
            'titleFontColor' => [
                'type' => 'input:color',
                'label' => 'Title font color',
                'description' => 'Please, select title color',
                'default' => '#1e2c32',
                'sass' => true
            ],
            'textFontSize' => [
                'type' => 'input:text',
                'label' => 'Article text font size',
                'description' => 'Please, enter article text font size',
                'default' => '16px',
                'sass' => true
            ],
            'blockquoteFontSize' => [
                'type'    => 'input:text',
                'label'   => 'Font size for blockquote',
                'default' => '21px',
                'sass'    => true
            ],
            'showImage' => [
                'type' => 'input:switch',
                'label' => 'Show image? (NO/YES) ',
                'description' => 'Enable or disable image',
                'default' => false,
            ],
            'image' => [
                'type' => 'media:image',
                'label' => 'Select image',
                'description' => 'Please, select image'
            ],
            'bgcolor' => [
                'type' => 'input:color',
                'label' => 'Background Color',
                'description' => 'Please select background color, default #ffffff',
                'default' => '#ffffff',
                'sass' => true,
            ],
        ];
    }
}