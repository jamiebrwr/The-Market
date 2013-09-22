<?php 
$settings = array(
				'homepage_intro_message_heading' => '',
				'homepage_intro_message_content' => '',
				'homepage_intro_message_button_label' => '',
				'homepage_intro_message_button_url' => ''
			);
					
$settings = woo_get_dynamic_values( $settings );
?>
<?php if ( '' != $settings['homepage_intro_message_heading'] ) { ?>

<section id="intro-message" class="home-section">
	<header>
		<h1><?php echo stripslashes( esc_attr( $settings['homepage_intro_message_heading'] ) ); ?></h1>
		<p><?php echo stripslashes( esc_attr( $settings['homepage_intro_message_content'] ) ); ?></p>
		<a class="button" href="<?php echo esc_url( $settings['homepage_intro_message_button_url'] ); ?>"><?php echo stripslashes( esc_attr( $settings['homepage_intro_message_button_label'] ) ); ?></a>
	</header>
</section><!--/#intro-message-->
<?php } ?>