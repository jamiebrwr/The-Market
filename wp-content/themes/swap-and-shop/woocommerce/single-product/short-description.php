<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( ! $post->post_excerpt ) return;
?>
<div itemprop="description">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
</div>
<?php

global $current_user;
      get_currentuserinfo();

		if ( is_user_logged_in() ) {
		   
		   
		   //echo '<strong>Username:</strong> ' . $current_user->user_login . "<br />";
	      echo '<a class="button" href="mailto:' . $current_user->user_email . '">Contact Seller</a>';
	      //echo '<strong>User first name:</strong> ' . $current_user->user_firstname . "<br />";
	      //echo '<strong>User last name:</strong> ' . $current_user->user_lastname . "<br />";
	      //echo '<strong>User display name:</strong> ' . $current_user->display_name . "<br />";
	      //echo '<strong>User ID:</strong> ' . $current_user->ID . "<br />";
	      echo '<p>&nbsp;</p>';
		   
		   
		} else {
		
		//echo '<strong>Username:</strong> ' . $current_user->user_login . "<br />";
	      echo 'You must '.wp_register( '<span class="button">', '<span>', false).' to contact the seller.';
	      //echo '<strong>User first name:</strong> ' . $current_user->user_firstname . "<br />";
	      //echo '<strong>User last name:</strong> ' . $current_user->user_lastname . "<br />";
	      //echo '<strong>User display name:</strong> ' . $current_user->display_name . "<br />";
	      //echo '<strong>User ID:</strong> ' . $current_user->ID . "<br />";
	      echo '<p>&nbsp;</p>';

		}
		


if ( ! $post->post_excerpt ) return;