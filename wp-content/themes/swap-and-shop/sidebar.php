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
	
	if ( isset( $woo_options['woo_layout'] ) && ( $woo_options['woo_layout'] != 'layout-full' ) ) {
?>	
<aside id="sidebar" class="col-right">

	<?php woo_sidebar_inside_before(); ?>

	<?php if ( woo_active_sidebar( 'primary' ) || is_singular( 'product' ) ) { ?>
    <div class="primary">
    
    	<?php
		if ( is_user_logged_in() ) { ?>
		   
		   
		   <header style="text-align:center;">
			<a class="button large" style="padding: 1em 6.2em;margin-bottom:3em;" href="/swap-and-shop/post-new-item/">Post Now</a>
		</header>
		   
		   
		<?php } else { ?>
		

			
		    <header style="text-align:center;margin-bottom:3em;">
			<h1>Get Started Today</h1>
			<p>Trade what you don't want for something you do want.</p>
			<a class="button large" style="padding: 1em 5.2em;" href="/swap-and-shop/post-new-item/">Post Now</a>
		</header>
		<?php }
		?>
    
    
		<?php woo_sidebar( 'primary' ); ?>		           
	</div>        
	<?php } // End IF Statement ?>   
	
	<?php woo_sidebar_inside_after(); ?> 
	
</aside><!-- /#sidebar -->
<?php } // End IF Statement ?>