<div id="icon-edit" class="icon32 icon32-posts-post"><br/></div>
<h2>
	<?php _e('Edit Post Type', 'ecpt'); ?> -
	<a href="admin.php?page=easy-content-types-posttypes" title="Go Back"><?php _e('Go Back', 'ecpt'); ?></a>
</h2>
<?php if(isset($_GET['post-type-updated'])) : ?>
	<div class="updated fade">
		<p><?php _e('Post type updated. If you changed the slug or name, you should update <a href="options-permalink.php">permalinks</a> now', 'ecpt'); ?></p>
	</div>
<?php endif; ?>
<form id="ecpt-posttype-edit" method="POST">
	<table class="form-table">

		<tbody>
			<?php
			$i = 0;
			// editing a posttype
			if(isset($_GET['posttype-edit'])) :

				foreach( $wpdb->get_results( $wpdb->prepare( "SELECT * FROM " . $wpdb->escape( $ecpt_db_name ) . " WHERE id='%d';", absint( $_GET['posttype-edit'] ) ) ) as $key => $posttype) {
					?>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-name"><?php _e('Name', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-name" id="posttype-name" value="<?php echo esc_attr( $posttype->name ); ?>" />
								<p class="description"><?php _e('This is the name that will be used to query the post type from the database. Keep it a single word and simple.', 'ecpt'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-singlular"><?php _e('Single', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-singlular" id="posttype-singlular" value="<?php echo esc_attr( $posttype->singular_name ); ?>" />
								<p class="description"><?php _e('The single label is used to refer to single post type items, such as "Add New Book".', 'ecpt'); ?></p>

							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-plural"><?php _e('Plural', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-plural" id="posttype-plural" value="<?php echo esc_attr( $posttype->plural_name ); ?>" />
								<p class="description"><?php _e('The plural label is used to refer to plural post type items, such as "Search Books".', 'ecpt'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label><?php _e('Advanced Labels', 'ecpt'); ?></label>
							</th>
							<td>
								<div id="ecpt-advanced-labels" style="display:none;">
									<?php $advanced_labels = maybe_unserialize($posttype->labels); ?>
									<p><?php _e('These settings allow you to adjust the advanced display name options for this post type.', 'ecpt'); ?></p>

									<label for="ecpt-advanced-labels[add-new]"><?php _e('Add New', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[add-new]" id="ecpt-advanced-labels[add-new]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr( stripslashes( $advanced_labels['add_new'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('The add new text. Default is "Add New", but could be "Add New Book"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[all-items]"><?php _e('All Items', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[all-items]" id="ecpt-advanced-labels[all-items]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['all_items'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('The all items text used in the menu. Default is the name of your post type entered above.', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[add-new-item]"><?php _e('Add New Item', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[add-new-item]" id="ecpt-advanced-labels[add-new-item]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['add_new_item'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('The Add New Item text. Default is "Add New {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[edit-item]"><?php _e('Edit Item', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[edit-item]" id="ecpt-advanced-labels[edit-item]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['edit_item'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('The Edit Item text. Default is "Edit {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[new-item]"><?php _e('New Item', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[new-item]" id="ecpt-advanced-labels[new-item]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['new_item'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('The new item text. Default is "New {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[view-item]"><?php _e('View Item', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[view-item]" id="ecpt-advanced-labels[view-item]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['view_item'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('The view item text. Default is "View {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[search-items]"><?php _e('Search Items', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[search-items]" id="ecpt-advanced-labels[search-items]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['search_items'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('The search items text. Default is "Search {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[not-found]"><?php _e('Not Found', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[not-found]" id="ecpt-advanced-labels[not-found]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['not_found'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('The no items found text. Default is "No {post type name} found"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[not-found-in-trash]"><?php _e('Not Found in Trash', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[not-found-in-trash]" id="ecpt-advanced-labels[not-found-in-trash]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['not_found_in_trash'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('The no items found in trash text. Default is "No {post type name} found in Trash"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[parent-item-colon]"><?php _e('Parent Item Text', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[parent-item-colon]" id="ecpt-advanced-labels[parent-item-colon]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['parent_item_colon'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('Text used for "Parent Item" label. Default is "Parent {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

									<label for="ecpt-advanced-labels[menu-name]"><?php _e('Menu Name', 'ecpt'); ?></label>
									<input type="text" name="advanced-labels[menu-name]" id="ecpt-advanced-labels[menu-name]" class="ecpt-text" tabindex="2" value="<?php echo esc_attr(stripslashes( $advanced_labels['menu_name'] ) ); ?>"/>
									<p class="ecpt-description"><?php _e('Name used for the menu text. Defaults to the name of the post type', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

								</div>
								<button class="ecpt-advanced-labels button-secondary"><?php _e('Show Advanced Labels', 'ecpt'); ?></button>
								<button class="ecpt-advanced-labels button-secondary" style="display:none;"><?php _e('Hide Advanced Labels', 'ecpt'); ?></button>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-slug"><?php _e('Slug', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-slug" id="posttype-slug" value="<?php echo esc_attr( utf8_decode($posttype->slug) ); ?>" />
								<p class="description"><?php _e('The slug is the url friendly name of the post type.', 'ecpt'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-position"><?php _e('Menu Position', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-position" id="posttype-position" value="<?php echo absint( $posttype->menu_position ); ?>" />
								<p class="description"><?php _e('The position of the post type in the menu. For help: ', 'ecpt'); ?><a href="<?php echo admin_url('/admin.php?page=easy-content-types-help#post-type-advanced'); ?>"><?php _e('documentation', 'ecpt'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label><?php _e('Attributes', 'ecpt'); ?></label>
							</th>
							<td>
								<div class="ecpt-atts">
								<?php
									$checked = '';
									if($posttype->has_archive == 1) { $checked = 'checked="checked"'; }
									echo '<div>';
									echo '<input type="checkbox" name="posttype-has_archive" id="posttype-has_archive"' . $checked . '/>';
									echo '<label for="posttype-has_archive">' . __('Archives', 'ecpt') . '</label></div>';
									$checked = '';

									if($posttype->title == 1) { $checked = 'checked="checked"'; }
									echo '<div>';
									echo '<input type="checkbox" name="posttype-title" id="posttype-title"' . $checked . '/>';
									echo '<label for="posttype-title">' . __('Title', 'ecpt') . '</label></div>';
									$checked = '';

									if($posttype->editor == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-editor" id="posttype-editor"' . $checked . '/>';
									echo '<label for="posttype-editor">' . __('Editor', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->author == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-author" id="posttype-author"' . $checked . '/>';
									echo '<label for="posttype-author">' . __('Author', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->thumbnail == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-thumbnail" id="posttype-thumbnail"' . $checked . '/>';
									echo '<label for="posttype-thumbnail">' . __('Thumbnail', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->excerpt == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-excerpt" id="posttype-excerpt"' . $checked . '/>';
									echo '<label for="posttype-excerpt">' . __('Excerpt', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->fields == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-fields" id="posttype-fields"' . $checked . '/>';
									echo '<label for="posttype-fields">' . __('Custom Fields', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->comments == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-comments" id="posttype-comments"' . $checked . '/>';
									echo '<label for="posttype-comments">' . __('Comments', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

								?>
								</div>
								<div class="ecpt-atts">
								<?php

									if($posttype->revisions == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-revisions" id="posttype-revisions"' . $checked . '/>';
									echo '<label for="posttype-revisions">' . __('Revisions', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->hierarchical == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-hierarchical" id="posttype-hierarchical"' . $checked . '/>';
									echo '<label for="posttype-hierarchical">' . __('Hierarchical', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->post_formats == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-post_formats" id="posttype-post_formats"' . $checked . '/>';
									echo '<label for="posttype-post_formats">' . __('Post Formats', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->exclude_from_search == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-exclude_from_search" id="posttype-exclude_from_search"' . $checked . '/>';
									echo '<label for="posttype-exclude_from_search">' . __('Exclude From Search', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->show_in_nav_menus == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-show_in_nav_menus" id="posttype-show_in_nav_menus"' . $checked . '/>';
									echo '<label for="posttype-show_in_nav_menus">' . __('Show in Nav Menus', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									if($posttype->with_front == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-with-front" id="posttype-with_front"' . $checked . '/>';
									echo '<label for="posttype-with_front">' . __('Disable with_front', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
									if($posttype->post_tags == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-tags" id="posttype-tags"' . $checked . '/>';
									echo '<label for="posttype-tags">' . __('Enable Post Tags', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';

									$checked = '';
									if($posttype->categories == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-categories" id="posttype-categories"' . $checked . '/>';
									echo '<label for="posttype-categories">' . __('Enable Categories', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								?>
								</div>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-advanced-supports"><?php _e('Advanced Supports', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-advanced-supports" id="posttype-advanced-supports" class="regular-text" value="<?php echo !empty($posttype->advanced_supports) ? esc_attr( $posttype->advanced_supports ) : ''; ?>"/>
								<p class="description"><?php _e('Additional support options. Separate each by a comma.','ecpt'); ?></p><br/>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-menu-icon"><?php _e('Menu Icon', 'ecpt'); ?></label>
							</th>
							<td>
								<?php if ($posttype->menu_icon != 'undefined' && $posttype->menu_icon != '') { ?>
								<img src="<?php echo $posttype->menu_icon; ?>" class="ecpt_menu_icon"/>
								<?php } else { ?>
								<img src="<?php echo $ecpt_base_dir; ?>/includes/images/icon.png" class="ecpt_menu_icon" />
								<?php } ?>
								<input type="text" name="posttype-menu-icon" class="ecpt_upload_image posttype-menu-icon" id="upload_image_<?php echo $posttype->id; ?>" value="<?php if ($posttype->menu_icon != 'undefined' && $posttype->menu_icon != '') { echo $posttype->menu_icon; } ?>" />
								<input id="upload_image_button_<?php echo $posttype->id; ?>" class="ecpt_upload_image_button edit_posttype_upload button-secondary" value="<?php _e('Choose Image', 'ecpt'); ?>" type="button" />
							</td>
						</tr>
					<?php
					$i++;
				}
			endif;
			?>
		</tbody>
	</table>
	<p class="submit">
		<?php echo wp_nonce_field('ecpt_edit_cpt_nonce', 'ecpt-edit-cpt-nonce'); ?>
		<input type="hidden" name="posttype-id" value="<?php echo absint( $posttype->id ); ?>"/>
		<input type="hidden" name="ecpt-action" value="update-post-type" />
		<input type="submit" class="button-primary posttype-update" value="<?php _e('Update', 'ecpt'); ?>"/>
	</p>
</form>