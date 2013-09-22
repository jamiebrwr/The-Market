<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = STYLESHEETPATH . '/functions/';
$includes_path = STYLESHEETPATH . '/includes/';

// WooFramework
//require_once ($functions_path . 'admin-init.php');			// Framework Init

// Theme specific functionality
//require_once ($includes_path . 'theme-options.php'); 			// Options panel settings and custom settings
require_once ($includes_path . 'image-sizes.php'); 				// Register custom image sizes
//require_once ($includes_path . 'theme-functions.php'); 		// Custom theme functions
//require_once ($includes_path . 'theme-plugins.php');			// Theme specific plugins integrated in a theme
//require_once ($includes_path . 'theme-actions.php');			// Theme actions & user defined hooks
//require_once ($includes_path . 'theme-comments.php'); 		// Custom comments/pingback loop
//require_once ($includes_path . 'theme-js.php');				// Load javascript in wp_head
//require_once ($includes_path . 'sidebar-init.php');			// Initialize widgetized areas
//require_once ($includes_path . 'theme-widgets.php');			// Theme widgets

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

function pippin_create_post_form() {
	ob_start(); 
	if(isset($_GET['post'])) {
		switch($_GET['post']) {
			case 'successfull':
				echo '<p class="success">' . __('Stats Below', 'pippin') . '</p>';
				break;
			case 'failed' :
				echo '<p class="error">' . __('Please fill in all the info', 'pippin') . '</p>';
				break;
		}
	}
	?>
	<form id="pippin_create_post" action="" method="POST">
		<fieldset>
			<input name="website_url" id="website_url" type="text"/>
			<label for="website_url">Website URL</label>
		</fieldset>
		<fieldset>
			<?php wp_nonce_field('website_url_nonce', 'website_url_nonce_field'); ?>
			<input type="submit" name="website_url_submit" value="<?php _e('Submit URL', 'pippin'); ?>"/>
		</fieldset>
	</form>
	<?php 
	return ob_get_clean();
}
add_shortcode('post_form', 'pippin_create_post_form');
 
function pippin_process_post_creation() {
	if(isset($_POST['website_url_nonce_field']) && wp_verify_nonce($_POST['website_url_nonce_field'], 'website_url_nonce')) {
 
		if(strlen(trim($_POST['website_url'])) < 1 ) {
			$redirect = add_query_arg('post', 'failed', $_POST['_wp_http_referer']);
		} else {		
			$website_url_info = array(
				'post_title' => esc_attr(strip_tags($_POST['website_url_title'])),
				'post_type' => 'website_urls',
				'post_content' => esc_attr(strip_tags($_POST['website_url_desc'])),
				'post_status' => 'pending'
			);
			$website_url_id = wp_insert_post($website_url_info);
 
			if($website_url_id) {
				update_post_meta($website_url_id, 'ecpt_postedby', esc_attr(strip_tags($_POST['user_name'])));
				update_post_meta($website_url_id, 'ecpt_posteremail', esc_attr(strip_tags($_POST['user_email'])));
				update_post_meta($website_url_id, 'ecpt_contactemail', esc_attr(strip_tags($_POST['inquiry_email'])));
				$redirect = add_query_arg('post', 'successfull', $_POST['_wp_http_referer']);
			}
		}
		wp_redirect($redirect); exit;
	}
}
add_action('init', 'pippin_process_post_creation');





add_action("gform_field_advanced_settings", "ounce_gform_field_advanced_settings", 10, 2);
function ounce_gform_field_advanced_settings($position, $form_id){
    
    if($position == 50){
        ?>
        <li id="populate_taxonomy_settings" style="display:block;">
            <label for="field_admin_label">
                <?php _e("Populate with a Taxonomy", "gravityforms"); ?>
                <?php gform_tooltip("form_field_custom_taxonomy") ?>
            </label>
            <input type="checkbox" id="field_enable_populate_taxonomy" onclick="togglePopulateTaxonomy(jQuery('#field_populate_taxonomy'), '');" /> Enable population with a taxonomy<br />
            
            <select id="field_populate_taxonomy" onchange="SetFieldProperty('populateTaxonomy', jQuery(this).val());" style="margin-top:10px; display:none;">
                <option value="" style="color:#999;">Select a Taxonomy</option>
            <?php
            $taxonomies = get_taxonomies('', 'objects');
            foreach($taxonomies as $taxonomy): ?>
            
                <option value="<?php echo $taxonomy->name; ?>"><?php echo $taxonomy->label; ?></option>
                
            <?php endforeach; ?>
            </select>
            
        </li>
        <?php
    }
    
}

// action to inject supporting script to the form editor page
add_action("gform_editor_js", "ounce_gform_editor_scripts");
function ounce_gform_editor_scripts(){
    ?>
    <script type='text/javascript'>

        jQuery(document).bind("gform_load_field_settings", function(event, field, form){
            
            var valid_types = new Array('select');
            if(jQuery.inArray(field['type'], valid_types) != -1) {
                jQuery('#populate_taxonomy_settings').show();
            } else {
                jQuery('#populate_taxonomy_settings').hide();
            }
            
            var populateTaxonomy = (typeof field['populateTaxonomy'] != 'undefined' && field['populateTaxonomy'] != '') ? field['populateTaxonomy'] : false;
            
            jQuery("#field_enable_populate_taxonomy").attr("checked", populateTaxonomy != false);
            togglePopulateTaxonomy(jQuery('#field_populate_taxonomy'), populateTaxonomy);
            
        });
        
        function togglePopulateTaxonomy(elem, taxonomy){
            
            var checked = jQuery("#field_enable_populate_taxonomy").attr('checked');
            
            if(checked){
                jQuery(elem).slideDown(function(){
                    jQuery(this).val(taxonomy); 
                });
            } else {
                jQuery(elem).slideUp(function(){
                    jQuery(this).val(taxonomy); 
                });
            }
            
            
        }
        
    </script>
    <?php
}

// filter to add a new tooltip
add_filter('gform_tooltips', 'ounce_gform_tooltips');
function ounce_gform_tooltips($tooltips){
   $tooltips["form_field_custom_taxonomy"] = "<h6>Populate with a Taxonomy</h6>Check this box to populate this field from a taxonomy.";
   return $tooltips;
}

// filter to populate taxonomy in designated fields
add_filter('gform_pre_render', 'ounce_gform_populate_taxonomy');
function ounce_gform_populate_taxonomy($form){
    
    foreach($form['fields'] as &$field){
        
        if(!$field['populateTaxonomy'])
            continue;
        
        $taxonomy = $field['populateTaxonomy'];
        $first_choice = $field['choices'][0]['text'];
        $field['choices'] = ounce_taxonomy_as_choices($taxonomy, $first_choice);
    }

    return $form;
}

function ounce_taxonomy_as_choices($taxonomy = "categories", $first_choice = '') {
    
    $terms = get_terms($taxonomy, 'orderby=name&hide_empty=0');
    $taxonomy = get_taxonomy($taxonomy);
    $choices = array();
    $i = 0;
    
    switch($first_choice){
    
    // if no default option is specified, dynamically create based on taxonomy name
    case '':
        $choices[$i]['text'] = "Select a {$taxonomy->labels->singular_name}";
        $choices[$i]['value'] = "";
        $i++;
        break;
        
    // populate the first item from the original choices array
    default:
        $choices[$i]['text'] = $first_choice;
        $choices[$i]['value'] = '';
        $i++;
        break;
    }
    
    foreach($terms as $term) {
        $choices[$i]['text'] = $term->name;
        $choices[$i]['value'] = $term->term_id;
        $i++;
    }
    
    return $choices;
}

add_action('gform_post_submission', 'ounce_gform_post_submission', 10, 2);
function ounce_gform_post_submission($entry, $form) {
    
    // if no post was created, return
    if(!$entry['post_id'])
        return;
    
    foreach($form['fields'] as $field){
        
        if(!$field['populateTaxonomy'])
            continue;
        
        $taxonomy = $field['populateTaxonomy'];
        $term_id = $entry[$field['id']];
    }
    
    // if we have a taxonomy and a field id, add term to post
    if($taxonomy && $term_id)
        ounce_add_term_to_post($taxonomy, $term_id, $entry['post_id']);

}

// add term from taxonomy to post
function ounce_add_term_to_post($taxonomy = "categories", $term_id, $post_id) {

    $terms = get_terms($taxonomy, array('hide_empty' => 0));
    
    foreach($terms as $term) {
        
        if($term->term_id == $term_id)
            $result = wp_set_object_terms($post_id, (int) $term_id, $taxonomy, false);
            
    }

}

/*-------------------------------------------------------------------------------------------*/
/* Add Custom Post Types to Author Archives Page in WordPress
 *
 *@link http://isabelcastillo.com/add-custom-post-types-to-author-archives-wordpress
/*-------------------------------------------------------------------------------------------*/
function custom_post_author_archive($query) {
    if ($query->is_author)
        $query->set( 'post_type', array('product') );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'custom_post_author_archive');



/* Remove Admin Bar for everyonw except Administrator */
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}



