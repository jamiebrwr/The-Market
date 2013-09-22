<?php

function ecpt_process_metabox_field_order() {
	global $wpdb;
	$ecpt_db_meta_fields_name = $wpdb->prefix . "ecpt_meta_box_fields";
	$fields = $_POST['recordsArray'];
	$listingCounter = 1;
	foreach ( $fields as $new_id ) {

		$wpdb->update( $ecpt_db_meta_fields_name, array( 'list_order' => $listingCounter ), array('id' => $new_id ) );
		$listingCounter++;
	}
	die();
}
add_action('wp_ajax_ecpt_update_field_listing', 'ecpt_process_metabox_field_order');

function ecpt_process_repeatable_order() {
	
	$post_id = absint( $_POST['post_id'] );
	$meta_id = strip_tags( $_POST['meta_id'] );
	
	// retrieve the existing field order
	$old_meta = get_post_meta($post_id, $meta_id, true);
	$updated_meta = array();
	
	$new_meta = $_POST[$meta_id];
	foreach($new_meta as $meta_field) {
		$updated_meta[] = $meta_field;
	}
	update_post_meta( $post_id, $meta_id, $updated_meta );
	die();
}
add_action('wp_ajax_ecpt_update_repeatable_order', 'ecpt_process_repeatable_order');