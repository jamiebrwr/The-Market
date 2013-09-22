<?php 
function ecpt_field_shortcode( $atts, $content = null )
{
	global $ecpt_prefix;
	global $post;
	
	extract( shortcode_atts( array(
			'id' => '',
			'image' => 'false',
			'url' => 'true',
			'new_window' => 'true'
		), $atts )
	);
	 
	$meta = get_post_meta($post->ID, $ecpt_prefix . $id, true);
	 
	$blank = $new_window == 'true' ? true : false;
	
	if($image != 'false' && !is_array($meta)) {
		
		if($url != 'false') { $field .= '<a href="' . $url . '">'; }
		$field .= '<img src="' . $meta . '">';
		if($url != 'false') { $field .= '</a>'; }
		
	} else {
	
		$field_type = ecpt_get_field_type($id);
	
		if(is_array($meta)) {
			// this is a repeatable field
			$field .= '<ul class="ecpt_repeatable_field">';
				foreach($meta as $value) {
					if($image == 'true') {
						$field .= '<li><img src="' . $value . '"/></li>'; 
					} else {
						$field .= '<li>' . ecpt_filter_links($value, $blank) . '</li>';
					}
				}
			$field .= '</ul>';
		} else {
			if($field_type == 'date') {
				// this is a date field
				$field .= ecpt_get_date($meta);
			} else {
				if($url == 'false') {
					$field .= $meta;
				} else {
					$field .= ecpt_filter_links($meta, $blank);
				}
			}
		}
	}
	
	return $field;
}
add_shortcode('ecpt_field', 'ecpt_field_shortcode');

function ecpt_query_posts_shortcode($atts, $content = null ) {

	extract( shortcode_atts( 
		array(
    		'post_type' => 'post',
    		'tax' => '',
			'terms' => '',
			'number' => 5,
			'orderby' => 'post_date',
			'order' => 'ASC',
			'thumbnails' => 'no',
			'thumb_size' => 30
    	), $atts ) 
	);
	
	if($terms) {
		if(strpos($terms, ',')) {
			$terms = explode(',', $terms);
		}
	}
	if(strlen(trim($tax)) > 0) {
		
		$tax_query = array(
			array(
				'taxonomy' => $tax,
				'terms' => $terms,
				'field' => 'slug'
			)
		);
	} else {
		$tax_query = array();
	}
	
	$display = '<ul>';
	
	$post_args = array('post_type' => $post_type, 'tax_query' => $tax_query, 'numberposts' => $number, 'orderby' => $orderby, 'order' => $order);
	$posts = get_posts($post_args);
	if($posts) {
		if($thumbnails == 'yes') {
			$display .= '<style type="text/css">.ecpt_post_with_thumb img { float: left; margin: 0 5px 0 0; }</style>';
		}
		foreach ($posts as $p) {
			if($thumbnails == 'yes' && has_post_thumbnail($p->ID)) {
				$display .= '<li class="ecpt_post_with_thumb" style="height: ' . intval($thumb_size) . 'px; line-height: ' . intval($thumb_size) . 'px">';
					$display .= '<a href="' . get_permalink($p->ID) . '">' . get_the_post_thumbnail($p->ID, array($thumb_size, $thumb_size)) . '</a>';
					$display .= '<a href="' . get_permalink($p->ID) . '">' . get_the_title($p->ID) . '</a>';
				$display .= '</li>';
			} else {
				$display .= '<li><a href="' . get_permalink($p->ID) . '">' . get_the_title($p->ID) . '</a></li>';
			}
		}
	} else {
		$display .= '<li>No posts found</li>';
	}
	
	$display .= '</ul>';
	
	return $display;
}
add_shortcode('ecpt_query', 'ecpt_query_posts_shortcode');

if(isset($ecpt_options['do_shortcode_filter']) && $ecpt_options['do_shortcode_filter'] == true) {
	// enable short codes within meta box fields
	add_filter('the_content', 'do_shortcode');
}