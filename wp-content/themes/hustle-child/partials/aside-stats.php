<?php
$result = count_users();
echo '<h3>There are <a href="/The-Market/authors/"><span style="color: #2293e2;">'.$result['total_users'].'</span></a> total users</h3>';

$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'product'");
if (0 < $numposts) echo '<h3>There have been a total of <a href="/The-Market/market/"><span style="color: #2293e2;">'.$numposts = number_format($numposts).'</span></a> items listed to date.</h3>';

/* Count the amount of products added each day */
  function filter_where_footer($where = '') {
	    //posts in the last 30 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-1 days')) . "'";
	    return $where;
	  }
	add_filter('posts_where', 'filter_where_footer');
	    $args=array(
	      'post_type' => 'product',
	      'post_status' => 'publish',
	      'showposts' => -1,
	      'caller_get_posts'=> 1
	      );
	$my_query2=new WP_Query($args);
	remove_filter('posts_where', 'filter_where_footer');
	
	  if( $my_query2->have_posts() ) {
	    echo '<h3>There have been <a href="/The-Market/todays-new-items/"><span style="color: #2293e2;">'.count($my_query2->posts) . '</span></a> items added to the site today!</h3>';
	    while ($my_query2->have_posts()) : $my_query2->the_post();
	    endwhile;
	  } //if ($my_query)
	wp_reset_query(); //just in case
	?>