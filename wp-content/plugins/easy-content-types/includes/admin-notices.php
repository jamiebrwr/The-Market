<?php

function ecpt_upgrade_needed_notice() {
	if(ecpt_check_if_upgrade_needed()) {
		echo '<div class="error"><p>' . __('The Easy Content Types database needs updated: ', 'ecpt') . ' ' . '<a href="' . add_query_arg('ecpt-action', 'upgrade', admin_url()) . '">' . __('upgrade now', 'ecpt') . '</a></p></div>';
	}
	if(isset($_GET['ecpt-db']) && $_GET['ecpt-db'] == 'updated') {
		echo '<div class="updated fade"><p>' . __('The Easy Content Types database has been updated', 'ecpt') . '</p></div>';
	}
}
add_action('admin_notices', 'ecpt_upgrade_needed_notice', 100);