<?php

// retrieves the cache for post types
function ecpt_get_cached_post_types() {

	$post_types = get_transient('ecpt_post_types');
	
	if($post_types === false) {
		global $wpdb, $ecpt_db_name;
		$post_types = $wpdb->get_results("SELECT * FROM " . $ecpt_db_name . ";");
		set_transient('ecpt_post_types', $post_types, 3600);
	}
	
	return $post_types;
}

// retrieves the cache for taxonomies
function ecpt_get_cached_taxonomies() {

	$taxonomies = get_transient('ecpt_taxonomies');
	
	if($taxonomies === false) {
		global $wpdb, $ecpt_db_tax_name;
		$taxonomies = $wpdb->get_results("SELECT * FROM " . $ecpt_db_tax_name . ";");
		set_transient('ecpt_taxonomies', $taxonomies, 3600);
	}
	
	return $taxonomies;
}

// retrieves the cache for meta boxes
function ecpt_get_cached_metaboxes() {

	$metaboxes = get_transient('ecpt_metaboxes');
	
	if($metaboxes === false) {
		global $wpdb, $ecpt_db_meta_name;
		$metaboxes = $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_name . " ORDER BY `id`;");
		set_transient('ecpt_metaboxes', $metaboxes, 3600);
	}
	
	return $metaboxes;
}

// clears the specified cache
function ecpt_clear_cache($cache = null) {
	if(!$cache)
		return;
		
	delete_transient('ecpt_' . $cache);
}