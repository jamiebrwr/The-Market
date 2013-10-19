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

		if ( is_user_logged_in() ) { ?>
		   
		   
		   <p><a class="button" href="mailto:<?php echo get_the_author_meta('user_email', $post->post_author); ?>">Contact Seller</a></p>
		   
		   
		<?php } else {
			
			echo '<em><strong>You must <a href="http://me.co/The-Market/wp-login.php?action=register">Register</a> to contact the seller.</strong></em>';
			echo '<p>&nbsp;</p>';

		}
		


if ( ! $post->post_excerpt ) return;