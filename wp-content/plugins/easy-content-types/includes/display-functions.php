<?php

/*
** Shows the saved values of all ECPT meta fields for a post
** @param $metabox string - the name of the metabox from which to display field info
** @param $type string/array - 'all' to display all fields, or specific type to limit display to one type of field. Field types match
** those in the field creation screen. An array of field types is also accepted
** @param $descriptions boolean - true/false - whether to display field descriptions
** @param $images boolean - true/false - whether to convert upload fields with image URL to HTML img tags
** @param $dateformat string - the format to display dates
** @param $blank boolean - true to open links in new windows, false to open in same
** @param $repeatable_images boolean - true to render images, false to leave as URLs
*/
function ecpt_display_meta($metabox, $type = 'all', $descriptions = true, $images = true, $dateformat = 'F j, Y', $blank = true, $repeatable_images = false) {
	global $post;
	global $wpdb;
	global $ecpt_db_meta_name;
	global $ecpt_db_meta_fields_name;

	if($metabox) {

		$display = '<ul class="ecpt_meta">';

		// figure out which fields we are going to display
		if( is_string( $type ) ) {
			if($type == 'all') { // display all meta fields
				$fields = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " WHERE parent='%s' ORDER BY list_order;", $metabox ) );
			} else {
				$fields = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " WHERE parent='%s' AND type='%s' ORDER BY list_order;", $metabox, $type ) );
			}
		} else {
			$types = ''; $i = 0;
			foreach($type as $t) {
				if($i == 0) {
					$types .= "type='" . $t . "'";
				} else {
					$types .= " OR type='" . $t . "'";
				}
				$i++;
			}
			$fields = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " WHERE parent='%s' AND (" . $types . ") ORDER BY list_order;", $metabox ) );
		}

		// display the fields
		if($fields) {

			foreach( $fields as $key => $field) {

				$field_type = $field->type;
				$value = get_post_meta($post->ID, 'ecpt_' . $field->name, true);

				switch($field_type) {

					case 'text' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<div class="ecpt_field_name">' . utf8_decode( $field->nicename ) . '</div>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								$display .= '<div class="ecpt_field_content">' . apply_filters('ecpt_text_render', ecpt_filter_links( html_entity_decode( $value ), $blank ) ) . '</div>';
							$display .= '</li>';
						}
						break;

					case 'textarea' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<div class="ecpt_field_name">' . utf8_decode($field->nicename) . '</div>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								if($field->rich_editor == 1) {
									$display .= '<div class="ecpt_field_content">' . apply_filters('ecpt_textarea_render', $value) . '</div>';
								} else {
									$display .= '<div class="ecpt_field_content">' . apply_filters('ecpt_textarea_render', ecpt_filter_links(html_entity_decode($value), $blank)) . '</div>';
								}
							$display .= '</li>';
						}
						break;

					case 'upload' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<span class="ecpt_field_name">' . utf8_decode($field->nicename) . ': </span>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								$extension_array = array('jpg', 'jpeg', 'gif', 'png', 'tif', 'tiff;');
								$ext = ecpt_get_extension($value);
								if($images && in_array($ext, $extension_array)) {
									$display .= '<div class="ecpt_field_content"><img src="' . $value . '"/></div>';
								} else {
									$display .= '<span class="ecpt_field_content"><a href="' . $value . '">' . $value . '</a></span>';
								}
							$display .= '</li>';
						}
						break;

					case 'select' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<span class="ecpt_field_name">' . utf8_decode($field->nicename) . ': </span>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								$display .= '<span class="ecpt_field_content">' . $value . '</span>';
							$display .= '</li>';
						}
						break;

					case 'date' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<span class="ecpt_field_name">' . utf8_decode($field->nicename) . ': </span>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								$display .= '<span class="ecpt_field_content">' . date_i18n($dateformat, $value) . '</span>';
							$display .= '</li>';
						}
						break;

					case 'slider' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<span class="ecpt_field_name">' . utf8_decode($field->nicename) . ': </span>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								$display .= '<span class="ecpt_field_content">' . $value . '</span>';
							$display .= '</li>';
						}
						break;

					case 'radio' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<span class="ecpt_field_name">' . utf8_decode($field->nicename) . ': </span>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								$display .= '<span class="ecpt_field_content">' . $value . '</span>';
								$display .= '</li>';
						}
						break;

					case 'multicheck' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<span class="ecpt_field_name">' . utf8_decode($field->nicename) . ': </span>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								$display .= '<ul class="ecpt_multicheck_field_values">';
									foreach($value as $v) {
										if($v != '') {
											$display .= '<li>' . html_entity_decode($v) . '</li>';
										}
									}
								$display .= '</ul>';
								$display .= '</li>';
						}
						break;

					case 'checkbox' :
						$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
							$display .= '<span class="ecpt_field_name">' . utf8_decode($field->nicename) . ': </span>';
							if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
							$display .= '<span class="ecpt_field_content">';
							if($value) { $display .= __('yes','ecpt'); } else { $display .= __('no','ecpt'); }
							$display .= '</span>';
						$display .= '</li>';

						break;
					case 'repeatable' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<div class="ecpt_field_name">' . utf8_decode($field->nicename) . '</div>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								$display .= '<ul class="ecpt_repeatable_field_values">';
									foreach($value as $v) {
										if($v != '') {
											$display .= '<li>' . ecpt_filter_links(html_entity_decode($v), $blank) . '</li>';
										}
									}
								$display .= '</ul>';
							$display .= '</li>';
						}
						break;

					case 'repeatable upload' :
						if($value) {
							$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . utf8_decode($field->name) . '">';
								$display .= '<div class="ecpt_field_name">' . utf8_decode($field->nicename) . '</div>';
								if($descriptions) {
									$display .= '<div class="ecpt_field_desc">' . stripslashes( utf8_decode($field->description) ) . '</div>';
								}
								$display .= '<ul class="ecpt_repeatable_field_values">';
									foreach($value as $v) {
										if($v != '') {
											$display .= '<li>';
												$extension_array = array('jpg', 'jpeg', 'gif', 'png', 'tif', 'tiff;');
												$ext = ecpt_get_extension($v);
												if($repeatable_images && in_array($ext, $extension_array)) {
													$display .= '<div class="ecpt_field_content"><img src="' . $v . '"/></div>';
												} else {
													$display .= '<span class="ecpt_field_content"><a href="' . $v . '">' . $v . '</a></span>';
												}
											$display .= '</li>';
										}
									}
								$display .= '</ul>';
							$display .= '</li>';
						}
						break;

					default :

						break;

				} // end switch

				if(has_filter('ecpt_display_fields')) {
					$display = apply_filters('ecpt_display_fields', $display, $value, $field, $descriptions );
				}

			} // end foreach
		} // end if($fields)
		$display .= '</ul><!--end ul.ecpt_meta -->';
	} // end if($metabox)

	return $display;
}

// this function does all of the checks necessary to see how fields should be automatically rendered
function ecpt_auto_display_meta($content) {

	global $post;
	global $wpdb;
	global $ecpt_options;
	global $ecpt_db_meta_name;

	if(isset($ecpt_options['auto_display_meta_fields_' . $post->post_type])) {
		if(is_singular() && isset( $ecpt_options['auto_display_meta_fields_' . $post->post_type] ) ) {
			$metaboxes = $wpdb->get_results( "SELECT `name` FROM " . $wpdb->escape( $ecpt_db_meta_name ) . " WHERE `page` LIKE '%%" . $wpdb->escape( $post->post_type ) . "%%';" );
			if($metaboxes) {

				foreach($metaboxes as $metabox) {
					//ecpt_display_meta($metabox, $type = 'all', $descriptions = true, $images = true, $dateformat = 'F j, Y')

					$desc = false;

					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_desc']))
						$desc = true;

					// setup the field types to display
					$types = array();
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_text']))
						$types[] = 'text';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_textarea']))
						$types[] = 'textarea';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_date']))
						$types[] = 'date';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_slider']))
						$types[] = 'slider';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_select']))
						$types[] = 'select';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_radio']))
						$types[] = 'radio';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_checkbox']))
						$types[] = 'checkbox';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_multicheck']))
						$types[] = 'multicheck';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_upload']))
						$types[] = 'upload';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_repeatable']))
						$types[] = 'repeatable';
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_repeatable_upload']))
						$types[] = 'repeatable upload';

					if(has_filter('ecpt_enabled_types_for_auto_display')) {
						$types = apply_filters('ecpt_enabled_types_for_auto_display', $types, $post->post_type);
					}

					// if no fields were select, we assume all field types
					if(empty($types))
						$types = 'all';

					// check whether images should be rendered
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_upload_image']))
						$images = true;
					else
						$images = false;

					// check whether repeatable images should be rendered
					if(isset($ecpt_options['meta_fields_' . $post->post_type . '_repeatable_upload_image']))
						$repeatable_images = true;
					else
						$repeatable_images = false;

					$date_format = get_option('date_format');

					$content .= ecpt_display_meta($metabox->name, $types, $desc, $images, $date_format, true, $repeatable_images);

				} // end foreach
			} //end if ($metaboxes)
		} // if(is_singular())
	} // end isset
	// return the modified post content
	return $content;
}
add_filter('the_content', 'ecpt_auto_display_meta');

// converts URLs to clickabke links
function ecpt_filter_links($value, $blank = true) {

	if(strpos($value, 'iframe') !== false)
		return $value;

	$target = '';
	if($blank)
		$target = 'target="_blank"';

	return  preg_replace(
		array(
			'/(?(?=<a[^>]*>.+<\/a>)
				 (?:<a[^>]*>.+<\/a>)
				 |
				 ([^="\']?)((?:https?|ftp|bf2|):\/\/[^<> \n\r]+)
			 )/iex',
			'/<a([^>]*)target="?[^"\']+"?/i',
			'/<a([^>]+)>/i',
			'/(^|\s)(www.[^<> \n\r]+)/iex',
			'/(([_A-Za-z0-9-]+)(\\.[_A-Za-z0-9-]+)*@([A-Za-z0-9-]+)
			(\\.[A-Za-z0-9-]+)*)/iex'
		),
		array(
			"stripslashes((strlen('\\2')>0?'\\1<a href=\"\\2\">\\2</a>\\3':'\\0'))",
			'<a\\1',
			'<a\\1 ' . $target . '>',
			"stripslashes((strlen('\\2')>0?'\\1<a " . $target . " href=\"http://\\2\">\\2</a>\\3':'\\0'))",
			"stripslashes((strlen('\\2')>0?'<a href=\"mailto:\\0\">\\0</a>':'\\0'))"
		),
		$value
	);
}

function ecpt_do_shortcode_filter($data) {
	return do_shortcode($data);
}
add_filter('ecpt_textarea_render', 'ecpt_do_shortcode_filter');
add_filter('ecpt_text_render', 'ecpt_do_shortcode_filter');