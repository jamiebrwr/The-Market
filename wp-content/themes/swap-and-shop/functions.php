<?php

/*-----------------------------------------------------------------------------------*/
/* Start Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = STYLESHEETPATH . '/functions/';
$includes_path = STYLESHEETPATH . '/includes/';

// Theme specific functionality
require_once ($includes_path . 'image-sizes.php'); 				// Register custom image sizes

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/


/**
 * Proper way to enqueue scripts and styles
 */
function theme_name_scripts() {
	//wp_enqueue_style( 'style-name', get_stylesheet_uri() );
	//wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );


/*-------------------------------------------------------------------------------------------
 * Page-level DocBlock
 * @package WordPress
 *-------------------------------------------------------------------------------------------
 *
 * Random Greetings to the user.
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */
function sjm_user_greetings() {
	/** These are the lyrics to Hello Dolly */
	$geetings = "Hello
	Hi
	Hey
	How's it going
	What's up";
	
	// Here we split it into lines
	$geetings = explode( "\n", $geetings );
	
	// And then randomly choose a line
	return wptexturize( $geetings[ mt_rand( 0, count( $geetings ) - 1 ) ] );
}


/*-------------------------------------------------------------------------------------------
 * Page-level DocBlock
 * @package WordPress
 *-------------------------------------------------------------------------------------------
 *
 * Website Networth
 *
 * This function collects the price for all Woocommerce
 * products. It adds the array of integers together and
 * and then formats them as USD currency.
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */
function sjm_networth( $before, $after ) {

	global $wpdb;

	$totals = $wpdb->get_col( "SELECT meta_value FROM wp_postmeta WHERE meta_key = '_price'");
	
	$sum = 0;
	foreach ($totals as $value) {
	    $sum += $value;
	}
	setlocale(LC_MONETARY, 'en_US');
	echo $before . 'Current Networth' . money_format('%(#10n', $sum) . "\n" . $after;
	unset($value); // break the reference with the last element
}


/*-------------------------------------------------------------------------------------------
 * Page-level DocBlock
 * @package WordPress
 *-------------------------------------------------------------------------------------------
 *
 * Returns the total number of products on the website.
 *
 * @todo Restrict to only published products
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */
function sjm_total_product_posts( $before, $after ){
	
	global $wpdb;
	
	$numposts = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'product'" );
	
	if ( 0 < $numposts )
		echo $before, $numposts = number_format( $numposts ), $after;
}


/*-------------------------------------------------------------------------------------------
 * Page-level DocBlock
 * @package WordPress
 *-------------------------------------------------------------------------------------------
 *
 * Count and display the number of products added to the website each day.
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */

class TodaysPosts {

	//global $wpdb;
	
	public $prop1 = "I'm a class property!";
	private $args = array (
				'post_type' => 'product',
				'post_status' => 'publish',
				'showposts' => -1,
				'caller_get_posts'=> 1
			);
	
	public function filter_where_footer( $where = '' ) {
		global $wpdb;
		//posts in the last 1 day
		$where .= " AND post_date > '" . date( 'Y-m-d', strtotime( '-1 days' ) ) . "'";
		return $where;
	}
	
	public function __construct(){
		add_filter( 'posts_where', 'filter_where_footer' );
	}
	
}






























