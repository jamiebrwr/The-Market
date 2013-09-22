<?php
// create custom plugin settings menu
function ecpt_menu() {
	global $ecpt_options, 
	$ecpt_about_page, 
	$ecpt_post_types_page, 
	$ecpt_taxonomies_page, 
	$ecpt_meta_boxes_page,
	$ecpt_settings_page, 
	$ecpt_export_page, 
	$ecpt_help_page;
	
	// check the user levels needed to access each page
	
	if($ecpt_options['menu_user_level'] == 'Author') { 
		$menu_level = 'edit_posts'; $posts_level = 'edit_posts'; $tax_level = 'edit_posts'; $meta_level = 'edit_posts';
	} else if ($ecpt_options['menu_user_level'] == 'Editor') { 
		$menu_level = 'edit_pages'; $posts_level = 'edit_pages'; $tax_level = 'edit_pages'; $meta_level = 'edit_pages';
	} else { 
		$menu_level = 'manage_options'; $posts_level = 'manage_options'; $tax_level = 'manage_options'; $meta_level = 'manage_options'; 
	}	
	
	if($ecpt_options['posttype_user_level'] == 'Author' && (($ecpt_options['menu_user_level'] != 'Editor') && ($ecpt_options['menu_user_level'] != 'Admin'))) { 
		$posts_level = 'edit_posts'; 
	} else if ($ecpt_options['posttype_user_level'] == 'Editor' && ($ecpt_options['menu_user_level'] != 'Admin')) { 
		$posts_level = 'edit_pages'; 
	} else { 
		$posts_level = 'manage_options'; 
	}
	
	if($ecpt_options['tax_user_level'] == 'Author' && (($ecpt_options['menu_user_level'] != 'Editor') && ($ecpt_options['menu_user_level'] != 'Admin'))) { 
		$tax_level = 'edit_posts'; 
	} else if ($ecpt_options['tax_user_level'] == 'Editor' && ($ecpt_options['menu_user_level'] != 'Admin')) { 
		$tax_level = 'edit_pages'; 
	} else { 
		$tax_level = 'manage_options'; 
	}
	//echo $tax_level; exit;
	
	if($ecpt_options['metabox_user_level'] == 'Author' && (($ecpt_options['menu_user_level'] != 'Editor') && ($ecpt_options['menu_user_level'] != 'Admin'))) { 
		$meta_level = 'edit_posts'; 
	} else if ($ecpt_options['metabox_user_level'] == 'Editor' && ($ecpt_options['menu_user_level'] != 'Admin')) { 
		$meta_level = 'edit_pages'; 
	} else { 
		$meta_level = 'manage_options'; 
	}
	
	//create new top-level menu
	add_menu_page('Custom Content Types', 'Content Types', $menu_level,  'easy-content-types', 'ecpt_home_page', plugins_url('/images/icon.png', __FILE__));
	
	// add about page -- top level page links here
	$ecpt_about_page = add_submenu_page( 'easy-content-types', __('About', 'ecpt'), __('About', 'ecpt'),$menu_level,  'easy-content-types', 'ecpt_home_page');	
	
	// add custom post types page
	$ecpt_post_types_page = add_submenu_page( 'easy-content-types', __('Post Types', 'ecpt'), __('Post Types', 'ecpt'), $posts_level,  'easy-content-types-posttypes', 'ecpt_posttype_manager');	
	
	// add custom taxonomies page
	$ecpt_taxonomies_page = add_submenu_page( 'easy-content-types', __('Taxonomies', 'ecpt'), __('Taxonomies', 'ecpt'), $tax_level,  'easy-content-types-taxonomies', 'ecpt_tax_manager');	

	// add custom metaboxes page
	$ecpt_meta_boxes_page = add_submenu_page( 'easy-content-types', __('MetaBoxes', 'ecpt'), __('Meta Boxes', 'ecpt'),$meta_level,  'easy-content-types-metaboxes', 'ecpt_metabox_manager');	
	
	// add settings page
	$ecpt_settings_page = add_submenu_page( 'easy-content-types', __('Settings', 'ecpt'), __('Settings', 'ecpt'),'manage_options',  'easy-content-types-settings', 'ecpt_settings_page');		
	
	// add export page
	$ecpt_export_page = add_submenu_page( 'easy-content-types', __('Export', 'ecpt'), __('Export', 'ecpt'),'manage_options',  'easy-content-types-export', 'ecpt_export_page');		
	
	// add help page
	$ecpt_help_page = add_submenu_page( 'easy-content-types', __('Help', 'ecpt'), __('Help', 'ecpt'), $menu_level,  'easy-content-types-help', 'ecpt_help_page');	
	
}
add_action('admin_menu', 'ecpt_menu');