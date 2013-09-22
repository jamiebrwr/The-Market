<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>
       
    <div id="content" class="col-full">
    	
    	<?php woo_main_before(); ?>
    
		<section id="main" class="col-left">
                                                                                
            <div class="page">
				
				<header>
                	<h1><?php _e( 'Your listing has been removed!', 'woothemes' ); ?></h1>
                </header>
                <section class="entry">
                	<p><?php _e( '' ); ?></p>
                </section>

            </div><!-- /.post -->
                                                
        </section><!-- /#main -->
        
        <?php woo_main_after(); ?>

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>