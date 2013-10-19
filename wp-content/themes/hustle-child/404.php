<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>
       
    <div id="content" class="col-full">
    	
    	<?php woo_main_before(); ?>
    
		<section id="main" class="col-left">
		
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
	                	<?php contributors(); ?>
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
	                	<p>You're a visitor! Please <a href="<?php echo bloginfo('url'); ?>/wp-login.php?action=register">register</a> to make post.</p>
	                	<p><span>Or <a href="<?php echo bloginfo('url'); ?>/wp-login.php">login</a> if you're already registered.</span></p>
	               	</section><!-- /.entry -->

					<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>

                </article><!-- /.post -->
                <?php
		}
		?>
        
		</section><!-- /#main -->
        
        <?php woo_main_after(); ?>

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>