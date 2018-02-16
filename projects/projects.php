<?php
/*
Plugin Name: Simple Projects Management
Version: 2.0
Description: Projects management and listing
Text Domain: projects
Author: František Zatloukal
Author URI: http://frantisek.zatloukalu.eu
Plugin URI: http://research.redhat.com
License: GNU GPL2
*/

function projects_plugin_init() {
  load_plugin_textdomain( 'projects', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action('plugins_loaded', 'projects_plugin_init');

// CPT and taxonomies
function va_create_cpt_and_taxos() {

  // Taxonomies
  register_taxonomy('project_status', 'projects', array('label' => __('Project status')));
  register_taxonomy('project_place', 'projects', array('label' => __('Project place')));
  register_taxonomy('project_tags', 'projects', array('label' => __('Project tags')));
  register_taxonomy('project_category', 'projects', array('label' => __('Project category'))); #This is used for filters on front page
  register_taxonomy('project_not_full', 'projects', array('label' => __('Is Project accepting new applicants?'), 'meta_box_cb' => 'post_categories_meta_box', 'hierarchical' => true));

	$labels = array(
    'name'                => _x( 'projects', 'Post Type General Name', 'va_domain' ),
    'singular_name'       => _x( 'project', 'Post Type Singular Name', 'va_domain' ),
    'menu_name'           => __( 'Projects', 'va_domain' ),
    'name_admin_bar'      => __( 'Projects', 'va_domain' ),
    'parent_item_colon'   => __( 'Parent Project:', 'va_domain' ),
    'all_items'           => __( 'All Projects', 'va_domain' ),
    'add_new_item'        => __( 'Add New Project', 'va_domain' ),
    'add_new'             => __( 'Add New', 'va_domain' ),
    'new_item'            => __( 'New Project', 'va_domain' ),
    'edit_item'           => __( 'Edit Project', 'va_domain' ),
    'update_item'         => __( 'Update Project', 'va_domain' ),
    'view_item'           => __( 'View Project', 'va_domain' ),
    'search_items'        => __( 'Search Project', 'va_domain' ),
    'not_found'           => __( 'Not found', 'va_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'va_domain' ),
	);
	$args = array(
		'label'               => __( 'project', 'va_domain' ),
		'description'         => __( 'Post Type Description', 'va_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author'),
		'taxonomies'          => array( 'project_place', 'project_status', 'project_tags', 'project_not_full' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'projects', $args );
}
add_action( 'init', 'va_create_cpt_and_taxos', 0 );
?>
