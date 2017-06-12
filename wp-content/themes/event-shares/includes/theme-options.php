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
		$this->title = __( 'WPX Theme Options', 'wpx_theme' );
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
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, [
			$this,
			'admin_page_display'
		] );

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
	function add_options_page_metabox() {

		$box_options = [
			'id'          => $this->metabox_id,
			'title'       => __( 'Example tabs', 'cmb2' ),
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

//		$tabs_setting['tabs'][] = [
//			'id'     => 'right-panel',
//			'title'  => __( 'Right Panel', 'cmb2' ),
//			'fields' => [
//				[
//					'name'         => 'First Icon',
//					'desc'         => 'Set first icon on Right Panel',
//					'id'           => $prefix . $section . 'icon',
//					'type'         => 'file',
//					'preview_size' => [ 100, 100 ],
//					'options'      => [
//						'url' => false,
//					],
//					'query_args'   => [ 'type' => 'image' ]
//				],
//				[
//					'name'         => 'Second Icon',
//					'desc'         => 'Set second icon on Right Panel',
//					'id'           => $prefix . $section . 'icon2',
//					'type'         => 'file',
//					'preview_size' => [ 100, 100 ],
//					'options'      => [
//						'url' => false,
//					],
//					'query_args'   => [ 'type' => 'image' ]
//				],
//				[
//					'name'         => 'Third Icon',
//					'desc'         => 'Set second icon on Right Panel',
//					'id'           => $prefix . $section . 'icon3',
//					'type'         => 'file',
//					'preview_size' => [ 100, 100 ],
//					'options'      => [
//						'url' => false,
//					],
//					'query_args'   => [ 'type' => 'image' ]
//				],
//				[
//					'name'    => 'Buttons Background',
//					'id'      => $prefix . $section . 'icons_bg',
//					'type'    => 'colorpicker',
//					'default' => '#d98c28',
//				],
//				[
//					'name'    => 'Buttons Background Hover',
//					'id'      => $prefix . $section . 'icons_bg_hover',
//					'type'    => 'colorpicker',
//					'default' => '#bf5700',
//				]
//			]
//		];

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
					'name' => 'Url for Facebook',
					'id'   => $prefix . $section . 'facebook',
					'type' => 'text',
                    'default' => "#"
				],
				[
					'name' => 'Url for Twitter',
					'id'   => $prefix . $section . 'twitter',
					'type' => 'text',
					'default' => "#"
				],
				[
					'name' => 'Url for Linkedin',
					'id'   => $prefix . $section . 'linkedin',
					'type' => 'text',
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
			]
		];

//		//FORMS
//		$section = 'form_';
//
//		$tabs_setting['tabs'][] = [
//			'id'     => 'form',
//			'title'  => __( 'Forms', 'cmb2' ),
//			'fields' => [
//				[
//					'name' => 'Shortcode: Contact Us',
//					'id'   => $prefix . $section . 'shortcode',
//					'type' => 'text'
//				],
//				[
//					'name' => 'Shortcode: Request Information',
//					'id'   => $prefix . $section . 'shortcode2',
//					'type' => 'text'
//				],
//			]
//		];
//
//		//REGISTER
//		$section = 'register_';
//
//		$tabs_setting['tabs'][] = [
//			'id'     => 'register',
//			'title'  => __( 'Register', 'cmb2' ),
//			'fields' => [
//				[
//					'id'      => $prefix . $section . 'emails',
//					'type'    => 'group',
//					'options' => [
//						'group_title'   => __( 'Email {#}', 'cmb2' ),
//						'add_button'    => __( 'Add email', 'cmb2' ),
//						'remove_button' => __( 'Remove email', 'cmb2' ),
//						'sortable'      => false
//					],
//					'fields'  => [
//						[
//							'name' => 'Email for new user pending notification',
//							'id'   => $prefix . $section . 'email',
//							'type' => 'text'
//						],
//					]
//				],
//				[
//					'name' => 'Email body',
//					'id'   => $prefix . $section . 'body',
//					'type' => 'wysiwyg'
//				],
//			],
//
//		];

		//SEARCH
		$section = 'search_';

		$tabs_setting['tabs'][] = [
			'id'     => 'search',
			'title'  => __( 'Search', 'cmb2' ),
			'fields' => [
				[
					'name'    => 'Search Background color',
					'id'      => $prefix . $section . 'background',
					'type'    => 'colorpicker',
					'default' => '#da8b00',
				],
				[
					'name'    => 'Search Background Hover',
					'id'      => $prefix . $section . 'background_hover',
					'type'    => 'colorpicker',
					'default' => '#bf5700',
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
			]
		];

// End of Navigation
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