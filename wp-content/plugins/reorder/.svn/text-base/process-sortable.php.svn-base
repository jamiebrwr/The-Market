<?php

$root = dirname(dirname(dirname(dirname(__FILE__))));
require_once($root.'/wp-load.php');


function save_page_order_nested($pages_array, $parent_id = 0) {
	global $wpdb;	
	$current_menu_order = 0;		
	foreach ($pages_array as $index => $page) {

		$page_id = str_replace('listItem_', '', $wpdb->escape($page['id']));
				
		$query_ret = $wpdb->query("UPDATE $wpdb->posts SET post_parent = '$parent_id', menu_order = '$current_menu_order' WHERE id ='$page_id'");
		if($query_ret === false) return false;
				
		$current_menu_order++;
		
		if (is_array($page['children'])) {
			save_page_order_nested($page['children'], $page_id);
		}
	}	
	return true;
}

function save_page_order_unnested($pages_array, $parent_id = 0) {
	global $wpdb;	
	$current_menu_order = 1;		
	foreach ($pages_array as $index => $page) {

		$page_id = str_replace('listItem_', '', $wpdb->escape($page));
				
		$query_ret = $wpdb->query("UPDATE $wpdb->posts SET post_parent = '0', menu_order = '$current_menu_order' WHERE id ='$page_id'");
		if($query_ret === false) return false;
				
		$current_menu_order++;
		
	}	
	return true;
}

if($_GET['order-posts-list']) {
	$pageOrder =  $_GET['order-posts-list'];	
	save_page_order_unnested($pageOrder);	
} else {
	$pageOrder =  $_GET['order-posts-list-nested'];	
	save_page_order_nested($pageOrder);	
}

//echo '<pre>';
//print_r($pageOrder);
//echo '</pre>';

/*foreach ($pageOrder as $p) {
	$id = str_replace('listItem_', '', $p['id']);
	echo $id;
	$postquery = "UPDATE $wpdb->posts SET menu_order='$i' WHERE ID='$id'";
	$wpdb->query($postquery);
	$i++;
}

/*foreach ($_GET['listItem'] as $position => $item) {
	$postquery = "UPDATE $wpdb->posts SET menu_order='$position' WHERE ID='$item'";	
	$wpdb->query($postquery);
}*/

?>