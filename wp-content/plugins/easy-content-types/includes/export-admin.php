<?php
/**********************************
* This page displays all export code
* I know the code is ugly, but it
* will be updated when 3.3 is
* released with a new meta API
**********************************/

function ecpt_export_page() {

	global $wpdb;
	global $wp_version;
	global $ecpt_prefix;
  	global $ecpt_db_name;
  	global $ecpt_db_tax_name;
  	global $ecpt_db_meta_name;
  	global $ecpt_db_meta_fields_name;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;
	?>
	<div class="wrap">
	<div id="ecpt-wrap">
		<h2><?php _e('Export Post Types, Taxonomies, and Metaboxes', 'ecpt'); ?></h2>
		<p><?php _e('The code provided on this page will allow you to "export" your created post types, taxonomies, and metaboxes to other WordPress installs very easily. Simply copy the given code and paste it into your theme\'s functions.php.', 'ecpt'); ?>

		<div class="postbox-container" style="width:70%;">
				<div class="metabox-holder">
					<div class="meta-box-sortables">

						<!--Post Type Export-->
						<div class="postbox closed">
							<div class="handlediv" title="Click to toggle"><br /></div>
							<h3 class="hndle"><span><?php _e('Custom Post Type Export Code', 'ecpt') ?></span></h3>
							<div class="inside ecpt-clearfix">

<pre class="code php">
<?php
$post_types = ecpt_get_cached_post_types();
foreach( $post_types as $key => $type)
{

	$default_labels = array(
		'name' 				=> _x( utf8_decode($type->plural_name), 'post type general name' ),
		'singular_name'		=> _x( utf8_decode($type->singular_name), 'post type singular name' ),
		'add_new' 			=> _x( 'Add New ' . utf8_decode($type->singular_name), 'post type add new'),
		'add_new_item' 		=> __( 'Add New ' . utf8_decode($type->singular_name) ),
		'edit_item' 		=> __( 'Edit ' . utf8_decode($type->singular_name) ),
		'new_item' 			=> __( 'New ' . utf8_decode($type->singular_name) ),
		'view_item' 		=> __( 'View ' . utf8_decode($type->singular_name) ),
		'all_items' 		=> __( 'All ' . utf8_decode($type->plural_name) ),
		'search_items' 		=> __( 'Search ' . utf8_decode($type->plural_name) ),
		'not_found' 		=> __( 'No ' . utf8_decode($type->plural_name) . ' found' ),
		'not_found_in_trash'=> __( 'No ' . utf8_decode($type->plural_name) . ' found in Trash' ),
		'parent_item_colon' => ''
	);
	if(!empty($type->labels)) {
		$advanced_labels = maybe_unserialize($type->labels);
		foreach($advanced_labels as $key => $label) {
			if($label == '') {
				$advanced_labels[$key] = $default_labels[$key];
			}
		}
		$labels = array(
			'name'              => _x( $type->plural_name, 'post type general name' ),
			'singular_name'     => _x( $type->singular_name, 'post type singular name' ),
			'add_new'           => _x( $advanced_labels['add_new'], 'post type add new'),
			'add_new_item'      => __( $advanced_labels['add_new_item'] ),
			'edit_item'         => __( $advanced_labels['edit_item'] ),
			'new_item'          => __( $advanced_labels['new_item'] ),
			'view_item'         => __( $advanced_labels['view_item'] ),
			'all_items'         => __( $advanced_labels['all_items'] ),
			'search_items'      => __( $advanced_labels['search_items'] ),
			'not_found'         => __( $advanced_labels['not_found'] ),
			'not_found_in_trash'=> __( $advanced_labels['not_found_in_trash'] ),
			'parent_item_colon' => __( $advanced_labels['parent_item_colon'] ),
			'menu_name'         => __( $advanced_labels['menu_name'] )
		);
	} else {
		$labels = $default_labels;
	}

	echo "// registration code for $type->name post type
	";
	echo "function register_" . str_replace('-', '_', $type->name) . "_posttype() {";
		echo "
		&#36labels = array(
			'name' 				=> _x( '" . utf8_decode($type->plural_name) . "', 'post type general name' ),
			'singular_name'		=> _x( '" . utf8_decode($type->singular_name) . "', 'post type singular name' ),
			'add_new' 			=> __( '" . $labels['add_new'] . "' ),
			'add_new_item' 		=> __( '" . $labels['add_new_item'] . "' ),
			'edit_item' 		=> __( '" . $labels['edit_item'] . "' ),
			'new_item' 			=> __( '" . $labels['new_item'] . "' ),
			'view_item' 		=> __( '" . $labels['view_item'] . "' ),
			'search_items' 		=> __( '" . $labels['search_items'] . "' ),
			'not_found' 		=> __( '" . $labels['not_found'] . "' ),
			'not_found_in_trash'=> __( '" . $labels['not_found_in_trash'] . "' ),
			'parent_item_colon' => __( '" . $labels['parent_item_colon'] . "' ),
			'menu_name'			=> __( '" . $labels['menu_name'] . "' )
		);
		";

		if($type->hierarchical == 1) { $hierarchical = 'true'; } else { $hierarchical = 'false'; }
		if($type->has_archive == 1) { $archive = 'true'; } else { $archive = 'false'; }
		if($type->with_front == 1) { $with_front = 'false'; } else { $with_front = 'true'; }
		if($type->exclude_from_search == 1) { $exclude_from_search = 'true'; } else { $exclude_from_search = 'false'; }
		if($type->show_in_nav_menus == 1) { $show_in_nav_menus = 'true'; } else { $show_in_nav_menus = 'false'; }

		// check for supports options
		$supports = array();
		if($type->title == 1) 			{ $supports[] = 'title'; }
		if($type->editor == 1) 			{ $supports[] = 'editor'; }
		if($type->author == 1) 			{ $supports[] = 'author'; }
		if($type->thumbnail == 1) 		{ $supports[] = 'thumbnail'; }
		if($type->excerpt == 1) 		{ $supports[] = 'excerpt'; }
		if($type->fields == 1) 			{ $supports[] = 'custom-fields'; }
		if($type->comments == 1) 		{ $supports[] = 'comments'; }
		if($type->revisions == 1) 		{ $supports[] = 'revisions'; }
		if($type->post_formats == 1) 	{ $supports[] = 'post-formats'; }
		if($type->hierarchical == 1) 	{ $supports[] = 'page-attributes'; } // page attributes are based on hierarchy

		$taxonomies = array();

		if($type->post_tags == 1) 		{ $taxonomies[] = 'post_tag'; }
		if($type->categories == 1) 		{ $taxonomies[] = 'category'; }
		$menu_position = ! empty( $type->menu_position ) ? $type->menu_position : null;
		$t_count = count($taxonomies) -1;
		echo "
		&#36taxonomies = array(";
			foreach($taxonomies as $key => $t) {
				if($key == $t_count) {
					echo "'" . $t . "'";
				} else {
					echo "'" . $t . "'" . ', ';
				}
			}
		echo ");

		&#36supports = array(";
		$supports_string = '';
		foreach ($supports as $support) { $supports_string .= "'" . $support . "',"; }
		echo substr($supports_string, 0, strlen($supports_string)-1) . ");
		";

		echo "
		&#36post_type_args = array(
			'labels' 			=> &#36labels,
			'singular_label' 	=> __('$type->singular_name'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> $exclude_from_search,
			'show_in_nav_menus'	=> $show_in_nav_menus,
			'capability_type' 	=> 'post',
			'has_archive' 		=> $archive,
			'hierarchical' 		=> $hierarchical,
			'rewrite' 			=> array('slug' => '$type->slug', 'with_front' => $with_front ),
			'supports' 			=> &#36supports,
			'menu_position' 	=> {$menu_position},
			'menu_icon' 		=> '$type->menu_icon',
			'taxonomies'		=> &#36taxonomies
		 );
		 ";
		echo "register_post_type('$type->name',&#36post_type_args);
	}
	";
	echo "add_action('init', 'register_" . str_replace('-', '_', $type->name) . "_posttype');";
}
?>
</pre>
						</div><!-- end inside -->
					</div><!-- END postbox -->

					<div class="postbox closed">
						<div class="handlediv" title="Click to toggle"><br /></div>
						<h3 class="hndle"><span><?php _e('Taxonomy Export Code', 'ecpt'); ?></span></h3>
						<div class="inside">
<pre class="code php">
	<?php
	$taxonomies = ecpt_get_cached_taxonomies();
	foreach( $taxonomies as $key => $tax)
	{
		echo '<div class="export-code">
		';
		echo "// registration code for $tax->name taxonomy
		";
		echo "function register_" . str_replace('-', '_', strtolower($tax->name)) . "_tax() {";
			echo "
			&#36labels = array(
				'name' 					=> _x( '" . utf8_decode($tax->plural_name) . "', 'taxonomy general name' ),
				'singular_name' 		=> _x( '" . utf8_decode($tax->singular_name) . "', 'taxonomy singular name' ),
				'add_new' 				=> _x( 'Add New " . utf8_decode($tax->singular_name) . "', '$tax->singular_name'),
				'add_new_item' 			=> __( 'Add New " . utf8_decode($tax->singular_name) . "' ),
				'edit_item' 			=> __( 'Edit " . utf8_decode($tax->singular_name) . "' ),
				'new_item' 				=> __( 'New " . utf8_decode($tax->singular_name) . "' ),
				'view_item' 			=> __( 'View " . utf8_decode($tax->singular_name) . "' ),
				'search_items' 			=> __( 'Search " . utf8_decode($tax->plural_name) . "' ),
				'not_found' 			=> __( 'No " . utf8_decode($tax->singular_name) . " found' ),
				'not_found_in_trash' 	=> __( 'No " . utf8_decode($tax->singular_name) . " found in Trash' ),
			);
			";
			if($tax->hierarchical == 1) 		{ $hierarchical = 'true'; } else { $hierarchical = 'false'; }
			if($tax->show_tagcloud == 1) 		{ $tagcloud = 'true'; } else { $tagcloud = 'false'; }
			if($tax->show_in_nav_menus == 1)	{ $nav = 'true'; } else { $nav = 'false'; }
			if($tax->with_front == 1) 			{ $with_front = 'false'; } else { $with_front = 'true'; }
			$pages = explode(',', $tax->page);

			echo "
			&#36pages = array(";
			$pages_str = '';
			foreach ($pages as $page) { $pages_str .= "'" . $page . "',"; }
			echo substr($pages_str, 0, strlen($pages_str)-1) . ");
			";

			echo "
			&#36args = array(
				'labels' 			=> &#36labels,
				'singular_label' 	=> __('" . utf8_decode($tax->singular_name) . "'),
				'public' 			=> true,
				'show_ui' 			=> true,
				'hierarchical' 		=> $hierarchical,
				'show_tagcloud' 	=> $tagcloud,
				'show_in_nav_menus' => $nav,
				'rewrite' 			=> array('slug' => '$tax->slug', 'with_front' => $with_front ),
			 );
			";
			echo "register_taxonomy('" . strtolower($tax->name) . "', &#36pages, &#36args);
		}
		";
		echo "add_action('init', 'register_" . str_replace('-', '_', strtolower($tax->name)) . "_tax');";
		echo '</div>';
	}
	?>
</pre>
					</div><!-- end inside -->
				</div><!-- END postbox -->
				<div class="postbox open">
					<div class="handlediv" title="Click to toggle"><br /></div>
					<h3 class="hndle"><span><?php _e('Meta Box Export Code', 'ecpt'); ?></span></h3>
					<div class="inside">
<pre class="code php">
<?php
		$metaboxes = ecpt_get_cached_metaboxes();
		foreach($metaboxes as $key => $metabox)
		{
			$pages_str = '';
			$metabox_pages = explode(',', $metabox->page);
			foreach ($metabox_pages as $page) { $pages_str .= "'" . $page . "',"; }
			$metabox_pages = substr($pages_str, 0, strlen($pages_str)-1);
			$metabox_id = str_replace('-', '_', $metabox->name . '_' . $metabox->id);
		?>
$<?php echo $metabox_id; ?>_metabox = array(
	'id' => '<?php echo $metabox->name; ?>',
	'title' => '<?php echo addslashes(utf8_decode($metabox->nicename)); ?>',
	'page' => array(<?php echo $metabox_pages; ?>),
	'context' => '<?php echo $metabox->context; ?>',
	'priority' => '<?php echo $metabox->priority; ?>',
	'fields' => array(

<?php
				foreach($wpdb->get_results("SELECT * FROM " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " WHERE parent = '" . $wpdb->escape( $metabox->name ) ."' ORDER BY list_order;") as $key => $meta_field)
				{

				$options_string = '';
				$options = explode(',', $meta_field->options);
				foreach($options as $option) { $options_string .= "'" . $option . "',"; }
				$options_string = substr($options_string, 0, -1);
				?>

				array(
					'name' 			=> <?php echo "'" . addslashes(utf8_decode($meta_field->nicename)) . "'"; ?>,
					'desc' 			=> <?php echo "'" . addslashes(utf8_decode($meta_field->description)) . "'"; ?>,
					'id' 				=> <?php echo "'" . $ecpt_prefix . utf8_decode($meta_field->name) . "'"; ?>,
					'class' 			=> <?php echo "'" . $ecpt_prefix . utf8_decode($meta_field->name) . "'"; ?>,
					'type' 			=> <?php echo "'" . $meta_field->type . "'"; ?>,
					'rich_editor' 	=> <?php echo $meta_field->rich_editor; ?>,
		<?php if($meta_field->options && ($meta_field->type == 'select' || $meta_field->type == 'radio' || $meta_field->type == 'multicheck')) { ?>
			'options' => array(<?php echo $options_string; ?>),
		<?php } ?>
			'max' 			=> <?php echo $meta_field->max; ?>
				),
			<?php } ?>
	)
);

add_action('admin_menu', 'ecpt_add_<?php echo $metabox_id; ?>_meta_box');
function ecpt_add_<?php echo $metabox_id; ?>_meta_box() {

	global $<?php echo $metabox_id; ?>_metabox;

	foreach($<?php echo $metabox_id; ?>_metabox['page'] as $page) {
		add_meta_box($<?php echo $metabox_id; ?>_metabox['id'], $<?php echo $metabox_id; ?>_metabox['title'], 'ecpt_show_<?php echo $metabox_id; ?>_box', $page, '<?php echo $metabox->context; ?>', '<?php echo $metabox->priority; ?>', $<?php echo $metabox_id; ?>_metabox);
	}
}

// function to show meta boxes
function ecpt_show_<?php echo $metabox_id; ?>_box()	{
	global $post;
	global $<?php echo $metabox_id; ?>_metabox;
	global $ecpt_prefix;
	global $wp_version;

	// Use nonce for verification
	echo '&lt;input type="hidden" name="ecpt_<?php echo $metabox_id; ?>_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" /&gt;';

	echo '&lt;table class="form-table"&gt;';

	foreach ($<?php echo $metabox_id; ?>_metabox['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post-&gt;ID, $field['id'], true);

		echo '&lt;tr&gt;',
				'&lt;th style="width:20%"&gt;&lt;label for="', $field['id'], '"&gt;', stripslashes($field['name']), '&lt;/label&gt;&lt;/th&gt;',
				'&lt;td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '"&gt;';
		switch ($field['type']) {
			case 'text':
				echo '&lt;input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:97%" /&gt;&lt;br/&gt;', '', stripslashes($field['desc']);
				break;
			case 'date':
				if($meta) { $value = ecpt_timestamp_to_date($meta); } else {  $value = ''; }
				echo '&lt;input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. $value . '" size="30" style="width:97%" /&gt;' . '' . stripslashes($field['desc']);
				break;
			case 'upload':
				echo '&lt;input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:80%" /&gt;&lt;input class="ecpt_upload_image_button" type="button" value="Upload Image" /&gt;&lt;br/&gt;', '', stripslashes($field['desc']);
				break;
			case 'textarea':

				if($field['rich_editor'] == 1) {
					if($wp_version >= 3.3) {
						echo wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
					} else {
						// older versions of WP
						$editor = '';
						if(!post_type_supports($post->post_type, 'editor')) {
							$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
						}
						$field_html = '&lt;div style="width: 97%; border: 1px solid #DFDFDF;"&gt;&lt;textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '&lt;/textarea&gt;&lt;/div&gt;&lt;br/&gt;' . __(stripslashes($field['desc']));
						echo $editor . $field_html;
					}
				} else {
					echo '&lt;div style="width: 100%;"&gt;&lt;textarea name="', $field['id'], '" class="', $field['class'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%"&gt;', $meta ? $meta : '', '&lt;/textarea&gt;&lt;/div&gt;', '', stripslashes($field['desc']);
				}

				break;
			case 'select':
				echo '&lt;select name="', $field['id'], '" id="', $field['id'], '"&gt;';
				foreach ($field['options'] as $option) {
					echo '&lt;option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '&gt;', $option, '&lt;/option&gt;';
				}
				echo '&lt;/select&gt;', '', stripslashes($field['desc']);
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '&lt;input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' /&gt;&nbsp;', $option;
				}
				echo '&lt;br/&gt;' . stripslashes($field['desc']);
				break;
			case 'multicheck':
				foreach ($field['options'] as $option) {
					echo '&lt;input type="checkbox" name="' . $field['id'] . '[' . $option . ']" value="' . $option . '"' . checked( true, in_array( $option, $meta ), false ) . '/&gt;&nbsp;' . $option;
				}
				echo '&lt;br/&gt;' . stripslashes($field['desc']);
				break;
			case 'checkbox':
				echo '&lt;input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /&gt;&nbsp;';
				echo stripslashes($field['desc']);
				break;
			case 'slider':
				echo '&lt;input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" /&gt;';
				echo '&lt;div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"&gt;&lt;/div&gt;';
				echo '&lt;div style="width: 100%; clear: both;"&gt;' . stripslashes($field['desc']) . '&lt;/div&gt;';
				break;
			case 'repeatable' :

				$field_html = '&lt;input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/&gt;';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '&lt;div class="ecpt_repeatable_wrapper"&gt;&lt;input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:90%" /&gt;';
						if($count > 1) {
							$field_html .= '&lt;a href="#" class="ecpt_remove_repeatable button-secondary"&gt;x&lt;/a&gt;&lt;br/&gt;';
						}
						$field_html .= '&lt;/div&gt;';
						$count++;
					}
				} else {
					$field_html .= '&lt;div class="ecpt_repeatable_wrapper"&gt;&lt;input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:90%" /&gt;&lt;/div&gt;';
				}
				$field_html .= '&lt;button class="ecpt_add_new_field button-secondary"&gt;' . __('Add New', 'ecpt') . '&lt;/button&gt;&nbsp;&nbsp;' . __(stripslashes($field['desc']));

				echo $field_html;

				break;

			case 'repeatable upload' :

				$field_html = '&lt;input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/&gt;';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key =&gt; $value) {
						$field_html .= '&lt;div class="ecpt_repeatable_upload_wrapper"&gt;&lt;input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:80%" /&gt;&lt;button class="button-secondary ecpt_upload_image_button"&gt;Upload File&lt;/button&gt;';
						if($count &gt; 1) {
							$field_html .= '&lt;a href="#" class="ecpt_remove_repeatable button-secondary"&gt;x&lt;/a&gt;&lt;br/&gt;';
						}
						$field_html .= '&lt;/div&gt;';
						$count++;
					}
				} else {
					$field_html .= '&lt;div class="ecpt_repeatable_upload_wrapper"&gt;&lt;input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:80%" /&gt;&lt;input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /&gt;&lt;/div&gt;';
				}
				$field_html .= '&lt;button class="ecpt_add_new_upload_field button-secondary"&gt;' . __('Add New', 'ecpt') . '&lt;/button&gt;&nbsp;&nbsp;' . __(stripslashes($field['desc']));

				echo $field_html;

				break;
		}
		echo     '&lt;td&gt;',
			'&lt;/tr&gt;';
	}

	echo '&lt;/table&gt;';
}

// Save data from meta box
add_action('save_post', 'ecpt_<?php echo $metabox_id; ?>_save');
function ecpt_<?php echo $metabox_id; ?>_save($post_id) {
	global $post;
	global $<?php echo $metabox_id; ?>_metabox;

	// verify nonce
	if ( ! isset( $_POST['ecpt_<?php echo $metabox_id; ?>_meta_box_nonce'] ) || ! wp_verify_nonce($_POST['ecpt_<?php echo $metabox_id; ?>_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($<?php echo $metabox_id; ?>_metabox['fields'] as $field) {

		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = $new;
				}
				update_post_meta($post_id, $field['id'], $new);


			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

<?php }  ?>

function ecpt_export_ui_scripts() {

	global $ecpt_options, $post;
	?&gt;
	&lt;script type="text/javascript"&gt;
			jQuery(document).ready(function($)
			{

				if($('.form-table .ecpt_upload_field').length > 0 ) {
					// Media Uploader
					window.formfield = '';

					$('.ecpt_upload_image_button').live('click', function() {
					window.formfield = $('.ecpt_upload_field',$(this).parent());
						tb_show('', 'media-upload.php?type=file&post_id=&lt;?php echo $post->ID; ?&gt;&TB_iframe=true');
										return false;
						});

						window.original_send_to_editor = window.send_to_editor;
						window.send_to_editor = function(html) {
							if (window.formfield) {
								imgurl = $('a','&lt;div&gt;'+html+'&lt;/div&gt;').attr('href');
								window.formfield.val(imgurl);
								tb_remove();
							}
							else {
								window.original_send_to_editor(html);
							}
							window.formfield = '';
							window.imagefield = false;
						}
				}
				if($('.form-table .ecpt-slider').length > 0 ) {
					$('.ecpt-slider').each(function(){
						var $this = $(this);
						var id = $this.attr('rel');
						var val = $('#' + id).val();
						var max = $('#' + id).attr('rel');
						max = parseInt(max);
						//var step = $('#' + id).closest('input').attr('rel');
						$this.slider({
							value: val,
							max: max,
							step: 1,
							slide: function(event, ui) {
								$('#' + id).val(ui.value);
							}
						});
					});
				}

				if($('.form-table .ecpt_datepicker').length > 0 ) {
					var dateFormat = 'mm/dd/yy';
					$('.ecpt_datepicker').datepicker({dateFormat: dateFormat});
				}

				// add new repeatable field
				$(".ecpt_add_new_field").on('click', function() {
					var field = $(this).closest('td').find("div.ecpt_repeatable_wrapper:last").clone(true);
					var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_wrapper:last');
					// set the new field val to blank
					$('input', field).val("");
					field.insertAfter(fieldLocation, $(this).closest('td'));

					return false;
				});

				// add new repeatable upload field
				$(".ecpt_add_new_upload_field").on('click', function() {
					var container = $(this).closest('tr');
					var field = $(this).closest('td').find("div.ecpt_repeatable_upload_wrapper:last").clone(true);
					var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_upload_wrapper:last');
					// set the new field val to blank
					$('input[type="text"]', field).val("");

					field.insertAfter(fieldLocation, $(this).closest('td'));

					return false;
				});

				// remove repeatable field
				$('.ecpt_remove_repeatable').on('click', function(e) {
					e.preventDefault();
					var field = $(this).parent();
					$('input', field).val("");
					field.remove();
					return false;
				});

			});
	  &lt;/script&gt;
	&lt;?php
}

function ecpt_export_datepicker_ui_scripts() {
	global $ecpt_base_dir;
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-slider');
}
function ecpt_export_datepicker_ui_styles() {
	global $ecpt_base_dir;
	wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css', false, '1.8', 'all');
}

// these are for newest versions of WP
add_action('admin_print_scripts-post.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-edit.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-post-new.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_styles-post.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-edit.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-post-new.php', 'ecpt_export_datepicker_ui_styles');

if ((isset($_GET['post']) && (isset($_GET['action']) && $_GET['action'] == 'edit') ) || (strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')))
{
	add_action('admin_head', 'ecpt_export_ui_scripts');
}

// converts a time stamp to date string for meta fields
if(!function_exists('ecpt_timestamp_to_date')) {
	function ecpt_timestamp_to_date($date) {

		return date('m/d/Y', $date);
	}
}
if(!function_exists('ecpt_format_date')) {
	function ecpt_format_date($date) {

		$date = strtotime($date);

		return $date;
	}
}
</pre>
						</div><!-- end inside -->
					</div><!-- END postbox -->
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}