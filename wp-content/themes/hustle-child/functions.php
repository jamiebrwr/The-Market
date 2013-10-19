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
 * Add Custom Post Types to Author Archives Page in WordPress
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * @link http://isabelcastillo.com/add-custom-post-types-to-author-archives-wordpress
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */

function custom_post_author_archive($query) {
    if ($query->is_author)
        $query->set( 'post_type', array('product') );
    
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}


/*-------------------------------------------------------------------------------------------
 * Page-level DocBlock
 * @package WordPress
 *-------------------------------------------------------------------------------------------
 *
 * Remove Admin Bar for everyonw except Administrator
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * @link http://isabelcastillo.com/add-custom-post-types-to-author-archives-wordpress
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}


/*-------------------------------------------------------------------------------------------
 * Page-level DocBlock
 * @package WordPress
 *-------------------------------------------------------------------------------------------
 *
 * Woocommerce: assign an “author” to a product
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * @link http://wordpress.stackexchange.com/questions/74054/woocommerce-assign-an-author-to-a-product
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */
add_action('init', 'wpse_74054_add_author_woocommerce', 999 );

function wpse_74054_add_author_woocommerce() {
    add_post_type_support( 'product', 'author' );
}


/*-------------------------------------------------------------------------------------------
 * Page-level DocBlock
 * @package WordPress
 *-------------------------------------------------------------------------------------------
 *
 * Display 24 products per page. Goes in functions.php
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 15;' ), 20 );


/*-------------------------------------------------------------------------------------------
 * Page-level DocBlock
 * @package WordPress
 *-------------------------------------------------------------------------------------------
 *
 * List all WP Users
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */
function contributors() {
global $wpdb;
$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");

$counter = 1;

echo '<ul class="products">';
foreach($authors as $author) {
	$first = ($counter % 6 == 0) ? ' first' : '';
	$last = ($counter % 5 == 0) ? ' last' : '';
		echo '<li class="product', $first, $last,'">';
			echo '<a href="'.get_bloginfo('url').'/?author='.$author->ID.'">'.get_avatar($author->ID).'</a>';
			echo '<a href="'.get_bloginfo('url').'/?author='.$author->ID.'">'.get_the_author_meta('display_name', $author->ID).'</a>';
		echo '</li>';
		$counter++;
	}
echo '</ul>';
}


/*-------------------------------------------------------------------------------------------
 * Page-level DocBlock
 * @package WordPress
 *-------------------------------------------------------------------------------------------
 *
 * Remove Reviews from bottom of single product
 * 
 * @access public
 * @param $variable 
 * @since 1.0
 * @subpackage Woocommerce
 * 
 * @author: Jamie Brewer ( jamie.brwr@gmail.com )
 * 
 */
add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {

 unset($tabs['reviews']);

 return $tabs;
}
 
 
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
function srh_user_greetings() {
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
function srh_networth( $before, $after ) {

	global $wpdb;

	$totals = $wpdb->get_col( "SELECT meta_value FROM wp_postmeta WHERE meta_key = '_price'");
	
	$sum = 0;
	foreach ($totals as $value) {
	    $sum += $value;
	}
	setlocale(LC_MONETARY, 'en_US');
	//echo $before . 'Current Networth' . money_format('%(#10n', $sum) . "\n" . $after;
	echo '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- GardnerNews -->
<ins class="adsbygoogle alignleft"
     style="display:inline-block;width:468px;height:60px;margin-bottom:10px;"
     data-ad-client="ca-pub-9962188280666928"
     data-ad-slot="1519242779"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- GardnerNews -->
<ins class="adsbygoogle alignright"
     style="display:inline-block;width:468px;height:60px;margin-bottom:10px;"
     data-ad-client="ca-pub-9962188280666928"
     data-ad-slot="1519242779"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
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
function srh_total_product_posts( $before, $after ){
	
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






























