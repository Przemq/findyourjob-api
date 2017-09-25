<?php
/**
 * Module class is an extension for Nurture\Pagebox\Module\AbstractModule
 * abstract class. It registers new box into Pagebox plugin.
 */

namespace Nurture\EventShares\Module;

use Nurture\Pagebox\Module\AbstractModule;
use Nurture\Pagebox\Module\Fields\Builder\Select;
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
            'title' => 'Post module',
            'description' => 'Module will show article with share social icons optionally, images or video. For use on like a post',
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
            'headerBackground' => [
                'type' => 'input:color',
                'label' => 'Header background',
                'description' => 'Please, select header background color',
                'default' => '#002841',
                'sass' => true
            ],
            'fullWidthHeader' => [
                'type' => 'input:switch',
                'label' => 'Full width header background? (NO/YES) ',
                'description' => 'Select full width header background or container width',
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
                'default' => '#55c2a2',
                'sass' => true
            ],
            'textFontSize' => [
                'type' => 'input:text',
                'label' => 'Article text font size',
                'description' => 'Please, enter article text font size',
                'default' => '16px',
                'sass' => true
            ],
            'publicationInfoFontColor' => [
                'type' => 'input:color',
                'label' => 'Date and author text color',
                'description' => 'Please, select date and author text color',
                'default' => '#55c2a2',
                'sass' => true
            ],
            'blockquoteFontSize' => [
                'type'    => 'input:text',
                'label'   => 'Font size for blockquote',
                'default' => '21px',
                'sass'    => true
            ],
            'showMedia' => [
                'type' => 'input:switch',
                'label' => 'Show media? (NO/YES) ',
                'description' => 'Enable or disable media in post',
                'default' => true,

            ],
            'typeOfMedia' => [
                'type' => 'select',
                'label' => 'Select type of media',
                'description' => 'Please, select type of media displayed in post',
                'multiple' => false,
                'default' => 'image',
                'options' => [
                    'allowClear' => true,
                ],
                'values'      => [
                    [ 'id' => 'image', 'name' => 'Image' ],
                    [ 'id' => 'video', 'name' => 'Video' ],
                ]
            ],
            'image' => [
                'type' => 'media:image',
                'label' => 'Select image',
                'description' => 'Please, select image'
            ],
            'videoURL' => [
                'type' => 'input:text',
                'label' => 'YouTube video id',
                'description' => 'Please, enter YouTube video id(the last part of video link eg: fLexgOxsZu0)'
            ],
            'backButtonText' => [
                'type' => 'input:text',
                'label' => 'Button text',
                'description' => 'Please, enter button text',
                'default' => 'Back to all entries'
            ],
            'backButtonURL' => [
                'type' => 'input:text',
                'label' => 'Button external URL',
                'description' => 'Please, enter button URL'
            ],
            'internalLink'           => [
                'type'     => 'select',
                'label'    => 'Select internal button URL',
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
            'enableFootnotes' => [
                'type' => 'input:switch',
                'label' => 'Enable footnotes? (NO/YES) ',
                'description' => 'Enable or disable footnotes under post',
                'default' => true,
            ],
            'footnotes'        => [
                'type'   => 'repeater',
                'label'  => 'FOOTNOTES',
                'maxItems' => 15,
                'fields' => [
                    'footnotesText'      => [
                        'type'  => 'editor',
                        'label' => 'Set text for footnotes',
                        'description' => 'Please, enter text for single footnotes'
                    ],
                ],
            ],
            'relatedPostHeader' => [
                'type' => 'input:color',
                'label' => 'Related post header text color',
                'description' => 'Please select related post header text color',
                'default' => '#000000',
                'sass' => true,
            ],
            'relatedPostLinkColor' => [
                'type' => 'input:color',
                'label' => 'Related post link text color',
                'description' => 'Please select related post link text color',
                'default' => '#0275d8',
                'sass' => true,
            ],
            'footNotesHeaderTextColor' => [
                'type' => 'input:color',
                'label' => 'Footnotes header text color',
                'description' => 'Please select footnotes header text color',
                'default' => '#000000',
                'sass' => true,
            ],
            'footNotesTextColor' => [
                'type' => 'input:color',
                'label' => 'Footnotes text color',
                'description' => 'Please select footnotes text color',
                'default' => '#849199',
                'sass' => true,
            ],
            'buttonTextColour' => [
                'type' => 'input:color',
                'label' => 'Button text color',
                'description' => 'Please select button text color',
                'default' => '#0275d8',
                'sass' => true,
            ],
            'footnotesBackgroundColor' => [
                'type' => 'input:color',
                'label' => 'Footnotes background Color',
                'description' => 'Please select footnotes color',
                'default' => '#f4f4f4',
                'sass' => true,
            ],
            'bgcolor' => [
                'type' => 'input:color',
                'label' => 'Background Color',
                'description' => 'Please select background color, default #ffffff',
                'default' => '#ffffff',
                'sass' => true,
            ],
            'postCategory' => [
	            'type' => 'select',
	            'label' => 'Related category',
	            'description' => 'Select related category. If not selected it will take a category from current post',
	            'multiple' => false,
	            'options' => [
		            'allowClear' => true
	            ],
	            'values' => function () {
		            $values = [];
		            $categories = get_categories(['posts_per_page' => -1]);

		            foreach ($categories as $category) {
			            $values[] = [
				            'id' => $category->slug,
				            'name' => $category->name
			            ];
		            }

		            return $values;
	            }
            ],
            'postTag' => [
	            'type' => 'select',
	            'label' => 'Related tag',
	            'description' => 'Select related tag. If not selected it will take a tag from current post',
	            'multiple' => false,
	            'options' => [
		            'allowClear' => true
	            ],
	            'values' => function () {
		            $values = [];
		            $categories = get_tags(['posts_per_page' => -1]);

		            foreach ($categories as $category) {
			            $values[] = [
				            'id' => $category->slug,
				            'name' => $category->name
			            ];
		            }

		            return $values;
	            }
            ],
        ];
    }
}