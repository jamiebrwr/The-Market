<!--custom metabox creation form-->
<h3><?php _e('Create New Custom Metabox', 'ecpt'); ?></h3>
<form method="post" action="" id="ecpt-add-metabox">
	<fieldset>
		<legend><?php _e('Metabox General', 'ecpt'); ?></legend><br/>
		
		<label for="ecpt-metabox-name"><?php _e('Metabox Name', 'ecpt'); ?><span class="required">*</span></label>
		<input type="text" name="metabox-name" id="ecpt-metabox-name" class="ecpt-text"/>
		<p class="ecpt-description"><?php _e('This is the main name of the metabox', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('The metabox name will show up in the header of the box on the editor screen', 'ecpt'); ?></span></a></p><br/>
		
		<div class="ecpt-clearfix" style="padding-bottom: 15px;">
			<label for="ecpt-metabox-page"><?php _e('Page(s)', 'ecpt'); ?></label>
			<select name="metabox-page[]" multiple id="ecpt-metabox-page" class="ecpt-text ecpt-multi-select"/>
				<?php 
				$pages = get_post_types('', 'objects');
				foreach ($pages as $page) {
					echo '<option value="' . $page->name . '">', $page->labels->name, '</option>';
				}
				?>
			</select>
			<p class="ecpt-description"><?php _e('This is the post type that will use this metabox', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you want to put the metabox on the regular Posts screen, then choose "post". You can select multiple post types by holding down the Control key (or Command on OS X) then clicking.', 'ecpt'); ?></span></a></p><br/>
		</div>
		<label for="ecpt-metabox-context"><?php _e('Context', 'ecpt'); ?></label>
		<select name="metabox-context" id="ecpt-metabox-context" class="ecpt-text"/>
			<option><?php _e('normal', 'ecpt'); ?></option>
			<option><?php _e('advanced', 'ecpt'); ?></option>
			<option><?php _e('side', 'ecpt'); ?></option>
		</select>
		<p class="ecpt-description"><?php _e('The location on the editor screen to display the meta box.', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('Advanced / Normal = main column, with Advanced being above Normal. Side = right, narrow column.', 'ecpt'); ?></span></a></p><br/>
		
		<label for="ecpt-metabox-priority"><?php _e('Priority', 'ecpt'); ?></label>
		<select name="metabox-priority" id="ecpt-metabox-priority" class="ecpt-text"/>
			<option><?php _e('default', 'ecpt'); ?></option>
			<option><?php _e('high', 'ecpt'); ?></option>
			<option><?php _e('core', 'ecpt'); ?></option>
			<option><?php _e('low', 'ecpt'); ?></option>
		</select>
		<p class="ecpt-description"><?php _e('The priority determines how "high" the meta box appears in the editor', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('Metaboxes with "high" priorites will appear above boxes with "default" priority, for example', 'ecpt'); ?></span></a></p><br/>
		
		
		<label for="ecpt-metabox-post-ids"><?php _e('Post / Page IDs', 'ecpt'); ?></label>
		<input type="text" id="metabox-post-ids" name="metabox-post-ids" value="" class="ecpt-text"/>
		<p class="ecpt-description"><?php _e('Limit this meta box to specific post / page IDS. Separate each ID by a comma.', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you want to only display this meta box on specific post / page IDs, then enter the ID numbers here, each one separated by a comma. Leave this field blank to not limit the meta box display.', 'ecpt'); ?></span></a></p><br/>
		
		
	</fieldset><br/>
	<?php echo wp_nonce_field('ecpt_add_metabox_nonce', 'ecpt-metabox-nonce'); ?>
	<input type="hidden" name="ecpt-action" value="add-metabox"/>
	<input type="submit" id="ecpt-submit" class="button-primary" value="<?php _e('Add Meta Box', 'ecpt'); ?>"/>
</form>