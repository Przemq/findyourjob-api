<?php
/*
 * Example metabox
 */
add_filter( 'cmb2_init', 'example_tabs_metaboxes' );
function example_tabs_metaboxes() {
	$box_options = [
		'id'           => 'example_tabs_metaboxes',
		'title'        => __( 'Example tabs', 'cmb2' ),
		'object_types' => [ 'page' ],
		'show_names'   => true,
	];

	// Setup meta box
	$cmb = new_cmb2_box( $box_options );

	// setting tabs
	$tabs_setting           = [
		'config' => $box_options,
		//		'layout' => 'vertical', // Default : horizontal
		'tabs'   => []
	];
	$tabs_setting['tabs'][] = [
		'id'     => 'tab1',
		'title'  => __( 'Tab 1', 'cmb2' ),
		'fields' => [
			[
				'name' => __( 'Title', 'cmb2' ),
				'id'   => 'header_title',
				'type' => 'text'
			],
			[
				'name' => __( 'Subtitle', 'cmb2' ),
				'id'   => 'header_subtitle',
				'type' => 'text'
			],
			[
				'name'    => __( 'Background image', 'cmb2' ),
				'id'      => 'header_background',
				'type'    => 'file',
				'options' => [
					'url' => false
				]
			]
		]
	];
	$tabs_setting['tabs'][] = [
		'id'     => 'tab2',
		'title'  => __( 'Tab 2', 'cmb2' ),
		'fields' => [
			[
				'name' => __( 'Title', 'cmb2' ),
				'id'   => 'review_title',
				'type' => 'text'
			],
			[
				'name' => __( 'Subtitle', 'cmb2' ),
				'id'   => 'review_subtitle',
				'type' => 'text'
			],
			[
				'id'      => 'reviews',
				'type'    => 'group',
				'options' => [
					'group_title'   => __( 'Review {#}', 'cmb2' ),
					'add_button'    => __( 'Add review', 'cmb2' ),
					'remove_button' => __( 'Remove review', 'cmb2' ),
					'sortable'      => false
				],
				'fields'  => [
					[
						'name' => __( 'Author name', 'cmb2' ),
						'id'   => 'name',
						'type' => 'text'
					],
					[
						'name'    => __( 'Author avatar', 'cmb2' ),
						'id'      => 'avatar',
						'type'    => 'file',
						'options' => [
							'url' => false
						]
					],
					[
						'name' => __( 'Comment', 'cmb2' ),
						'id'   => 'comment',
						'type' => 'textarea'
					]
				]
			]
		]
	];

	// set tabs
	$cmb->add_field( [
		'id'   => '__tabs',
		'type' => 'tabs',
		'tabs' => $tabs_setting
	] );
}

/*
 * Example options page
 */
add_action( 'cmb2_admin_init', 'example_options_page_metabox' );
function example_options_page_metabox() {
	$box_options = [
		'id'          => 'myprefix_option_metabox',
		'title'       => __( 'Example tabs', 'cmb2' ),
		'show_names'  => true,
		'object_type' => 'options-page',
		'show_on'     => [
			// These are important, don't remove
			'key'   => 'options-page',
			'value' => [ 'myprefix_options' ]
		],
	];

	// Setup meta box
	$cmb = new_cmb2_box( $box_options );

	// setting tabs
	$tabs_setting = [
		'config' => $box_options,
		//		'layout' => 'vertical', // Default : horizontal
		'tabs'   => []
	];

	$tabs_setting['tabs'][] = [
		'id'     => 'tab1',
		'title'  => __( 'Tab 1', 'cmb2' ),
		'fields' => [
			[
				'name' => __( 'Title', 'cmb2' ),
				'id'   => 'header_title',
				'type' => 'text'
			],
			[
				'name' => __( 'Subtitle', 'cmb2' ),
				'id'   => 'header_subtitle',
				'type' => 'text'
			],
			[
				'name'    => __( 'Background image', 'cmb2' ),
				'id'      => 'header_background',
				'type'    => 'file',
				'options' => [
					'url' => false
				]
			]
		]
	];
	$tabs_setting['tabs'][] = [
		'id'     => 'tab2',
		'title'  => __( 'Tab 2', 'cmb2' ),
		'fields' => [
			[
				'name' => __( 'Title', 'cmb2' ),
				'id'   => 'review_title',
				'type' => 'text'
			],
			[
				'name' => __( 'Subtitle', 'cmb2' ),
				'id'   => 'review_subtitle',
				'type' => 'text'
			],
			[
				'id'      => 'reviews',
				'type'    => 'group',
				'options' => [
					'group_title'   => __( 'Review {#}', 'cmb2' ),
					'add_button'    => __( 'Add review', 'cmb2' ),
					'remove_button' => __( 'Remove review', 'cmb2' ),
					'sortable'      => false
				],
				'fields'  => [
					[
						'name' => __( 'Author name', 'cmb2' ),
						'id'   => 'name',
						'type' => 'text'
					],
					[
						'name'    => __( 'Author avatar', 'cmb2' ),
						'id'      => 'avatar',
						'type'    => 'file',
						'options' => [
							'url' => false
						]
					],
					[
						'name' => __( 'Comment', 'cmb2' ),
						'id'   => 'comment',
						'type' => 'textarea'
					]
				]
			]
		]
	];

	$cmb->add_field( [
		'id'   => '__tabs',
		'type' => 'tabs',
		'tabs' => $tabs_setting
	] );
}