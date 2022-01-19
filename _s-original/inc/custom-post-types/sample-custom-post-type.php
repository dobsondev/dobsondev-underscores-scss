<?php

/**
 * Add custom post type
 *
 * Additional custom post information can be defined here
 * https://codex.wordpress.org/Post_Types
 */
function _sSs_create_sample_custom_post_type() {
  $labels = array(
    'name'                  => _x( 'Sample Custom Posts', 'Post Type General Name', '_sSs_text_domain' ),
    'singular_name'         => _x( 'Sample Post', 'Post Type Singular Name', '_sSs_text_domain' ),
    'menu_name'             => __( 'Sample Custom Posts', '_sSs_text_domain' ),
    'name_admin_bar'        => __( 'Sample Post', '_sSs_text_domain' ),
    'archives'              => __( 'Sample Custom Posts Archives', '_sSs_text_domain' ),
    'attributes'            => __( 'Sample Custom Posts Attributes', '_sSs_text_domain' ),
    'all_items'             => __( 'All Sample Custom Posts', '_sSs_text_domain' ),
    'add_new_item'          => __( 'Add New Sample Post', '_sSs_text_domain' ),
    'add_new'               => __( 'Add New', '_sSs_text_domain' ),
    'new_item'              => __( 'New Sample Post', '_sSs_text_domain' ),
    'edit_item'             => __( 'Edit Sample Post', '_sSs_text_domain' ),
    'update_item'           => __( 'Update Sample Post', '_sSs_text_domain' ),
    'view_item'             => __( 'View Sample Post', '_sSs_text_domain' ),
    'view_items'            => __( 'View Sample Custom Posts', '_sSs_text_domain' ),
    'search_items'          => __( 'Search Sample Custom Posts', '_sSs_text_domain' ),
    'not_found'             => __( 'Not found', '_sSs_text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', '_sSs_text_domain' ),
    'featured_image'        => __( 'Featured Image', '_sSs_text_domain' ),
    'set_featured_image'    => __( 'Set Featured Image', '_sSs_text_domain' ),
    'remove_featured_image' => __( 'Remove Featured Image', '_sSs_text_domain' ),
    'use_featured_image'    => __( 'Use as Featured Image', '_sSs_text_domain' ),
    'insert_into_item'      => __( 'Insert into Sample Post', '_sSs_text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Sample Post', '_sSs_text_domain' ),
    'items_list'            => __( 'Sample Custom Posts List', '_sSs_text_domain' ),
    'items_list_navigation' => __( 'Sample Custom Posts List navigation', '_sSs_text_domain' ),
    'filter_items_list'     => __( 'Filter Sample Custom Posts List', '_sSs_text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Sample Posts', '_sSs_text_domain' ),
    'description'           => __( 'Sample Posts for your theme development.', '_sSs_text_domain' ),
    'labels'                => $labels,
    'supports'              => false,
    'taxonomies'            => array( 'sample_types' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 20.999,
    'menu_icon'             => 'dashicons-store',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite'               => array( 'slug' => 'sample-slug' ),
    'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
  );
  register_post_type( '_sSs_sample', $args );
}
add_action( 'init', '_sSs_create_sample_custom_post_type', 0 );

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies information can be found here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function _sSs_sample_post_types_custom_taxonomy() {
  register_taxonomy( 'sample_types', '_sSs_sample', array(
    // hierarchical taxonomy (like categories)
    'hierarchical' => TRUE,
    // this array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Sample Types', 'taxonomy general name' ),
      'singular_name' => _x( 'Sample Type', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Sample Types' ),
      'all_items' => __( 'All Sample Types' ),
      'parent_item' => __( 'Parent Sample Type' ),
      'parent_item_colon' => __( 'Parent Sample Type:' ),
      'edit_item' => __( 'Edit Sample Type' ),
      'update_item' => __( 'Update Sample Type' ),
      'add_new_item' => __( 'Add New Sample Type' ),
      'new_item_name' => __( 'New Sample Type Name' ),
      'menu_name' => __( 'Sample Types' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'sample-post-types', // This controls the base slug that will display before each term
      'with_front' => FALSE, // Don't display the category base before "/locations/"
      'hierarchical' => TRUE // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));
}
add_action( 'init', '_sSs_trailer_typ_sSs_sample_post_types_custom_taxonomys_custom_taxonomy', 0 );
