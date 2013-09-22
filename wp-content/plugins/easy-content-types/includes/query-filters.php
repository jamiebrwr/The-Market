<?php

function ecpt_include_post_types_in_search( $query ) {
	if ( $query->is_main_query() && is_search() && isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] != 'nav_menu_item' ) {
		$post_types = get_post_types( array( 'exclude_from_search' => false ), 'objects' );
		$searchable_types = array();
		if ( $post_types ) {
			foreach ( $post_types as $type ) {
				$searchable_types[] = $type->name;
			}
		}
		$query->set( 'post_type', $searchable_types );
	}
}
add_action( 'pre_get_posts', 'ecpt_include_post_types_in_search' );