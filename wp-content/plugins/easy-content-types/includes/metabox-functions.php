<?php


function ecpt_get_metabox_pages() {

	$metabox_pages = get_post_types('', 'objects');

	return apply_filters( 'ecpt_metabox_pages', $metabox_pages );
}


function ecpt_get_metabox_contexts() {
	
	// metabox context
	$metabox_contexts = array('normal', 'advanced', 'side');

	return apply_filters( 'ecpt_metabox_contexts', $metabox_contexts );
}


function ecpt_get_metabox_priorities() {

	// metabox priority
	$metabox_priorities = array('default', 'high', 'core', 'low');

	return apply_filters( 'ecpt_metabox_priorities', $metabox_priorities );
}
