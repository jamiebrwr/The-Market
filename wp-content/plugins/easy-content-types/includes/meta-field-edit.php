<div id="icon-edit" class="icon32 icon32-posts-post"><br/></div>
<h2>
<?php _e('Edit Field', 'ecpt'); ?> - <a href="admin.php?page=easy-content-types-metaboxes&fields-edit=<?php echo absint( $_GET['fields-edit'] ); ?>" title="<?php _e('Go Back', 'ecpt'); ?>"><?php _e('Go Back', 'ecpt'); ?></a>
</h2>
<?php if(isset($_GET['field-updated'])) : ?>
	<div class="updated fade">
		<p><?php _e('Field Updated', 'ecpt'); ?></p>
	</div>
<?php endif; ?>
<form id="edit-field" method="post">
	<table class="form-table">
		<tbody>
		<?php
			$i = 0;
			foreach( $wpdb->get_results( $wpdb->prepare( "SELECT * FROM " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " WHERE id='%d';", absint( $_GET['edit-field'] ) ) ) as $key => $field) { ?>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="field-name"><?php _e('Name', 'ecpt'); ?></label>
				</th>
				<td>
					<input type="text" id="field-name" name="field-name" value="<?php echo esc_attr( stripslashes(  $field->nicename ) ); ?>"  class="ecpt-text no-float"/>
					<p class="description"><?php _e('The field name is used displayed next to the field in the meta box', 'ecpt'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="field-unique-id"><?php _e('ID', 'ecpt'); ?></label>
				</th>
				<td>
					<input type="text" id="field-unique-id" name="field-unique-id" value="<?php echo esc_attr( $field->name ); ?>"  class="ecpt-text no-float"/>
					<p class="description"><?php _e('The field id is used for displaying field content with shortcodes and template tags', 'ecpt'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="field-type"><?php _e('Type', 'ecpt'); ?></label>
				</th>
				<td>
					<select name="field-type" id="field-type" class="ecpt-text no-float"/>
						<?php
						foreach ( ecpt_get_meta_field_types() as $option ) {
							echo '<option id="' . $option . '"', $field->type == $option ? ' selected="selected"' : '', '>', $option, '</option>';
						}
						?>
					</select>
					<p class="description"><?php _e('The field type determines what kind of field is displayed', 'ecpt'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="field-desc"><?php _e('Description', 'ecpt'); ?></label>
				</th>
				<td>
					<textarea id="field-desc" name="field-desc"  class="ecpt-textarea no-float"><?php echo esc_textarea( stripslashes( $field->description ) ); ?></textarea>
					<p class="description"><?php _e('The field description is display beneath the field in the metabox', 'ecpt'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label><?php _e('Field Options', 'ecpt'); ?></label>
				</th>
				<td>
					<?php include(dirname(__FILE__) . '/meta-field-options.php'); ?>

					<?php
					if(has_action('ecpt_field_options_' . $field->type)) {
						do_action('ecpt_field_options_' . $field->type, $field);
					} else { ?>
						<p class="description"><?php _e('No options for this field', 'ecpt'); ?></p>
						<input type="hidden" id="rich-editor" name="rich-editor" value="<?php echo esc_attr( absint( $field->rich_editor ) ); ?>"/>
						<input type="hidden" id="field-options" name="field-options" value="<?php echo esc_attr( $field->options ); ?>"/>
						<input type="hidden" id="field-max" name="field-max" value="<?php echo esc_attr( absint( $field->max ) ); ?>"/>
					<?php } ?>
				</td>
			</tr>
		<?php
		} ?>
	</table>
	<p class="submit">
		<?php echo wp_nonce_field('ecpt_edit_field_nonce', 'ecpt-edit-field-nonce'); ?>
		<input type="hidden" name="ecpt-action" value="update-field"/>
		<input type="hidden" name="field-id" value="<?php echo absint( $_GET['edit-field'] ); ?>"/>
		<input type="submit" class="button-primary field-update" value="<?php _e('Update', 'ecpt'); ?>"/>
	</p>
</form>
