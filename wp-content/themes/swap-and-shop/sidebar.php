<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 * Sidebar Template
 *
 * If a `primary` widget area is active and has widgets, display the sidebar.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;
	global $post, $product;
	global $wpdb;
	
	if ( isset( $woo_options['woo_layout'] ) && ( $woo_options['woo_layout'] != 'layout-full' ) ) {
?>	
<aside id="sidebar" class="col-right">

	<?php woo_sidebar_inside_before(); ?>

	<?php if ( woo_active_sidebar( 'primary' ) || is_singular( 'product' ) ) { ?>
    <div class="primary">

    	<?php $current_user = wp_get_current_user(); ?>
    	
    	<?php $chosen = sjm_user_greetings(); ?>

		<?php if ( is_user_logged_in() ) { ?>
		
			<div class="author-info widget">
				<div class="author-avatar">
					<?php echo get_avatar( $current_user->user_email, $current_user->ID, apply_filters( 'twentythirteen_author_bio_avatar_size', 120 ) ); ?>
				</div><!-- .author-avatar -->
				<ul style="clear:none;margin:0 0 0 40%;">
					<li><h3><?php echo $chosen; ?> <?php printf( __( '%s', 'twentythirteen' ), $current_user->display_name ); ?></h3></li>
					<li><a href="http://me.co/The-Market/wp-admin/">View Dashboard</a></li>
					<li><a href="http://me.co/The-Market/wp-admin/profile.php">Edit Profile</a></li>
					<li><a href="http://me.co/The-Market/logout/?_wpnonce=89d224e7f0">Log Out</a></li>
					<!-- <li><a class="button" href="#">Post Something</a></li> -->
				</ul>
				<hr />
			</div>
		   
		   <header style="text-align:center;">
				<a class="button large" style="padding:1em 6.2em;margin-bottom:1em;" href="/The-Market/post-new-item/">Post Now</a>
			</header>
		   
		<?php } else { ?>

			<header style="text-align:center;margin-bottom:3em;">
				<h1>Get Started Today</h1>
				<p>Trade what you don't want for something you do want.</p>
				<a class="button large" style="padding:1em 6.2em;" href="http://me.co/The-Market/wp-login.php?action=register">Register</a>
			</header>
		
		<?php } ?> <!-- End if statement -->
    
    
		<?php woo_sidebar( 'primary' ); ?>		           
	</div>        
	<?php } // End IF Statement ?>   
	
	<?php woo_sidebar_inside_after(); ?> 
	
</aside><!-- /#sidebar -->
<?php } // End IF Statement ?>