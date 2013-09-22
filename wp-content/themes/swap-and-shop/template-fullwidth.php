<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Template Name: My Account
 *
 * This template is a full-width version of the page.php template file. It removes the sidebar area.
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;
?>   
    <div id="content" class="page col-full">
    
    	<?php woo_main_before(); ?>
    	
		<section id="main" class="fullwidth">
		
		<?php
		if ( is_user_logged_in() ) { ?>
		     <?php
        	if ( have_posts() ) { $count = 0;
        		while ( have_posts() ) { the_post(); $count++;
        ?>                                                             
                <article <?php post_class(); ?>>
					
					<header>
						<h1><?php the_title(); ?></h1>
					</header>
                    
                    <section class="entry">
	                	<?php the_content(); ?>
	               	</section><!-- /.entry -->

					<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>

                </article><!-- /.post -->
                                                    
			<?php
					} // End WHILE Loop
				} else {
			?>
				<article <?php post_class(); ?>>
                	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
                </article><!-- /.post -->
            <?php }
		} else { ?>
		
			<article <?php post_class('register-notice'); ?>>
					
					<header>
						<h1>Whoa Partner</h1>
					</header>
                    
                    <section class="entry">
	                	<p>You're a visitor! Please <a href="http://me.co/swap-and-shop/wp-login.php?action=register">register</a> to make post.</p>
	                	<p><span>Or <a href="http://me.co/swap-and-shop/wp-login.php">login</a> if you're already registered.</span></p>
	               	</section><!-- /.entry -->

					<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>

                </article><!-- /.post -->
                <?php
		}
		?>
        
		</section><!-- /#main -->
		
		<?php woo_main_after(); ?>
		
    </div><!-- /#content -->
		
<?php get_footer(); ?>