<?php

function ecpt_check_if_upgrade_needed() {
	global $ecpt_options, $ecpt_db_version, $ecpt_db_tax_version, $ecpt_db_meta_version, $ecpt_db_meta_fields_version;
	
	if($ecpt_db_version != get_option('ecpt_db_version')) {
		return true;
	}
	if($ecpt_db_tax_version != get_option('ecpt_db_tax_version')) {
		return true;
	}
	if($ecpt_db_meta_version != get_option('ecpt_db_meta_version')) {
		return true;
	}
	if($ecpt_db_meta_fields_version != get_option('ecpt_db_meta_fields_version')) {
		return true;
	}
	return false;
}

function ecpt_run_upgrade() {
	if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'upgrade' && ecpt_check_if_upgrade_needed()) {
		ecpt_options_upgrade();
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'ecpt_run_upgrade');

function ecpt_options_upgrade() {

	global $wpdb, $ecpt_db_name, $ecpt_db_version, $ecpt_db_tax_name, 
		$ecpt_db_tax_version, $ecpt_db_meta_name, $ecpt_db_meta_version, 
		$ecpt_db_meta_fields_name, $ecpt_db_meta_fields_version;
	
	/****************************************
	* upgrade post types DB
	****************************************/
	
	// check to see if the slug column needs added for post types
	if(!$wpdb->query("SELECT `slug` FROM `" . $wpdb->escape( $ecpt_db_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_name ) . "` ADD `slug` tinytext");
		update_option('ecpt_db_version', 1.1 );	
	}
	// check to see if the with_front column needs added for post types
	if(!$wpdb->query("SELECT `with_front` FROM `" . $wpdb->escape( $ecpt_db_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_name ) . "` ADD `with_front` tinyint");
		update_option('ecpt_db_version', 1.2 );	
	}
	if(!$wpdb->query("SELECT `post_tags` FROM `" . $wpdb->escape( $ecpt_db_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_name ) . "` ADD `post_tags` tinyint");
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_name ) . "` ADD `categories` tinyint");
		update_option('ecpt_db_version', 1.3 );	
	}
	// check to see if the labels column needs added for post types
	if(!$wpdb->query("SELECT `labels` FROM `" . $wpdb->escape( $ecpt_db_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_name ) . "` ADD `labels` mediumtext");
		update_option('ecpt_db_version', $ecpt_db_version );	
	}
	// check to see if the advanced_supports column needs added for post types
	if(!$wpdb->query("SELECT `advanced_supports` FROM `" . $wpdb->escape( $ecpt_db_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_name ) . "` ADD `advanced_supports` mediumtext");
		update_option('ecpt_db_version', $ecpt_db_version );	
	}
	
	/****************************************
	* upgrade taxonomy DB
	****************************************/
	
	// check to see if the slug column needs added for taxonomies
	if(!$wpdb->query("SELECT `slug` FROM `" . $wpdb->escape( $ecpt_db_tax_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_tax_name ) . "` ADD `slug` tinytext");
		update_option('ecpt_db_tax_version', 1.1 );	
	}
	// check to see if the with_front column needs added for taxonomies
	if(!$wpdb->query("SELECT `with_front` FROM `" . $wpdb->escape( $ecpt_db_tax_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_tax_name ) . "` ADD `with_front` tinyint");
		update_option('ecpt_db_tax_version', 1.2 );	
	}
	// remove the menu_position column if it's present
	if($wpdb->query("SELECT `menu_position` FROM `" . $wpdb->escape( $ecpt_db_tax_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_tax_name ) . "` DROP COLUMN `menu_position`");
		update_option('ecpt_db_tax_version', 1.3 );	
	}
	if(!$wpdb->query("SELECT `enable_filter` FROM `" . $wpdb->escape( $ecpt_db_tax_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_tax_name ) . "` ADD `enable_filter` tinyint");
		update_option('ecpt_db_tax_version', 1.4 );	
	}
	
	/****************************************
	* upgrade metabox DB
	****************************************/
	
	if(get_option('ecpt_db_meta_version') < $ecpt_db_meta_name)
	{
		$wpdb->query("ALTER TABLE " . $wpdb->escape( $ecpt_db_meta_name ) . " ADD `post_ids` mediumtext");
		update_option('ecpt_db_meta_version', $ecpt_db_meta_version );	
	}
	
	/****************************************
	* upgrade metabox fields DB
	****************************************/
	
	// check if the meatbox fields table needs to be upgraded
	if(get_option('ecpt_db_meta_fields_version') < 1.3)
	{
		$wpdb->query("ALTER TABLE " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " MODIFY `list_order` tinyint");
		update_option('ecpt_db_meta_fields_version', 1.3 );	
	} 
	
	// check if the rich_editor column exists
	if(!$wpdb->query("SELECT `description` FROM `" . $wpdb->escape( $ecpt_db_meta_fields_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_meta_fields_name ) . "` ADD `description` tinytext");
	}
	
	// check if the rich_editor column exists
	if(!$wpdb->query("SELECT `rich_editor` FROM `" . $wpdb->escape( $ecpt_db_meta_fields_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_meta_fields_name ) . "` ADD `rich_editor` tinyint");
	}
	// check if the max column exists
	if(!$wpdb->query("SELECT `max` FROM `" . $wpdb->escape( $ecpt_db_meta_fields_name ) . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $wpdb->escape( $ecpt_db_meta_fields_name ) . "` ADD `max` tinyint");
	}
	// upgrade the options meta field column to medium text to allow more options
	if(get_option('ecpt_db_meta_fields_version') < 1.8) 
	{
		$wpdb->query("ALTER TABLE " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " MODIFY `options` mediumtext");
	}
	// upgrade the options meta field column to medium text to allow more options
	if(get_option('ecpt_db_meta_fields_version') < 1.9) 
	{
		$wpdb->query("ALTER TABLE " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " MODIFY `description` longtext");
	}
	
	update_option('ecpt_db_meta_fields_version', $ecpt_db_meta_fields_version );

}
register_activation_hook(ECPT_BASE_FILE, 'ecpt_options_upgrade');


// this is a one-time function to upgrade database table collation
function ecpt_upgrade_table_collation() {
	if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'db-collate' && !get_option('ecpt_dbs_collated')) {
		global $wpdb, $ecpt_db_name, $ecpt_db_version, $ecpt_db_tax_name, 
		$ecpt_db_tax_version, $ecpt_db_meta_name, $ecpt_db_meta_version, 
		$ecpt_db_meta_fields_name, $ecpt_db_meta_fields_version;
		
		$wpdb->query("alter table `" . $wpdb->escape( $ecpt_db_name ) . "` convert to character set utf8 collate utf8_unicode_ci");
		$wpdb->query("alter table `" . $wpdb->escape( $ecpt_db_tax_name ) . "` convert to character set utf8 collate utf8_unicode_ci");
		$wpdb->query("alter table `" . $wpdb->escape( $ecpt_db_meta_name ) . "` convert to character set utf8 collate utf8_unicode_ci");
		$wpdb->query("alter table `" . $wpdb->escape( $ecpt_db_meta_fields_name ) . "` convert to character set utf8 collate utf8_unicode_ci");
		wp_redirect(add_query_arg('ecpt-db', 'updated', admin_url())); exit;
	}
}
add_action('admin_init', 'ecpt_upgrade_table_collation');