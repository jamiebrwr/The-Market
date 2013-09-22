<h2><?php _e('Easy Custom Taxonomies', 'ecpt'); ?></h2>
<table class="wp-list-table widefat fixed posts">
	<thead>
		<tr>
			<th><?php _e('Name', 'ecpt'); ?></th>
			<th><?php _e('Labels', 'ecpt'); ?></th>
			<th><?php _e('Object(s)', 'ecpt'); ?></th>
			<th><?php _e('Slug', 'ecpt'); ?></th>
			<th><?php _e('Attributes', 'ecpt'); ?></th>
			<th><?php _e('Template File', 'ecpt'); ?></th>
			<th><?php _e('Edit', 'ecpt'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><?php _e('Name', 'ecpt'); ?></th>
			<th><?php _e('Labels', 'ecpt'); ?></th>
			<th><?php _e('Object(s)', 'ecpt'); ?></th>
			<th><?php _e('Slug', 'ecpt'); ?></th>
			<th><?php _e('Attributes', 'ecpt'); ?></th>
			<th><?php _e('Template File', 'ecpt'); ?></th>
			<th><?php _e('Edit', 'ecpt'); ?></th>
		</tr>
	</tfoot>
	<tbody>
		<?php
		$i = 0;
		$taxonomies = ecpt_get_cached_taxonomies();
		foreach( $taxonomies as $key => $tax) {
			?>
				<tr <?php if(ecpt_is_odd($i)) { echo 'class="alternate"'; } ?> id="ecpt-tax-<?php echo absint( $tax->id ); ?>">
					<td><?php echo $tax->name; ?></td>
					<td><?php echo __('Single', 'ecpt') . ': ' . esc_attr( $tax->singular_name ) . '<br/>'.__('Plural', 'ecpt').': ' . esc_attr( $tax->plural_name ); ?></td>
					<td>
						<ul>
						<?php
							$pages = explode(',', $tax->page);
							foreach ($pages as $page) {
								echo '<li>' . $page . '</li>';
							}
						?>
						</ul>
					</td>
					<td>
						<?php echo esc_attr( $tax->slug ); ?>
					</td>
					<td>
						<?php
							$atts = array();
							if($tax->hierarchical == 1){ $atts[] = __('hierarchical', 'ecpt'); }
							if($tax->show_tagcloud == 1){ $atts[] = __('tagcloud', 'ecpt'); }
							if($tax->show_in_nav_menus == 1){ $atts[] = __('show in nav menus', 'ecpt'); }
							if($tax->with_front == 1){ $atts[] = __('with front disabled', 'ecpt'); }
							if($tax->enable_filter == 1 && is_plugin_active('ecpt-filter-by-taxonomy/ecpt-filter-by-taxonomy.php')) {
								$atts[] = __('post list filter enabled', 'ecpt');
							}

							$atts_size = count($atts);
							$att_count = 1;
							foreach($atts as $att) {
								echo $att;
								if($att_count < $atts_size) {
									echo ', ';
								}
								$att_count++;
							}
						?>
					</td>

					<td>
						<?php _e('Specific Term', 'ecpt'); ?>: <em>taxonomy-<?php echo $tax->name;?>-{term}.php</em><br/>
						<?php _e('Archive', 'ecpt'); ?>: <em>taxonomy-<?php echo $tax->name; ?>.php</em>
					</td>
					<td>
						<a href="admin.php?page=easy-content-types-taxonomies&edit-tax=<?php echo $tax->id; ?>" title="<?php _e('edit', 'ecpt'); ?>" class="ecpt-edit-taxonomy" id="ecpt-edit-<?php echo $tax->id; ?>"><?php _e('Edit', 'ecpt'); ?></a> |
						<a href="edit-tags.php?taxonomy=<?php echo str_replace(' ', '_', strtolower($tax->name)); ?>&post_type=<?php echo $tax->page; ?>" title="<?php _e('view', 'ecpt'); ?>" class="ecpt-edit-taxonomy" id="ecpt-edit-<?php echo $tax->id; ?>"><?php _e('View', 'ecpt'); ?></a> |
						<a href="admin.php?page=easy-content-types-taxonomies&ecpt-action=delete-taxonomy&tax-id=<?php echo $tax->id; ?>" title="<?php _e('Delete', 'ecpt'); ?>" class="ecpt-delete-taxonomy" id="ecpt-delete-<?php echo $tax->id; ?>"><?php _e('Delete', 'ecpt'); ?></a>
					</td>
				</tr>
			<?php $i++;
		}
		?>
	</tbody>
</table>
