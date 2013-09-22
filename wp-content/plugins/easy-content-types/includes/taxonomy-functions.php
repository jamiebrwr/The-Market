<?php

function ecpt_get_taxonomy_objects() {

	$tax_objects = get_post_types('', 'objects');

	return apply_filters( 'ecpt_taxonomy_objects', $tax_objects );
}

function ecpt_get_taxonomy_attributes() {

	// taxonomy attributes
	$tax_atts = array('hierarchical', 'show_tagcloud', 'show_in_nav_menus');

	return apply_filters( 'ecpt_taxonomy_attributes', $tax_atts );
}