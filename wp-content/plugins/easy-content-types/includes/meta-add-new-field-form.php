<!--custom metabox field creation form-->
<h3><?php _e('Create New Metabox Field', 'ecpt'); ?></h3>
<form method="post" id="ecpt-add-new-field">
	<fieldset>
		<legend><?php _e('Field Info', 'ecpt'); ?></legend><br/>
		
		<?php 
		$counter = 0;
		foreach( $wpdb->get_results("SELECT * FROM " . $wpdb->escape( $ecpt_db_meta_fields_name ) . " ORDER BY id DESC LIMIT 1;") as $key => $field) {
			// add all the list orders together
			$id = $field->id;
			$newID = $id + 1; // add 1 to the last ID
		} ?>
		<input type="hidden" value="<?php echo absint( $metabox->id ); ?>" name="current-field"/>
		<input type="hidden" value="<?php echo esc_attr( $metabox->name ); ?>" name="field-parent"/>
		<input type="hidden" value="<?php echo $newID; // last ID + 1 ?>" name="field-order"/>
		
		<label for="ecpt-field-name"><?php _e('Field Name', 'ecpt'); ?><span class="required">*</span></label>
		<input type="text" name="field-name" id="ecpt-field-name" class="ecpt-text" tabindex="1"/>
		<p class="ecpt-description"><?php _e('This is the main name of the field', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This is the name that will be used to display field data on the site, and also will be display next to the field in the post editor', 'ecpt'); ?></span></a></p><br/>
		
		<label for="ecpt-field-id"><?php _e('Field ID', 'ecpt'); ?></label>
		<input type="text" name="field-id" id="ecpt-field-id" class="ecpt-text" tabindex="1"/>
		<p class="ecpt-description"><?php _e('This is the unique id of the field (optional)', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This is what will be used to retrieve information from this field with the short codes and template tags. If not specified, the field Name will be used (with all spaces and capitalization replaced)', 'ecpt'); ?></span></a></p><br/>
		
		<div class="ecpt-clearfix" style="margin-bottom: 15px;">
			<label for="ecpt-field-desc"><?php _e('Field Description', 'ecpt'); ?></label>
			<textarea name="field-desc" id="ecpt-field-desc" class="ecpt-textarea" tabindex="2"></textarea>
			<p class="ecpt-description"><?php _e('The field description', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This is description of the field that will be shown beneath the field in the editor', 'ecpt'); ?></span></a></p><br/>
		</div>
		
		<label for="ecpt-field-type"><?php _e('Type', 'ecpt'); ?></label>
		<select name="field-type" id="ecpt-field-type" class="ecpt-text"  tabindex="3"/>
			<?php foreach( ecpt_get_meta_field_types() as $field_type ) {
				echo '<option id="' . esc_attr( $field_type ) . '">' . $field_type . '</option>';
			} ?>
		</select>
		<p class="ecpt-description"><?php _e('The type of field you would like to insert', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you choose "select" or "radio" a new input will become available for you to enter the options', 'ecpt'); ?></span></a></p><br/>
		
		<div class="ecpt-disabled">
			<label for="ecpt-field-options"><?php _e('Options', 'ecpt'); ?></label>
			<input type="text" name="field-options" id="ecpt-field-options" class="ecpt-text"  tabindex="4"/>
			<p class="ecpt-description"><?php _e('Options for select, radio and multicheck fields. Separate options with a comma', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('A sample set of options would look like this (without the quotes): "option 1, option 2, option 3"', 'ecpt'); ?></span></a></p><br/>
		</div>
		<div class="ecpt-rich-editor-disabled">
			<label for="ecpt-rich-editor"><?php _e('Rich Editor', 'ecpt'); ?></label>
			<input type="checkbox" name="rich-editor" id="ecpt-rich-editor" class="ecpt-checkbox"  tabindex="5"/>
			<p class="ecpt-description"><?php _e('Enable the Rich Editor for this textarea?', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This option will enable "rich" formatting controls, such as italic, bold, alignment, link, etc', 'ecpt'); ?></span></a></p><br/>
		</div>
		
		<div class="ecpt-max-disabled">
			<label for="ecpt-field-max"><?php _e('Max Value', 'ecpt'); ?></label>
			<input type="text" name="field-max" id="ecpt-field-max" class="ecpt-text"  tabindex="6"/>
			<p class="ecpt-description"><?php _e('Enter the maximum value for this slider', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This is the highest value that the slider can "slide" too.', 'ecpt'); ?></span></a></p><br/>
		</div>
		
	</fieldset><br/>
	<?php echo wp_nonce_field('ecpt_add_field_nonce', 'ecpt-field-nonce'); ?>
	<input type="hidden" name="ecpt-action" value="add-field"/>
	<input type="submit" id="ecpt-submit" class="button-primary" value="<?php _e( 'Add Field', 'ecpt' ); ?>"/>
</form>