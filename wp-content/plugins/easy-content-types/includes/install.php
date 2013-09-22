<?php

global $wpdb;

/********************************
* DB versions
********************************/

// ECPT DB version
global $ecpt_db_version;
$ecpt_db_version = 1.5;

// ECPT DB taxonomy version
global $ecpt_db_tax_version;
$ecpt_db_tax_version = 1.4;

// ECPT DB meta box version
global $ecpt_db_meta_version;
$ecpt_db_meta_version = 1.1;

// ECPT DB meta box fields version
global $ecpt_db_meta_fields_version;
$ecpt_db_meta_fields_version = 1.9;


/********************************
* DB name variables
********************************/

global $ecpt_db_name;
// name of the ECPT post type database
$ecpt_db_name = $wpdb->prefix . "ecpt_post_types";

// name of the ECPT post type database
global $ecpt_db_tax_name;
$ecpt_db_tax_name = $wpdb->prefix . "ecpt_taxonomies";

// name of the ECPT metabox database
global $ecpt_db_meta_name;
$ecpt_db_meta_name = $wpdb->prefix . "ecpt_meta_boxes";

// name of the ECPT metabox fields database
global $ecpt_db_meta_fields_name;
$ecpt_db_meta_fields_name = $wpdb->prefix . "ecpt_meta_box_fields";



/********************************
* DB Install
********************************/

// function to create the DB / Options / Defaults
function ecpt_options_install() {

	global $wpdb, $ecpt_db_name, $ecpt_db_version, $ecpt_db_tax_name, $ecpt_db_tax_version, $ecpt_db_meta_name, $ecpt_db_meta_version,
	$ecpt_db_meta_fields_name, $ecpt_db_meta_fields_version;

	// create the ECPT post type database table
	if ( $wpdb->get_var( "show tables like '$ecpt_db_name'" ) != $ecpt_db_name ) {
		$sql = "CREATE TABLE " . $wpdb->escape( $ecpt_db_name ) . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`singular_name` tinytext NOT NULL,
		`plural_name` tinytext NOT NULL,
		`hierarchical` tinyint NOT NULL,
		`title` tinyint NOT NULL,
		`editor` tinyint NOT NULL,
		`author` tinyint NOT NULL,
		`thumbnail` tinyint NOT NULL,
		`excerpt` tinyint NOT NULL,
		`fields` tinyint NOT NULL,
		`comments` tinyint NOT NULL,
		`revisions` tinyint NOT NULL,
		`has_archive` tinyint NOT NULL,
		`post_formats` tinyint NOT NULL,
		`page_attributes` tinyint NOT NULL,
		`show_in_nav_menus` tinyint NOT NULL,
		`menu_position` tinyint NOT NULL,
		`menu_icon` tinytext NOT NULL,
		`exclude_from_search` TINYINT NOT NULL,
		`slug` TINYTEXT NOT NULL,
		`with_front` tinyint NOT NULL,
		`post_tags` tinyint NOT NULL,
		`categories` tinyint NOT NULL,
		`labels` mediumtext NOT NULL,
		`advanced_supports` mediumtext NOT NULL,
		UNIQUE KEY id (id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		add_option( "ecpt_db_version", $ecpt_db_version );
	}

	// create the ECPT taxonomy database table
	if ( $wpdb->get_var( "show tables like '$ecpt_db_tax_name'" ) != $ecpt_db_tax_name ) {
		$sql = "CREATE TABLE " . $wpdb->escape( $ecpt_db_tax_name ) . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`page` tinytext NOT NULL,
		`singular_name` tinytext NOT NULL,
		`plural_name` tinytext NOT NULL,
		`hierarchical` tinyint NOT NULL,
		`show_tagcloud` tinyint NOT NULL,
		`show_in_nav_menus` tinyint NOT NULL,
		`slug` TINYTEXT NOT NULL,
		`with_front` tinyint NOT NULL,
		`enable_filter` tinyint NOT NULL,
		UNIQUE KEY id (id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		add_option( "ecpt_db_tax_version", $ecpt_db_tax_version );
	}


	// create the ECPT metabox database table
	if ( $wpdb->get_var( "show tables like '$ecpt_db_meta_name'" ) != $ecpt_db_meta_name ) {
		$sql = "CREATE TABLE " . $wpdb->escape( $ecpt_db_meta_name ) . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`nicename` tinytext NOT NULL,
		`page` tinytext NOT NULL,
		`context` tinytext NOT NULL,
		`priority` tinytext NOT NULL,
		`post_ids` mediumtext NOT NULL,
		UNIQUE KEY id (id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		add_option( "ecpt_db_meta_version", $ecpt_db_meta_version );
	}


	// create the ECPT metabox fields database table
	if ( $wpdb->get_var( "show tables like '$ecpt_db_meta_fields_name'" ) != $ecpt_db_meta_fields_name ) {
		$sql = "CREATE TABLE " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`nicename` tinytext NOT NULL,
		`parent` tinytext NOT NULL,
		`type` tinytext NOT NULL,
		`options` mediumtext NOT NULL,
		`description` longtext NOT NULL,
		`list_order` tinyint NOT NULL,
		`rich_editor` tinyint NOT NULL,
		`max` tinyint NOT NULL,
		UNIQUE KEY id (id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );

		add_option( "ecpt_db_meta_fields_version", $ecpt_db_meta_fields_version );
	}

	add_option( 'ecpt_is_installed', '1' );
}
// run the install scripts upon plugin activation
register_activation_hook( ECPT_BASE_FILE, 'ecpt_options_install' );


function ecpt_check_is_installed() {
	// this is mainly for network activated installs
	if ( ! get_option( 'ecpt_is_installed' ) )
		ecpt_options_install();
}
add_action( 'admin_init', 'ecpt_check_is_installed' );
