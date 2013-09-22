<?php

function ecpt_register_taxonomies() {

	global $ecpt_options;

	$taxonomies = ecpt_get_cached_taxonomies();

	foreach( $taxonomies as $key => $tax) {


		$labels = array(
			'name' 							=> _x( $tax->plural_name, 'taxonomy general name' ),
			'singular_name' 				=> _x( $tax->singular_name, 'taxonomy singular name' ),
			'add_new' 						=> _x( 'Add New ' . $tax->singular_name, 'taxonomy add new'),
			'add_new_item' 					=> __( 'Add New ' . $tax->singular_name ),
			'edit_item' 					=> __( 'Edit ' . $tax->singular_name ),
			'new_item' 						=> __( 'New ' . $tax->singular_name ),
			'popular_items' 				=> __( 'Popular ' . $tax->plural_name ),
			'all_items' 					=> __( 'All ' . $tax->plural_name ),
			'view_item' 					=> __( 'View ' . $tax->singular_name ),
			'separate_items_with_commas'	=> __( 'Separate ' . $tax->plural_name . ' with commas' ),
			'choose_from_most_used'			=> __( 'Choose from the most used ' . $tax->plural_name),
			'search_items' 					=> __( 'Search ' . $tax->plural_name ),
			'not_found' 					=> __( 'No ' . $tax->singular_name . ' found' ),
			'not_found_in_trash' 			=> __( 'No ' . $tax->singular_name . ' found in Trash' ),
		);

		if($tax->hierarchical == 1) 		{ $hierarchical = true; } else { $hierarchical = false; }
		if($tax->show_tagcloud == 1) 		{ $tagcloud = true; } else { $tagcloud = false; }
		if($tax->show_in_nav_menus == 1)	{ $nav = true; } else { $nav = false; }
		if($tax->with_front == 1)	{ $with_front = false; } else { $with_front = true; }

		$pages = array();
		$pages = explode(',', $tax->page);

		$args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __( $tax->singular_name ),
			'public' 			=> true,
			'show_ui' 			=> true,
			'hierarchical' 		=> $hierarchical,
			'show_tagcloud' 	=> $tagcloud,
			'show_in_nav_menus' => $nav,
			'rewrite' 			=> array('slug' => $tax->slug, 'with_front' => $with_front),
			'query_var'			=> str_replace(' ', '_', strtolower( $tax->name ) ),
			'args'				=> array('orderby' => 'term_order')
		 );

		if(isset($ecpt_options['create_tax_templates']) && $ecpt_options['create_tax_templates'] == true) {
			 // create a template file for the taxonomy archives if it doesn't exist
			 if(!file_exists(get_stylesheet_directory() . '/taxonomy-' . str_replace(' ', '_', strtolower($tax->name)) . '.php')) {
				if(file_exists(get_stylesheet_directory() . '/taxonomy.php')) {
					copy(get_stylesheet_directory() . '/taxonomy.php', get_stylesheet_directory() . '/taxonomy-' . str_replace(' ', '_', strtolower($tax->name)) . '.php');
				} elseif (file_exists(get_stylesheet_directory() . '/archive.php')) {
					copy(get_stylesheet_directory() . '/archive.php', get_stylesheet_directory() . '/taxonomy-' . str_replace(' ', '_', strtolower($tax->name)) . '.php');
				} elseif (file_exists(get_stylesheet_directory() . '/index.php')) {
					copy(get_stylesheet_directory() . '/index.php', get_stylesheet_directory() . '/taxonomy-' . str_replace(' ', '_', strtolower($tax->name)) . '.php');
				}
			 }
		}
		register_taxonomy(str_replace(' ', '_', strtolower($tax->name)), $pages, $args);
	}
}
add_action('init', 'ecpt_register_taxonomies', 10);

// fix taxonomy archives
function ecpt_on_pre_get_posts($query) {
	global $ecpt_options;
    if ( $query->is_tax && !isset($query->query_vars['suppress_filters']) && !isset($ecpt_options['disable_filter_archive_post_types']) ) {
		$post_types = array();
		$types = ecpt_get_cached_post_types();
		if($types) {
			foreach($types as $key => $type ) {
				$post_types[] = $type->name;
			}
		}
		$post_types[] = 'post';
		$post_types[] = 'page';

        $query->set( 'post_type', $post_types );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'ecpt_on_pre_get_posts', 999 );