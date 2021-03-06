<?php

/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class WPX_Theme_Options {

	/**
	 * Holds an instance of the object
	 *
	 * @var WPX_Theme_Options
	 */
	protected static $instance = null;
	/**
	 * Option key, and option page slug
	 * @var string
	 */
	protected $key = 'wpx_theme_options';
	/**
	 * Options page metabox id
	 * @var string
	 */
	protected $metabox_id = 'wpx_theme_option_metabox';
	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';
	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	protected function __construct() {
		// Set our title
		$this->title = __( 'EventShares Theme Options', 'wpx_theme' );
	}

	/**
	 * Returns the running object
	 *
	 * @return WPX_Theme_Options
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', [ $this, 'init' ] );
		add_action( 'admin_menu', [ $this, 'add_options_page' ] );
		add_action( 'cmb2_admin_init', [ $this, 'add_options_page_metabox' ] );
	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
//		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, [
//			$this,
//			'admin_page_display'
//		] );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", [ 'CMB2_hookup', 'enqueue_cmb_css' ] );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
        <div class="wrap cmb2-options-page <?php echo $this->key; ?>">
            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
        </div>
		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	public function add_options_page_metabox() {

		$box_options = [
			'id'          => $this->metabox_id,
			'title'       => __( 'EventShares Theme Options', 'cmb2' ),
			'show_names'  => true,
			'object_type' => 'options-page',
			'show_on'     => [
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => [ $this->key, ]
			],
		];

		// Setup meta box
		$cmb = new_cmb2_box( $box_options );

		// setting tabs
		$tabs_setting = [
			'config' => $box_options,
			'layout' => 'vertical', // Default : horizontal
			'tabs'   => []
		];

		$prefix = 'wpx_theme_';

		//SECTION: RIGHT PANEL
		$section = 'panel_';


		//SECTION: Footer
		$section = 'footer_';

		$tabs_setting['tabs'][] = [
			'id'     => 'footer_',
			'title'  => __( 'Footer', 'cmb2' ),
			'fields' => [
				[
					'name'    => 'Small text',
					'id'      => $prefix . $section . 'small_text',
					'type'    => 'wysiwyg',
					'options' => [],
				],
				[
					'name'    => 'Small text size',
					'id'      => $prefix . $section . 'small_text_size',
					'type'    => 'text',
					'default' => '12px',
				],
				[
					'name'    => 'Small text color',
					'id'      => $prefix . $section . 'small_text_color',
					'type'    => 'colorpicker',
					'default' => '#0d374b',
				],
				[
					'name'    => 'Big text',
					'id'      => $prefix . $section . 'big_text',
					'type'    => 'wysiwyg',
					'options' => [],
				],
				[
					'name'    => 'Big text size',
					'id'      => $prefix . $section . 'big_text_size',
					'type'    => 'text',
					'default' => '13px',
				],
				[
					'name'    => 'Big text color',
					'id'      => $prefix . $section . 'big_text_color',
					'type'    => 'colorpicker',
					'default' => '#849199',
				],
				[
					'name'    => 'Link color',
					'id'      => $prefix . $section . 'link_color',
					'type'    => 'colorpicker',
					'default' => '#002841',
				],
				[
					'name'    => 'Link color hover',
					'id'      => $prefix . $section . 'link_color_hover',
					'type'    => 'colorpicker',
					'default' => '#002841',
				],
				[
					'name'    => 'Url for Facebook',
					'id'      => $prefix . $section . 'facebook',
					'type'    => 'text',
					'default' => "#"
				],
				[
					'name'    => 'Url for Twitter',
					'id'      => $prefix . $section . 'twitter',
					'type'    => 'text',
					'default' => "#"
				],
				[
					'name'    => 'Url for Linkedin',
					'id'      => $prefix . $section . 'linkedin',
					'type'    => 'text',
					'default' => "#"
				],
                [
                    'name'    => 'Url for Instagram',
                    'id'      => $prefix . $section . 'instagram',
                    'type'    => 'text',
                    'default' => "#"
                ],
                [
                    'name'    => 'Url for Medium',
                    'id'      => $prefix . $section . 'medium',
                    'type'    => 'text',
                    'default' => "#"
                ],
                [
                    'name'    => 'Url for Seeking Alpha',
                    'id'      => $prefix . $section . 'seeking_alpha',
                    'type'    => 'text',
                    'default' => "#"
                ],
                [
                    'name'    => 'Url for Google Plus',
                    'id'      => $prefix . $section . 'google_plus',
                    'type'    => 'text',
                    'default' => "#"
                ],
                [
                    'name'    => 'Url for StockTwits',
                    'id'      => $prefix . $section . 'stock_twits',
                    'type'    => 'text',
                    'default' => "#"
                ],
                [
                    'name'    => 'Url for YouTube',
                    'id'      => $prefix . $section . 'youtube',
                    'type'    => 'text',
                    'default' => "#"
                ],
				[
					'name'    => 'Icon color',
					'id'      => $prefix . $section . 'icon_color',
					'type'    => 'colorpicker',
					'default' => '#0d374b',
				],
				[
					'name'    => 'Icon color hover',
					'id'      => $prefix . $section . 'icon_color_hover',
					'type'    => 'colorpicker',
					'default' => '#00E5EE',
				],
				[
					'name'    => 'Copyright text',
					'id'      => $prefix . $section . 'copyright_text',
					'type'    => 'wysiwyg',
					'default' => 'COPYRIGHT 2017. ALL RIGHTS RESERVED',
					'options' => [],
				],
				[
					'name'    => 'Copyrights color',
					'id'      => $prefix . $section . 'copyright_color',
					'type'    => 'colorpicker',
					'default' => '#0d374b',
				],
				[
					'name'    => 'Copyrights size',
					'id'      => $prefix . $section . 'copyright_size',
					'type'    => 'text',
					'default' => '13px',
				],
                [
                    'name'    => 'Bottom footer text',
                    'id'      => $prefix . $section . 'bottom_footer_text',
                    'type'    => 'wysiwyg',
                    'options' => [],
                ],
                [
                    'name'    => 'Bottom footer text size',
                    'id'      => $prefix . $section . 'bottom_footer_font_size',
                    'type'    => 'text',
                    'default' => '14px',
                ],
                [
                    'name'    => 'Bottom footer text color',
                    'id'      => $prefix . $section . 'bottom_footer_text_color',
                    'type'    => 'colorpicker',
                    'default' => '#ffffff',
                ],
                [
                    'name'    => 'Bottom footer background color',
                    'id'      => $prefix . $section . 'bottom_footer_background_color',
                    'type'    => 'colorpicker',
                    'default' => '#002841',
                ],
			]
		];

		//SEARCH RESULT PAGE
		$section = 'search_results_';

		$tabs_setting['tabs'][] = [
			'id'     => 'search_results_',
			'title'  => __( 'Search Page Results', 'cmb2' ),
			'fields' => [
				[
					'name'    => 'Search results Text title',
					'id'      => $prefix . $section . 'title',
					'type'    => 'text',
					'default' => "Search results"
				],
				[
					'name'    => 'Search results Title size',
					'id'      => $prefix . $section . 'title_size',
					'type'    => 'text',
					'default' => '54px',
				],
				[
					'name'    => 'Search results Title color',
					'id'      => $prefix . $section . 'title_color',
					'type'    => 'colorpicker',
					'default' => '#FFFFFF',
				],
				[
					'name'        => 'Search results Text for one',
					'id'          => $prefix . $section . 'one',
					'type'        => 'text',
					'description' => "%s is count of found posts",
					'default'     => "There is %s results for"
				],
				[
					'name'        => 'Search results Text for many',
					'id'          => $prefix . $section . 'many',
					'type'        => 'text',
					'description' => "%s is count of found posts",
					'default'     => "There are %s results for"
				],
				[
					'name'    => 'Search results text size',
					'id'      => $prefix . $section . 'text_size',
					'type'    => 'text',
					'default' => '14px',
				],
				[
					'name'    => 'Search results text color',
					'id'      => $prefix . $section . 'text_color',
					'type'    => 'colorpicker',
					'default' => '#FFFFFF',
				],
				[
					'name'    => 'Highlight color',
					'id'      => $prefix . $section . 'highlight',
					'type'    => 'colorpicker',
					'default' => '#56c2a3',
				],
				[
					'name'        => 'Nothing Found Text',
					'id'          => $prefix . $section . 'none',
					'type'        => 'text',
					'description' => "%s is count of found posts",
					'default'     => "No results for %s Please try again using a different keyword."
				],
				[
					'name'    => 'Search Nothing Found text size',
					'id'      => $prefix . $section . 'none_size',
					'type'    => 'text',
					'default' => '1.5rem',
				],
				[
					'name'    => 'Search Nothing Found text color',
					'id'      => $prefix . $section . 'none_color',
					'type'    => 'colorpicker',
					'default' => '#FFFFFF',
				],
				[
					'name'    => 'Background color',
					'id'      => $prefix . $section . 'background_color',
					'type'    => 'colorpicker',
					'default' => '#002841',
				],
				[
					'name'        => 'Background opacity',
					'id'          => $prefix . $section . 'background_opacity',
					'type'        => 'text',
					'description' => "Pick value between 0-1",
					'default'     => 1
				],
				[
					'name'         => 'Background Image (if applicable)',
					'desc'         => 'Set background Image in header',
					'id'           => $prefix . $section . 'background_image',
					'type'         => 'file',
					'preview_size' => [ 100, 100 ],
					'options'      => [
						'url' => false,
					],
					'query_args'   => [ 'type' => 'image' ]
				],

				[
					'name'        => 'Button README :',
					'id'          => $prefix . $section . 'readme',
					'type'        => 'text',
					'description' => "Enter other text for button",
					'default'     => "README"
				],


			]
		];


		//SEARCH
		$section = 'search_';

		$tabs_setting['tabs'][] = [
			'id'     => 'search',
			'title'  => __( 'Search', 'cmb2' ),
			'fields' => [
				[
					'name'    => 'Search Icon Background color',
					'id'      => $prefix . $section . 'background',
					'type'    => 'colorpicker',
					'default' => '#da8b00',
				],
				[
					'name'    => 'Search Icon Background Hover',
					'id'      => $prefix . $section . 'background_hover',
					'type'    => 'colorpicker',
					'default' => '#bf5700',
				],
                [
                    'name'    => 'Search Input Background Color',
                    'id'      => $prefix . $section . 'input_background',
                    'type'    => 'colorpicker',
                    'default' => '#ecebf9',
                ],
			]
		];
//		Navigation
		$section = 'navigation_';

		$tabs_setting['tabs'][] = [
			'id'     => 'navigation',
			'title'  => __( 'Navigation', 'cmb2' ),
			'fields' => [
				[
					'name'    => 'Font family',
					'desc'    => 'Select an option',
					'id'      => $prefix . $section . 'font_family',
					'type'    => 'select',
					'default' => 'Default',
					'options' => array(
						'standard'        => __( '\'Merriweather\', serif', 'cmb2' ),
						'standard_italic' => __( '"Merriweather Italic"', 'cmb2' ),
						'roboto'          => __( '\'Roboto Condensed\', sans-serif', 'cmb2' ),
						'none'            => __( 'Default', 'cmb2' ),
					),
				],
				[
					'name'    => 'Navigation text color',
					'id'      => $prefix . $section . 'menu_text_color',
					'type'    => 'colorpicker',
					'default' => '#000000',
				],
                [
                    'name'    => 'Navigation text color hover',
                    'id'      => $prefix . $section . 'menu_text_color_hover',
                    'type'    => 'colorpicker',
                    'default' => '#002841',
                ],
				[
					'name'    => 'Navigation text color mobile',
					'id'      => $prefix . $section . 'menu_text_color_mobile',
					'type'    => 'colorpicker',
					'default' => '#000000',
				],

				[
					'name'    => 'Navigation mobile search background',
					'id'      => $prefix . $section . 'menu_mobile_search_background',
					'type'    => 'colorpicker',
					'default' => '#55c2a2',
				],
			]
		];

// End of Navigation

// Sign Up user mail
        $section = 'sign_up_mail_';

        $tabs_setting['tabs'][] = [
            'id'     => 'sign_up_mail',
            'title'  => __( 'Sign Up user mail', 'cmb2' ),
            'fields' => [
                [
                    'name'    => 'Admin mail',
                    'id'      => $prefix . $section . 'admin',
                    'type'    => 'text',
                    'default' => '',
                ],
                [
                    'name'    => 'Subject',
                    'id'      => $prefix . $section . 'subject',
                    'type'    => 'text',
                    'default' => '',
                ],
                [
                    'name'    => 'Mail content',
                    'id'      => $prefix . $section . 'mail_content',
                    'type'    => 'wysiwyg',
                    'default' => '',
                ],
            ]
        ];


// End of Sign Up mail

        // Sign Up admin mail
        $section = 'sign_up_admin_';

        $tabs_setting['tabs'][] = [
            'id'     => 'sign_up_admin',
            'title'  => __( 'Sign Up admin mail', 'cmb2' ),
            'fields' => [
                [
                    'name'    => 'Admin mail',
                    'id'      => $prefix . $section . 'admin_mail',
                    'type'    => 'text',
                    'default' => '',
                ],
                [
                    'name'    => 'Subject',
                    'id'      => $prefix . $section . 'subject',
                    'type'    => 'text',
                    'default' => '',
                ],
                [
                    'name'    => 'Mail content',
                    'id'      => $prefix . $section . 'mail_content',
                    'type'    => 'wysiwyg',
                    'default' => '',
                ],
            ]
        ];

// End of Sign Up mail

// Mail for user after using form
        $section = 'user_mail_';

        $tabs_setting['tabs'][] = [
            'id'     => 'user_mail',
            'title'  => __( 'User mail after using form', 'cmb2' ),
            'fields' => [

                [
                    'name'    => 'Subject',
                    'id'      => $prefix . $section . 'subject',
                    'type'    => 'text',
                    'default' => '',
                ],
                [
                    'name'    => 'Mail content',
                    'id'      => $prefix . $section . 'mail_content',
                    'type'    => 'wysiwyg',
                    'default' => '',
                ],

            ]

        ];
// End Mail for user after using form


        $cmb->add_field( [
			'id'   => '__tabs',
			'type' => 'tabs',
			'tabs' => $tabs_setting
		] );

	}
	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 *
	 * @param  int $object_id Option key
	 * @param  array $updated Array of updated fields
	 *
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'wpx_theme' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 *
	 * @param  string $field Field to retrieve
	 *
	 * @return mixed Field value or exception is thrown
	 * @throws Exception
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, [ 'key', 'metabox_id', 'title', 'options_page' ], true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the WPX_Theme_Options object
 * @since  0.1.0
 * @return WPX_Theme_Options object
 */
function wpx_theme_options() {
	return WPX_Theme_Options::get_instance();
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 *
 * @param  string $key Options array key
 * @param  mixed $default Optional default value
 *
 * @return mixed           Option value
 */
function wpx_theme_get_option( $key = '', $default = null ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( wpx_theme_options()->key, $key, $default );
	}

	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( wpx_theme_options()->key, $key, $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}


// Get it started
wpx_theme_options();