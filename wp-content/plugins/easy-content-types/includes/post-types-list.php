<h2><?php _e('Easy Custom Post Types', 'ecpt'); ?></h2>
<table class="wp-list-table widefat fixed posts">
	<thead>
		<tr>
			<th><?php _e('Name', 'ecpt'); ?></th>
			<th><?php _e('Labels', 'ecpt'); ?></th>
			<th><?php _e('Slug', 'ecpt'); ?></th>
			<th style="width: 200px;"><?php _e('Attributes', 'ecpt'); ?></th>
			<th><?php _e('Menu Icon', 'ecpt'); ?></th>
			<th><?php _e('Template File', 'ecpt'); ?></th>
			<th><?php _e('Edit', 'ecpt'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><?php _e('Name', 'ecpt'); ?></th>
			<th><?php _e('Labels', 'ecpt'); ?></th>
			<th><?php _e('Slug', 'ecpt'); ?></th>
			<th style="width: 200px;"><?php _e('Attributes', 'ecpt'); ?></th>
			<th><?php _e('Menu Icon', 'ecpt'); ?></th>
			<th><?php _e('Template File', 'ecpt'); ?></th>
			<th><?php _e('Edit', 'ecpt'); ?></th>
		</tr>
	</tfoot>
	<tbody>
		<?php
		$i = 0;
			$ecpt_post_types = ecpt_get_cached_post_types();
			foreach( $ecpt_post_types as $key => $type ) {
				?>
					<tr <?php if( ecpt_is_odd( $i ) ) { echo 'class="alternate"'; } ?> id="ecpt-posttype-<?php echo absint( $type->id ); ?>">
						<td><?php echo $type->name; ?></td>
						<td><?php echo __('Single: ', 'ecpt') . esc_attr( $type->singular_name ) . '<br/>' . __('Plural: ', 'ecpt') . esc_attr( $type->plural_name ); ?></td>
						<td><?php echo esc_attr( utf8_decode( $type->slug ) ); ?></td>
						<td>
							<div id="posttype-atts">
							<?php
								$atts = array();

								// disabled at this time due to a bug in WP core
								if($type->hierarchical == 1)	{ $atts[] = 'hierarchical'; }
								if($type->post_formats == 1)	{ $atts[] = 'post-formats'; }
								if($type->page_attributes == 1)	{ $atts[] = 'page_attributes'; }
								if($type->has_archive == 1) 	{ $atts[] = 'has_archive'; }
								if($type->title == 1) 			{ $atts[] = 'title'; }
								if($type->editor == 1) 			{ $atts[] = 'editor'; }
								if($type->author == 1) 			{ $atts[] = 'author'; }
								if($type->thumbnail == 1) 		{ $atts[] = 'thumbnail'; }
								if($type->excerpt == 1)			{ $atts[] = 'excerpt'; }
								if($type->fields == 1) 			{ $atts[] = 'custom fields'; }
								if($type->comments == 1) 		{ $atts[] = 'comments'; }
								if($type->revisions == 1) 		{ $atts[] = 'revisions'; }
								foreach($atts as $att) { echo '<span class="att">' . $att . '<em>,</em> </span>'; }
							?>
							</div>
						</td>
						<td>
							<?php if ($type->menu_icon != 'undefined' && $type->menu_icon != '') { ?>
							<img src="<?php echo $type->menu_icon; ?>" class="ecpt_menu_icon"/>
							<?php } else { ?>
							<img src="<?php echo esc_url( $ecpt_base_dir ); ?>/includes/images/icon.png" class="ecpt_menu_icon"/>
							<?php } ?>
						</td>
						<td>
							<?php if($type->has_archive == 1) { ?>
							<?php _e('Archives', 'ecpt'); ?>: <em>archive-<?php echo esc_attr( $type->name ); ?>.php</em><br/>
							<?php } ?>
							<?php _e('Single', 'ecpt'); ?>: <em>single-<?php echo esc_attr( $type->name ); ?>.php</em>
						</td>
						<td>
							<a href="admin.php?page=easy-content-types-posttypes&posttype-edit=<?php echo absint( $type->id ); ?>" title="Edit" class="ecpt-edit" id="ecpt-edit-<?php echo absint( $type->id ); ?>"><?php _e('Edit', 'ecpt'); ?></a> |
							<a href="edit.php?post_type=<?php echo esc_attr( utf8_decode($type->name) ); ?>" title="<?php _e('Edit', 'ecpt'); ?>" class="ecpt-edit" id="ecpt-edit-<?php echo absint( $type->id ); ?>"><?php _e('View', 'ecpt'); ?> <?php echo esc_attr( utf8_decode($type->plural_name) ); ?></a> |
							<a href="post-new.php?post_type=<?php echo esc_attr( $type->name ); ?>" title="<?php _e('Add New', 'ecpt'); ?>" class="ecpt-edit" id="ecpt-edit-<?php echo absint( $type->id ); ?>"><?php _e('Add New', 'ecpt'); ?> <?php echo esc_attr( utf8_decode($type->singular_name) ); ?></a> |
							<a href="admin.php?page=easy-content-types-posttypes&ecpt-action=delete-posttype&posttype-id=<?php echo absint( $type->id ); ?>" title="<?php _e('Delete', 'ecpt'); ?>" class="ecpt-delete ecpt-post-type-delete" id="ecpt-delete-<?php echo absint( $type->id ); ?>"><?php _e('Delete', 'ecpt'); ?></a>
						</td>
					</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>