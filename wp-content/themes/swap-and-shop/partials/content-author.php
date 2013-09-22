<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * The default template for displaying content
 */

	global $woo_options;
?>

	<article <?php post_class(); ?>>
	
	    <?php
		if ( has_post_thumbnail() ) {
			$img_atts = array(
				'alt'	=> trim( strip_tags( $post->post_title ) ),
				'title'	=> trim( strip_tags( $post->post_title ) ),
				'class' => 'thumbnail alignleft author-archive-post-thumb',
			);
			echo '<div class="image-holder alignleft">';
			echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail( $post->ID, 'author-archive-thumb', $img_atts ).'</a>';
			echo '</div>';
		} else {
			echo '<a href=""><img src="'.get_post_meta($post->ID, 'ecpt_imageupload', true).'" /></a>';
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
			<span class="read-more"><a class="button small" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'View Post &rarr;', 'woothemes' ); ?>"><?php _e( 'View Post &rarr;', 'woothemes' ); ?></a></span>
		<?php } ?>
		
		
		</footer>
		<!-- <span class="comments alignright">Comments: <?php// comments_popup_link( __( '0', 'woothemes' ), __( '1', 'woothemes' ), __( '%', 'woothemes' ), '', __( 'Off', 'woothemes' ) ); ?></span> -->
	</article><!-- /.post -->
	
	<hr />