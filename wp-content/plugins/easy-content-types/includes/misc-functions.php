<?php


function ecpt_is_odd( $int )
{
  return( $int & 1 );
}

function ecpt_get_extension($str)
{
   $parts = explode('.', $str);
   return end($parts);
}

// add support for Featured Images, if not already supported
function ecpt_add_thumbnail_support() {
	if(!current_theme_supports('post-thumbnails')) {
		add_theme_support('post-thumbnails');
	}
}
add_action('after_setup_theme', 'ecpt_add_thumbnail_support');

// ensures date formats are passed in an acceptable format
function ecpt_format_date($date) {

	global $ecpt_options;

	$date_format = $ecpt_options['date_format'];

	$date = str_replace(' ', '', $date);   // remove all spaces
	$date = str_replace('-', '/', $date);   //strtotime can't do m-d-y, only m/d/y
	$date = str_replace('.', '/', $date);   //strtotime can't do m.d.y, only m/d/y

	$date = strtotime($date);

	return $date;
}

// returns the formatted date string
function ecpt_get_date($date) {

	global $ecpt_options;

	return date_i18n($ecpt_options['date_format'], $date);
}

// converts a time stamp to date string for meta fields
function ecpt_timestamp_to_date($date) {

	return date('m/d/Y', $date);
}

function ecpt_get_field_type( $field_id ) {
	global $wpdb, $ecpt_db_meta_fields_name;
	$type = $wpdb->get_results( $wpdb->prepare( "SELECT type FROM " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " WHERE name='%s';", $field_id ) );
	if( $type ) {
		return $type[0]->type;
	}
	return false;
}

// Forces the Insert Into Post button to be present
function ecpt_force_send_to_post( $vars ) {
	$vars['send'] = true;
	return $vars;
}
add_filter( 'get_media_item_args', 'ecpt_force_send_to_post' );