<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: Latest Items
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a page ('page' post_type) unless another page template overrules this one.
 * @link http://codex.wordpress.org/Pages
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header('shop');
	global $woo_options;
?>
       
    <div id="content" class="page col-full woocommerce-columns-5">
    
    	<?php woo_main_before(); ?>
    	
		<section id="main" class="col-left"> 			

			<?php
			function filter_where($where = '') {
				//posts in the last 30 days
				$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
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

			if ( $my_query->have_posts() ) { $count = 0; ?>
				<article <?php post_class(); ?>>                                               
							
					<header>
				    	<h1><?php the_title(); ?></h1>
					</header>
					
					<section class="entry">
	                
						<ul class="products">
						
							<?php while ( $my_query->have_posts() ) { $my_query->the_post(); ?> 
								<?php get_template_part( 'woocommerce/content', 'product' ); ?>
							<?php } // End WHILE Loop  ?>
						</ul>

				  <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
				  </section><!-- /.entry -->
	
				  <?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>
            
				<?php // Determine wether or not to display comments here, based on "Theme Options".
	        	if ( isset( $woo_options['woo_comments'] ) && in_array( $woo_options['woo_comments'], array( 'page', 'both' ) ) ) {
	        		comments_template();
	        	}

				?>
			</article><!-- /.post -->
			
			<?php } else {
			?>
			<article <?php post_class(); ?>>
            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
            </article><!-- /.post -->
        <?php } // End IF Statement ?>  
        
		</section><!-- /#main -->
		
		<?php woo_main_after(); ?>

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>