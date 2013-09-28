<?php


function filter_where_footer( $where = '' ) {
	global $wpdb;
	//posts in the last 1 day
	$where .= " AND post_date > '" . date( 'Y-m-d', strtotime( '-1 days' ) ) . "'";
	return $where;
	}
	
	
	add_filter( 'posts_where', 'filter_where_footer' );
	
	$args = array (
		'post_type' => 'product',
		'post_status' => 'publish',
		'showposts' => -1,
		'caller_get_posts'=> 1
	);
	
	/* Create New Query Object */
	$todays_posts = new WP_Query( $args );
	
	remove_filter( 'posts_where', 'filter_where_footer' );

	if( $todays_posts->have_posts() ) {
		echo '<h3>There have been <a href="/The-Market/todays-new-items/"><span style="color: #2293e2;">'.count($todays_posts->posts) . '</span></a> items added to the site today!</h3>';
		while ($todays_posts->have_posts()) : $todays_posts->the_post();
		endwhile;
	}

wp_reset_query(); //just in case