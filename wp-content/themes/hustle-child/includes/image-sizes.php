<?php
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'author-archive-thumb', 150, 200, true ); //300 pixels wide (and unlimited height)
	add_image_size( 'author-archive-thumb', 220, 1180, true ); //(cropped)
}