<?php
function ecpt_tax_manager() {

	global $wpdb;
	global $ecpt_db_tax_name;
	global $ecpt_base_dir;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;
	?>
	<div class="wrap">
	<div id="ecpt-wrap">
	
		<?php if(isset($_GET['taxonomy-added'])) : ?>
			<div class="updated fade">
				<p>Taxonomy added. Don't forget that you can customize your taxonomy archive layouts with template files.</p>
			</div>
		<?php endif; ?>		
	
		<?php if (isset($_GET['edit-tax'])) : ?>
			<?php include('taxonomy-edit.php'); ?>
		<?php else : ?>
			<?php include('taxonomy-list.php'); ?>
		<?php endif; ?>
		
		<?php if (!isset($_GET['edit-tax'])) :  ?>
	
			<!--custom taxonomy creation form-->
			<h3><?php _e('Create New Custom Taxonomy', 'ecpt'); ?></h3>
			<form method="post" action="" id="ecpt-add-taxonomy">
				<fieldset>
					<legend><?php _e('Taxonomy General', 'ecpt'); ?></legend><br/>
				
					<label for="ecpt-taxonomy-name"><?php _e('Taxonomy Name', 'ecpt'); ?><span class="required">*</span></label>
					<input type="text" name="taxonomy-name" id="ecpt-taxonomy-name" class="ecpt-text" tabindex="1"/>
					<p class="ecpt-description"><?php _e('This is the main name of the taxonomy', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This is the name referenced by the database, if you don\'t know what that means, don\'t worry about it. Just enter a name that makes sense to you', 'ecpt'); ?></span></a></p><br/>
				
					<label for="ecpt-taxonomy-object"><?php _e('Object', 'ecpt'); ?><span class="required">*</span></label>
					<select name="taxonomy-object[]" MULTIPLE id="ecpt-taxonomy-object" class="ecpt-text ecpt-multi-select" tabindex="2"/>
						<?php 
						foreach ( ecpt_get_taxonomy_objects() as $custom_post_type_obj) {
							echo '<option>' . $custom_post_type_obj->name . '</option>';
						}
						?>
					</select>
					<p class="ecpt-description"><?php _e('This is the post type that will use this taxonomy.', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('You may give this taxonomy to more than one post type by holding the Contral (Command on a Mac) and selecting more than one', 'ecpt'); ?></span></a></p><br/>
				</fieldset><br/>
				<fieldset>
					<legend><?php _e('Labels', 'ecpt'); ?></legend><br/>
				
					<label for="label-single"><?php _e('Singular Label', 'ecpt'); ?></label>
					<input type="text" name="label-single" id="label-single" class="ecpt-text" tabindex="3"/>
					<p class="ecpt-description"><?php _e('The label used for single taxonomy items, such as "Genre"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This is the name that will be used to refer to single items of this taxonomy. If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

					<label for="label-plural"><?php _e('Plural Label', 'ecpt'); ?></label>
					<input type="text" name="label-plural" id="label-plural" class="ecpt-text" tabindex="4"/>
					<p class="ecpt-description"><?php _e('The label used for plural taxonomy items, such as "Genres"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This is the name that will be used to refer to plural items. If you leave it blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>
				
				</fieldset><br/>
			
				<fieldset>
					<legend><?php _e('Taxonomy Options', 'ecpt'); ?></legend><br/>
				
					<label for="options-hierarchical"><?php _e('Hierarchical?', 'ecpt'); ?></label>
					<input type="checkbox" name="options-hierarchical" id="options-hierarchical" class="ecpt-checkbox" tabindex="5"/>
					<p class="ecpt-description"><?php _e('Enabling this means that items can have parent and child items', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This means that you will be able to create tiers with this taxonomy, just like the default post categories. Great for catalogs', 'ecpt'); ?></span></a></p><br/>

					<label for="options-tagcloud"><?php _e('Show Tag Cloud?', 'ecpt'); ?></label>
					<input type="checkbox" name="options-tagcloud" id="options-tagcloud" class="ecpt-checkbox" tabindex="6"/>
					<p class="ecpt-description"><?php _e('Enabling this means that this taxonomy can be displayed as a tag cloud', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will allow the terms within this taxonomy to be displayed as a tag cloud, allowing your visitors to view posts by taxonomy term, and also which terms are the most popular. Just like post tags.', 'ecpt'); ?></span></a></p><br/>
				
				
					<label for="options-nav"><?php _e('Show in Nav Menus?', 'ecpt'); ?></label>
					<input type="checkbox" name="options-nav" id="options-nav" class="ecpt-checkbox" checked="checked" tabindex="7"/>
					<p class="ecpt-description"><?php _e('Checking this will cause this taxonomy to show up in the custom nav menu interface', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will allow you to add individual taxonomies and taxonomy terms to the WP nav menus' ,'ecpt'); ?></span></a></p><br/>
				
					<label for="options-slug"><?php _e('Slug', 'ecpt'); ?></label>
					<input type="text" name="options-slug" id="options-slug" class="ecpt-text" tabindex="8"/>
					<p class="ecpt-description"><?php _e('The URL friendly "nice name" of your taxonomy', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('The slug will be displayed in the URL when accessing your taxonomy archives. Example, if you give your Genres taxonomy a slug of "song-types", your archive URL will be http://yoursite.com/song-types, or similar depending on your permalink structure.<br/> The slug is useful when you have a taxonomy and post type (or regular page) that are named the same thing.', 'ecpt'); ?><br/><?php _e('This is an advanced option and should be left blank by most', 'ecpt'); ?></span></a></p><br/>
				
					<label for="options-with-front"><?php _e('Disable with_front?', 'ecpt'); ?></label>
					<input type="checkbox" name="options-with-front" id="options-with-front" class="ecpt-checkbox" checked="checked" tabindex="7"/>
					<p class="ecpt-description"><?php _e('Checking this box means that taxonomy slugs will not be prepended with the front base', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If your permalink structure is /blog/, then your links will be: /blog/{tax-name}/ if you leave this unchecked<br/>Otherwise your your permalinks will be /{tax-name}/', 'ecpt'); ?></span></a></p><br/>
					
					<?php if( is_plugin_active('ecpt-filter-by-taxonomy/ecpt-filter-by-taxonomy.php') ) { ?>
						<label for="options-enable-filter"><?php _e('Enable Filter', 'ecpt'); ?></label>
						<input type="checkbox" name="options-enable-filter" id="options-enable-filter" class="ecpt-checkbox" checked="checked" tabindex="7"/>
						<p class="ecpt-description"><?php _e('Check this to add a drop down of taxonomy terms to the post type list page', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will allow you to filter the entries shown to only those that are filed in the selected taxonomy term', 'ecpt'); ?></span></a></p><br/>
					<?php } ?>
				</fieldset><br/>
				<?php echo wp_nonce_field('ecpt_add_tax_nonce', 'ecpt-tax-nonce'); ?>
				<input type="hidden" name="ecpt-action" value="add-taxonomy"/>
				<input type="submit" id="ecpt-submit" class="button-primary" value="<?php _e('Add Taxonomy', 'ecpt'); ?>" tabindex="9"/>
			</form>
		<?php endif; ?>
	</div>
</div>
<?php 
}