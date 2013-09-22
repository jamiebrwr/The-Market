<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage ECPT
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @author	   Travis Smith <travis@wpsmith.net>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'ecpt_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function ecpt_register_required_plugins() {
	
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     				=> 'ECPT: Filter by Taxonomy', // The plugin name
			'slug'     				=> 'ecpt-filter-by-taxonomy', // The plugin slug (typically the folder name)
			'source_type'			=> 'CodeCanyon',
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'			=> 'http://codecanyon.net/item/ecpt-filter-by-taxonomy/841355', // If set, overrides default API URL and points to an external URL
			'source' 				=> 'codecanyon.net/item/ecpt-filter-by-taxonomy/841355', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'ECPT: Bonus Meta Field Types Add-On', // The plugin name
			'slug'     				=> 'ecpt-bonus-meta-field-types-addon', // The plugin slug (typically the folder name)
			'source_type'			=> 'CodeCanyon',
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://codecanyon.net/item/ecpt-bonus-meta-field-types-addon-/712383', // If set, overrides default API URL and points to an external URL
			'source' 				=> 'http://codecanyon.net/item/ecpt-bonus-meta-field-types-addon-/712383', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Post Type Column Editor', // The plugin name
			'slug'     				=> 'column-editor', // The plugin slug (typically the folder name)
			'source_type'			=> 'CodeCanyon',
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://codecanyon.net/item/post-type-column-editor/758157', // If set, overrides default API URL and points to an external URL
			'source' 				=> 'http://codecanyon.net/item/post-type-column-editor/758157', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Posts By Taxonomy Widget Pro', // The plugin name
			'slug'     				=> 'posts-by-taxonomy-widget-pro', // The plugin slug (typically the folder name)
			'source_type'			=> 'CodeCanyon',
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://codecanyon.net/item/posts-by-taxonomy-widget-pro/459856', // If set, overrides default API URL and points to an external URL
			'source' 				=> 'http://codecanyon.net/item/posts-by-taxonomy-widget-pro/459856', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Better Related Posts Widget', // The plugin name
			'slug'     				=> 'better-related-posts-widget', // The plugin slug (typically the folder name)
			'source_type'			=> 'CodeCanyon',
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://codecanyon.net/item/better-related-posts-widget/427853', // If set, overrides default API URL and points to an external URL
			'source' 				=> 'http://codecanyon.net/item/better-related-posts-widget/427853', // If set, overrides default API URL and points to an external URL
		),

	);
	
	//Check and add theme plugins
	$theme_plugins = ecpt_theme_plugins();
	if ( $theme_plugins ) {
		foreach ( $theme_plugins as $theme_plugin )
			$plugins[] = $theme_plugin;
	}
	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'ecpt';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'easy-content-types/easy-content-types.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'admin.php?easy-content-types/easy-content-types.php', 				// Default parent URL slug
		'menu'         		=> 'recommended-plugins', 		// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '<em>' . __( 'These are some other plugins that I have written that fit perfectly with Easy Content Types.' . '</em>', $theme_text_domain ),							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Recommended / Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Recommended Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'Based on your theme, Easy Content Types requires the following plugin: %1$s.', 'Based on your theme, Easy Content Types requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'Easy Content Types recommends the following plugin: %1$s.', 'Easy Content Types recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> ' ', //_n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/**
 * Checks for minimum Genesis Theme version before allowing plugin to activate
 *
 * @author Travis Smith
 */
function ecpt_theme_plugins() {
	
	$theme_info = get_theme_data( TEMPLATEPATH . '/style.css' );
	$theme_plugins     = array();
	
	switch ( $theme_info['Name'] ) {
		case 'Genesis':
			// This is an example of how to include a plugin pre-packaged with a theme
			$theme_plugins[] = array(
				'name'     				=> 'Genesis Custom Post Types Archives', // The plugin name
				'slug'     				=> 'genesis-custom-post-types-archives', // The plugin slug (typically the folder name)
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			);
			break;
		default:
			$theme_plugins = apply_filters( 'ecpt_theme_plugins', $theme_plugins );
			break;
	}
	return $theme_plugins;
}

add_filter( 'tgmpa_notice_action_links', 'ecpt_notice_action_links' );
/**
 * Filters TGMPA Action Links
 *
 * @author Travis Smith
 * @param array $action_links TGMPA Action Links
 * @return array $action_links Modified TGMPA Action Links
 */
function ecpt_notice_action_links( $action_links ) {
	$action_links['install'] = '';
	$action_links['activate'] = '';
	return $action_links;
}