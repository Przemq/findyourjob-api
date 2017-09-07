<?php
add_action( 'cmb2_admin_init', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_event_shares_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'post_settings',
        'title'         => __( 'Post setting', 'cmb2' ),
        'object_types'  => array( 'post', ), // Post type
        'context'       => 'normal',
        'priority'      => 'low',
        'show_names'    => true,
    ) );


    $cmb->add_field( array(
        'name'       => __( 'Button text', 'cmb2' ),
        'desc'       => __( 'Please enter post button text', 'cmb2' ),
        'id'         => $prefix . 'button_text',
        'type'       => 'text',
        'default' => 'READ NOW'
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Author', 'cmb2' ),
        'desc'       => __( 'Please enter author name', 'cmb2' ),
        'id'         => $prefix . 'author',
        'type'       => 'text',
        'default' => ''
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Post URL', 'cmb2' ),
        'desc'       => __( 'Please enter post URL', 'cmb2' ),
        'id'         => $prefix . 'link',
        'type'       => 'text_url',
        'default' => ''
    ) );

    $cmb->add_field( array(
        'name' => 'Show post date?',
        'desc' => 'Enable or disable post date visibility',
        'id'   =>  $prefix .'enable_date',
        'type' => 'checkbox',
    ) );
    $cmb->add_field( array(
        'name'             => 'Select date format',
        'desc'             => 'Please, select format of date',
        'id'               => $prefix .'date_format',
        'type'             => 'select',
        'default'          => 'us',
        'options'          => array(
            'us' => __( 'US: MM.DD.YYYY', 'cmb2' ),
            'uk'   => __( 'UK: DD.MM.YYYY', 'cmb2' ),
        ),
    ) );

}


add_action( 'init', 'create_documents_type', 1 );
function create_documents_type() {
    register_post_type( 'documents',
        array(
            'labels'              => array(
                'name'          => __( 'Documents' ),
                'singular_name' => __( 'Document' )
            ),
            'taxonomies'          => array('documents'),
            'public'              => true,
            'has_archive'         => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'supports'            => array( 'title', 'thumbnail' )
        )
    );
}



add_action( 'cmb2_init', 'cmb2_documents_metabox' );
function cmb2_documents_metabox()
{
    $prefix = '_cmb2_';

    $cmb = new_cmb2_box(array(
        'title' => 'Documents',
        'id' => $prefix . 'post_meta_documents',
        'object_types' => array('documents'),
    ));

    $cmb->add_field(array(
        'name' => 'PDF file',
        'id' => $prefix . 'document',
        'type' => 'file',
        'desc' => '',
    ));
}
