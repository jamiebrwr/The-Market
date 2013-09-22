<?php

function ecpt_register_post_types() {
	global $ecpt_options;

	$ecpt_post_types = ecpt_get_cached_post_types();

	foreach( $ecpt_post_types as $key => $type) {

		$single_name = utf8_decode($type->singular_name);
		$plural_name = utf8_decode($type->plural_name);

		$default_labels = array(
			'name' 					=> _x( $plural_name, 'post type general name' ),
			'singular_name'			=> _x( $single_name, 'post type singular name' ),
			'add_new' 				=> _x( 'Add New ' . $type->singular_name, 'post type add new'),
			'add_new_item' 			=> __( 'Add New ' . $type->singular_name ),
			'edit_item' 			=> __( 'Edit ' . $type->singular_name ),
			'new_item' 				=> __( 'New ' . $type->singular_name ),
			'all_items' 			=> __( 'All ' . $type->plural_name ),
			'view_item' 			=> __( 'View ' . $type->singular_name ),
			'search_items' 			=> __( 'Search ' . $type->plural_name ),
			'not_found' 			=> __( 'No ' . $type->plural_name . ' found' ),
			'not_found_in_trash'	=> __( 'No ' . $type->plural_name . ' found in Trash' ),
			'parent_item_colon' 	=> '',
			'menu_name' 			=> __( $type->plural_name )
		);

		if(!empty($type->labels)) {

			$advanced_labels = maybe_unserialize($type->labels);
			if( is_array( $advanced_labels ) ) {
				foreach($advanced_labels as $key => $label) {
					if($label == '') {
						$advanced_labels[$key] = $default_labels[$key];
					}
				}
				$labels = array(
					'name' 					=> _x( $plural_name, 'post type general name' ),
					'singular_name'			=> _x( $single_name, 'post type singular name' ),
					'add_new' 				=> _x( $advanced_labels['add_new'], 'post type add new'),
					'add_new_item' 			=> __( $advanced_labels['add_new_item'] ),
					'edit_item' 			=> __( $advanced_labels['edit_item'] ),
					'new_item' 				=> __( $advanced_labels['new_item'] ),
					'view_item' 			=> __( $advanced_labels['view_item'] ),
					'all_items' 			=> __( $advanced_labels['all_items'] ),
					'search_items' 			=> __( $advanced_labels['search_items'] ),
					'not_found' 			=> __( $advanced_labels['not_found'] ),
					'not_found_in_trash'	=> __( $advanced_labels['not_found_in_trash'] ),
					'parent_item_colon' 	=> __( $advanced_labels['parent_item_colon'] ),
					'menu_name'				=> __( $advanced_labels['menu_name'] )
				);
			}
		} else {
			$labels = $default_labels;
		}

		if($type->hierarchical == 1) { $hierarchical = true; } else { $hierarchical = false; }
		if($type->has_archive == 1) { $archive = true; } else { $archive = false; }
		if($type->exclude_from_search == 1) { $search = true; } else { $search = false; }
		if($type->with_front == 1) { $with_front = false; } else { $with_front = true; }

		// show in nav menus is not working right now, so all post types are shown
		if($type->show_in_nav_menus == 1) 	{ $show_in_menus = true; } else { $show_in_menus = false; }

		// check for supports options
		$supports = array();
		if($type->title == 1) 				{ $supports[] = 'title'; }
		if($type->editor == 1) 				{ $supports[] = 'editor'; }
		if($type->author == 1) 				{ $supports[] = 'author'; }
		if($type->thumbnail == 1) 			{ $supports[] = 'thumbnail'; }
		if($type->excerpt == 1) 			{ $supports[] = 'excerpt'; }
		if($type->fields == 1) 				{ $supports[] = 'custom-fields'; }
		if($type->comments == 1) 			{ $supports[] = 'comments'; }
		if($type->revisions == 1) 			{ $supports[] = 'revisions'; }
		if($type->post_formats == 1) 		{ $supports[] = 'post-formats'; }
		if($type->hierarchical == 1) 		{ $supports[] = 'page-attributes'; }

		// get custom support options
		if( !empty($type->advanced_supports) ) {

			// check if there are more than one options or not
			if( strpos(	$type->advanced_supports, ',' ) ) {
				$advanced_supports = explode( ',', $type->advanced_supports );
			} else {
				$advanced_supports = array( $type->advanced_supports );
			}

			foreach($advanced_supports as $option) {
				$supports[] = trim( $option );
			}
			//print_r($supports); exit;
		}

		// check for default taxonomies
		$taxonomies = array();
		if($type->post_tags == 1) 			{ $taxonomies[] = 'post_tag'; }
		if($type->categories == 1) 			{ $taxonomies[] = 'category'; }

		$custom_taxonomies = get_object_taxonomies($type->name);
		if($custom_taxonomies) {
			foreach($custom_taxonomies as $tax) {
				$taxonomies[] = $tax;
			}
		}

		// convert menu position to an int
		$position = (int)$type->menu_position;

		if($type->menu_icon != '' && $type->menu_icon != 'undefined' )	{ $icon = $type->menu_icon; } else { $icon = ''; }

		$post_type_args = array(
			'labels' 				=> $labels,
			'singular_label' 		=> __(utf8_decode($type->singular_name)),
			'public'					=> true,
			'show_ui' 				=> true,
			'publicly_queryable'	=> true,
			'query_var'				=> $type->name,
			'capability_type' 		=> 'post',
			'has_archive' 			=> $archive,
			'hierarchical' 			=> $hierarchical,
			'exclude_from_search'	=> $search,
			'rewrite' 				=> array('slug' => $type->slug, 'with_front' => $with_front ),
			'supports' 				=> $supports,
			'menu_position' 		=> $position,
			'show_in_nav_menus' 	=> $show_in_menus,
			'menu_icon' 			=> $icon,
			'taxonomies'			=> $taxonomies
		 );

		if(isset($ecpt_options['create_single_templates']) && $ecpt_options['create_single_templates'] == true) {
			 // create a template file for the single post type if it doesn't exist
			 if(!file_exists(get_stylesheet_directory() . '/single-' . $type->name . '.php')) {
				if(file_exists(get_stylesheet_directory() . '/single.php')) {
					copy(get_stylesheet_directory() . '/single.php', get_stylesheet_directory() . '/single-' . $type->name . '.php');
				} else {
					if(file_exists(get_stylesheet_directory() . '/index.php')) {
						// copy index.php if single.php doesn't exist
						copy(get_stylesheet_directory() . '/index.php', get_stylesheet_directory() . '/single-' . $type->name . '.php');
					}
				}
			 }
		}
		if(isset($ecpt_options['create_archive_templates']) && $ecpt_options['create_archive_templates'] == true) {
			// create a template file for the single post type if it doesn't exist
			if(!file_exists(get_stylesheet_directory() . '/archive-' . $type->name . '.php')) {
				// first check for archive.php in the current theme dir
				if(file_exists(get_stylesheet_directory() . '/archive.php')) {
					copy(get_stylesheet_directory() . '/archive.php', get_stylesheet_directory() . '/archive-' . $type->name . '.php');
				// if it didn't exist, check the parent theme directory
				} elseif(file_exists(get_template_directory() . '/archive.php')) {
					copy(get_template_directory() . '/archive.php', get_stylesheet_directory() . '/archive-' . $type->name . '.php');
				// if both of the above failed, check for an index.php
				} else {
					// first look in the current theme dir
					if(file_exists(get_stylesheet_directory() . '/index.php')) {
						// copy index.php if archive.php doesn't exist
						copy(get_stylesheet_directory() . '/index.php', get_stylesheet_directory() . '/archive-' . $type->name . '.php');
					// if not found, check the parent theme dir
					} elseif (file_exists(get_stylesheet_directory() . '/index.php')) {
						copy(get_template_directory() . '/index.php', get_stylesheet_directory() . '/archive-' . $type->name . '.php');
					}
				}
			}
		}
		// register the post type
		register_post_type($type->name, $post_type_args);
	}
}
add_action('init', 'ecpt_register_post_types', 20);

function ecpt_is_bad_hierarchical_slug( $is_bad_hierarchical_slug, $slug, $post_type, $post_parent ) {

	$ecpt_post_types = ecpt_get_cached_post_types();
	foreach( $ecpt_post_types as $key => $type) {
		if( $type->slug == $slug )
			return true;
	}

	return $is_bad_hierarchical_slug;
}
add_filter( 'wp_unique_post_slug_is_bad_hierarchical_slug', 'ecpt_is_bad_hierarchical_slug', 10, 4 );

function ecpt_is_bad_flat_slug( $is_bad_flat_slug, $slug, $post_type ) {

	$ecpt_post_types = ecpt_get_cached_post_types();
	foreach( $ecpt_post_types as $key => $type) {
		if( $type->slug == $slug )
			return true;
	}

	return $is_bad_flat_slug;

}
add_filter( 'wp_unique_post_slug_is_bad_flat_slug', 'ecpt_is_bad_flat_slug', 10, 3 );
