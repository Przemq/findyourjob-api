<?php
add_action( 'init', 'timeline_categorys', 0 );

function timeline_categorys() {

	$labels = array(
		'name'              => _x( 'TimeLine', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'TimeLine category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search TimeLine', 'textdomain' ),
		'all_items'         => __( 'All TimeLine', 'textdomain' ),
		'parent_item'       => __( 'Parent TimeLine category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent TimeLine category:', 'textdomain' ),
		'edit_item'         => __( 'Edit TimeLine category', 'textdomain' ),
		'update_item'       => __( 'Update TimeLine category', 'textdomain' ),
		'add_new_item'      => __( 'Add New TimeLine category', 'textdomain' ),
		'new_item_name'     => __( 'New TimeLine category Name', 'textdomain' ),
		'menu_name'         => __( 'TimeLine category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'timeline' ),
	);

	register_taxonomy( 'timeline', array( 'post' ), $args );

}