<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;

	$total = 4;
	if ( isset( $woo_options['woo_footer_sidebars'] ) && ( $woo_options['woo_footer_sidebars'] != '' ) ) {
		$total = $woo_options['woo_footer_sidebars'];
	}

	if ( ( woo_active_sidebar( 'footer-1' ) ||
		   woo_active_sidebar( 'footer-2' ) ||
		   woo_active_sidebar( 'footer-3' ) ||
		   woo_active_sidebar( 'footer-4' ) ) && $total > 0 ) {

?>	
	<?php woo_footer_before(); ?>
		
	<section id="footer-widgets" class="col-full col-<?php echo $total; ?> fix">


		<?php
		$result = count_users();
		echo '<h2>There are <a href="/The-Market/authors/"><span style="color: #2293e2;">'.$result['total_users'].'</span></a> total users</h2>';
		
		$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'product'");
		if (0 < $numposts) echo '<h2>There have been a total of <a href="/The-Market/market/"><span style="color: #2293e2;">'.$numposts = number_format($numposts).'</span></a> items listed to date.</h2>';
		
		
		
		
		/* Count the amount of products added each day */
		function filter_where($where = '') {
		    //posts in the last 30 days
		    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-1 days')) . "'";
		    return $where;
		  }
		add_filter('posts_where', 'filter_where');
		    $args=array(
		      'post_type' => 'product',
		      'post_status' => 'publish',
		      'showposts' => -1,
		      'caller_get_posts'=> 1
		      );
		$my_query=new WP_Query($args);
		remove_filter('posts_where', 'filter_where');
		
		  if( $my_query->have_posts() ) {
		    echo '<h2>There have been <span style="color: #2293e2;">'.count($my_query->posts) . '</span> items added today.</h2>';
		    while ($my_query->have_posts()) : $my_query->the_post(); ?>
		      <p><small><?php the_time('m.d.y') ?></small> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
		     <?php
		    endwhile;
		  } //if ($my_query)
		wp_reset_query(); //just in case


		?>



		<?php $i = 0; while ( $i < $total ) { $i++; ?>
			<?php if ( woo_active_sidebar( 'footer-' . $i ) ) { ?>

		<div class="block footer-widget-<?php echo $i; ?>">
        	<?php woo_sidebar( 'footer-' . $i ); ?>
		</div>

	        <?php } ?>
		<?php } // End WHILE Loop ?>

	</section><!-- /#footer-widgets  -->
<?php } // End IF Statement ?>
	<footer id="footer">
	
		<div class="col-full">

			<div id="copyright" class="col-left">
			<?php if( isset( $woo_options['woo_footer_left'] ) && $woo_options['woo_footer_left'] == 'true' ) {
					echo stripslashes( $woo_options['woo_footer_left_text'] );
			} else { ?>
				<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ); ?></p>
			<?php } ?>
			</div>
			
			<div id="credit" class="col-right">
        	<?php if( isset( $woo_options['woo_footer_right'] ) && $woo_options['woo_footer_right'] == 'true' ) {
        		echo stripslashes( $woo_options['woo_footer_right_text'] );
			} else { ?>
				<p><?php _e( 'Powered by', 'woothemes' ); ?> <a href="<?php echo esc_url( 'http://www.wordpress.org' ); ?>">WordPress</a>. <?php _e( 'Designed by', 'woothemes' ); ?> <a href="<?php echo ( isset( $woo_options['woo_footer_aff_link'] ) && ! empty( $woo_options['woo_footer_aff_link'] ) ? esc_url( $woo_options['woo_footer_aff_link'] ) : esc_url( 'http://www.woothemes.com/' ) ) ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/woothemes.png' ); ?>" width="74" height="19" alt="Woo Themes" /></a></p>
			<?php } ?>
			</div>
		
		</div>

	</footer><!-- /#footer  -->

</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>