<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * This template is a full-width version of the page.php template file. It removes the sidebar area.
 *
 * @package WooFramework
 * @subpackage Template
 *
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
	get_header();
	global $woo_options;
?>
       
    <div id="content" class="page col-full">
    
    	<?php woo_main_before(); ?>
    	
		<section id="main" class="fullwidth">
           
        <?php if ( have_posts() ) : ?>

			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'All posts by %s', 'twentythirteen' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
			</header><!-- .archive-header -->

			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<?php get_template_part( 'author-bio' ); ?>
			<?php endif; ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'partials/content', 'author' ); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
        
		</section><!-- /#main -->
		
		<?php// woo_main_after(); ?>
		
    </div><!-- /#content -->
		
<?php get_footer(); ?>