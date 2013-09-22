<?php
/*
Plugin Name: Reorder
Plugin URI: http://benjitastic.com
Description: Enables simple drag and drop reordering of all post types. Please consider <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=benjitastic%40gmail%2ecom&lc=US&item_name=Ben%20Kennedy%20%2d%20Reorder%20Wordpress%20Plugin&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest">donating</a> a few bucks to support future development. 
Author: Ben Kennedy
Version: 2.0
Author URI: http://benjitastic.com
*/

$minlevel = 7;  /*[default=7]*/

function build_pages($post_parent = 0) {	
	$posts = array_reverse(get_posts('post_status=""&post_type='.$_GET['post_type'].'&orderby=menu_order&order=DESC&numberposts=-1&depth=1&post_parent='.$post_parent));
	foreach($posts as $p) {								
		$status = ($p->post_status != 'publish') ? "<span>$p->post_status</span>" : "";
		$children = array_reverse(get_posts('orderby=menu_order&order=DESC&post_status=""&post_type='.$_GET['post_type'].'&numberposts=-1&depth=1&post_parent='.$p->ID));
		$title = ($p->post_title) ? $p->post_title.$status : '(no title)'.$status;
		
		echo '<li id="listItem_'.$p->ID.'" class="clear-element page-item '.$p->post_status.'">
			<table class="reorder-inner">
			<tr>
			<td>';
			//if($children) echo '<a href="#" class="expand-collapse expanded"></a>';
		echo '<strong>'.$title.'</strong>
			</td>
			<td width="40" class="reorder-id">
			'.$p->ID.'
			</td>
			</tr>
			</table>';											
		
		if(is_post_type_hierarchical($_GET["post_type"])) {
			if ($children) {
				echo '<ul class="page-list">';
					build_pages($p->ID);
				echo '</ul>';
			}		
		}
		echo '</li>';		
	}			
}

// Build the admin UI
function reorder_ui(){

	//get the label of the current post_type
  	foreach (get_post_types('','objects') as $post_type ) {
  		if($post_type->name == $_GET['post_type'])
			$pt = $post_type->label;
		elseif(!$_GET['post_type'])
			$pt = 'Posts';
  	}
  	
	?> 
	<div class="wrap">
		<div id="icon-edit" class="icon32"><br /></div>
			<h2>Reorder <?php echo $pt ?></h2>
			<p id="reorder-loading">Click, drag and drop to reorder.<span></span></p>
			<table class="widefat post fixed">
				<thead>
					<tr><th>Title</th><th width="38">ID</th></tr>
				</thead>	
				<tr>
					<td style="padding: 0" colspan="2" id="reorder-list">
						<?php /*<p><a href="#" class="reorder-expand-all">expand all</a> <a href="#" class="reorder-collapse-all">collapse all</a></p>*/ ?>
						<ul id="order-posts-list<?php if(is_post_type_hierarchical($_GET["post_type"])) echo '-nested'; ?>" class="page-list">
						<?php build_pages(); ?>
						</ul>						
					</td>
				</tr>
				<tfoot>
					<tr><th>Title</th><th>ID</th></tr>
				</tfoot>
			</table>	
	</div>
<?php }


// Add CSS
function reorder_head(){	
	echo '<link type="text/css" rel="stylesheet" href="' . WP_PLUGIN_URL.'/reorder/reorder.css" />' . "\n";
}

// Add Javascript
function reorder_script() {	
	wp_enqueue_script('reorderScript', WP_PLUGIN_URL . '/reorder/interface-1.2.js');	
	wp_enqueue_script('reorderScript2', WP_PLUGIN_URL . '/reorder/reorder.js');		
	wp_enqueue_script('reorderScript3', WP_PLUGIN_URL . '/reorder/inestedsortable.js');				
}

// Add to admin menus
function reorder_menu(){
	global $minlevel;	
		
	//add menu to standard Posts
	$page = add_submenu_page('edit.php', 'Order Posts', 'Reorder', $minlevel,  __FILE__, 'reorder_ui'); 
	add_action( "admin_print_scripts-$page", 'reorder_script' );
		
	//exclude this plugin from the following post_types
	$excludedPostTypes = array('attachment', 'revision', 'nav_menu_item');
	
	//add menu to each post_type
	foreach(get_post_types('','names') as $r) {
		if(!in_array($r, $excludedPostTypes)) {
			$page = add_submenu_page('edit.php?post_type='.$r.'', "Reorder", "Reorder", $minlevel,  $r, 'reorder_ui');
			add_action( "admin_print_scripts-$page", 'reorder_script' );			
		}
	}	
}

function reorder_orderPosts($orderBy) {
	global $wpdb;
	$orderBy = "{$wpdb->posts}.menu_order ASC, post_date DESC";
//	$orderBy = "{$wpdb->posts}.menu_order ASC";
	return($orderBy);
}

//add_action('admin_print_scripts', 'reorder_script');
add_action('admin_head', 'reorder_head');
add_action('admin_menu', 'reorder_menu');
add_filter('posts_orderby', 'reorder_orderPosts'); //add filter for post ordering

?>