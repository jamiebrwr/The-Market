<?php

// load styles for the Content Types admin
function ecpt_admin_styles( $hook ) {
	global $ecpt_about_page, 
	$ecpt_post_types_page, 
	$ecpt_taxonomies_page, 
	$ecpt_meta_boxes_page,
	$ecpt_settings_page, 
	$ecpt_export_page, 
	$ecpt_help_page;
	
	$ecpt_pages = array($ecpt_about_page, $ecpt_post_types_page, $ecpt_taxonomies_page, $ecpt_meta_boxes_page, $ecpt_settings_page, $ecpt_export_page, $ecpt_help_page);
	
	if( !in_array( $hook, $ecpt_pages ) )
		return;
	
	wp_enqueue_style('thickbox');
	wp_enqueue_style('ecpt-admin', ECPT_PLUGIN_URL . 'includes/css/admin-styles.css');
	wp_enqueue_style('tooltip-css', ECPT_PLUGIN_URL . 'includes/css/thetooltip.css');
	wp_enqueue_style('jquery-ui-core');
}
add_action('admin_enqueue_scripts', 'ecpt_admin_styles');

// load scripts for the Content Types admin
function ecpt_admin_scripts( $hook ) {
	global $ecpt_about_page, 
	$ecpt_post_types_page, 
	$ecpt_taxonomies_page, 
	$ecpt_meta_boxes_page,
	$ecpt_settings_page, 
	$ecpt_export_page, 
	$ecpt_help_page,
	$post;
	
	$ecpt_pages = array($ecpt_about_page, $ecpt_post_types_page, $ecpt_taxonomies_page, $ecpt_meta_boxes_page, $ecpt_settings_page, $ecpt_export_page, $ecpt_help_page);
	
	if( !in_array( $hook, $ecpt_pages ) && empty( $post ) )
		return;
	
	wp_enqueue_script('media-upload'); 
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('ecpt-admin', ECPT_PLUGIN_URL . 'includes/js/ecpt-admin.js', array('jquery'));
	wp_localize_script( 'ecpt-admin', 'ecpt_vars', 
		array( 
			'post_id' => is_object( $post ) ? $post->ID : null,
			'delete_post_type' => __('Do you you really want to delete this Post Type?', 'ecpt'),
			'delete_taxonomy' => __('Do you you really want to delete this Taxonomy?', 'ecpt'),
			'delete_metabox' => __('Do you you really want to delete this Metabox?', 'ecpt'),
			'delete_field' => __('Do you you really want to delete this Field?', 'ecpt'),
			'enter_post_type_name' => __('You must enter a post type name', 'ecpt'),
			'enter_meta_box_name' => __('You must enter a metabox name', 'ecpt'),
			'enter_taxonomy_name' => __('You must enter a taxonomy name', 'ecpt'),
			'select_taxonomy_object' => __('You must select at least on taxonomy object', 'ecpt'),
			'enter_field_name' => __('You must enter a field name', 'ecpt')
		) 
	);

	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-slider');
}
add_action('admin_enqueue_scripts', 'ecpt_admin_scripts');

// load post editor styles
function ecpt_post_edit_styles() {
	global $ecpt_base_dir;
	wp_enqueue_style('thickbox');
	wp_enqueue_style('ecpt-admin', ECPT_PLUGIN_URL . 'includes/css/admin-styles.css');
	wp_enqueue_style('datepicker-slider', ECPT_PLUGIN_URL . 'includes/css/datepicker-slider.css');
}
add_action('admin_print_styles-post.php', 'ecpt_post_edit_styles');
add_action('admin_print_styles-edit.php', 'ecpt_post_edit_styles');
add_action('admin_print_styles-post-new.php', 'ecpt_post_edit_styles');

// load the export page scripts
function ecpt_prettify_scripts( $hook ) {
	global $ecpt_export_page;

	if( $hook != $ecpt_export_page )
		return;

	wp_enqueue_script('postbox');
	wp_enqueue_script('dashboard');
}
add_action('admin_enqueue_scripts', 'ecpt_prettify_scripts');
