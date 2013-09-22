<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The default template for displaying content
 */

	global $woo_options;
 
/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */

 	$settings = array(
					'thumb_w' => 100, 
					'thumb_h' => 100, 
					'thumb_align' => 'alignleft'
					);
					
	$settings = woo_get_dynamic_values( $settings );
 
?>

	<article <?php post_class(); ?>>
	
	    <?php
		if ( has_post_thumbnail() ) {
			$img_atts = array(
				'alt'	=> trim( strip_tags( $post->post_title ) ),
				'title'	=> trim( strip_tags( $post->post_title ) ),
				'class' => 'thumbnail',
			);
			echo '<div class="image-holder right">';
			echo get_the_post_thumbnail( $post->ID, 'featured-image-size', $img_atts );
			echo '</div>';
		} else {
			echo '<img src="'.get_post_meta($post->ID, 'ecpt_imageupload', true).'" />';
		}
		?>
	    
		<header>
			<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			<?php// woo_post_meta(); ?>
		</header>

		<section class="entry">
		<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content( __( 'Continue Reading &rarr;', 'woothemes' ) ); } else { the_excerpt(); } ?>
		</section>

		<footer class="post-more">      
		<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'excerpt' ) { ?>
			<span class="comments"><?php comments_popup_link( __( '0', 'woothemes' ), __( '1', 'woothemes' ), __( '%', 'woothemes' ), '', __( 'Off', 'woothemes' ) ); ?></span>
			<span class="read-more"><a class="button small" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
		<?php } ?>
		</footer>   

	</article><!-- /.post -->