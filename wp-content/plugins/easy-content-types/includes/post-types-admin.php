<?php
function ecpt_posttype_manager() {

	global $wpdb;
	global $ecpt_db_name;
	global $ecpt_base_dir;
	?>
	<div class="wrap">
	<div id="ecpt-wrap">
	<?php if(isset($_GET['post-type-added'])) : ?>
		<div class="updated fade">
			<p><?php _e('Post type added. You should update your <a href="options-permalink.php">permalinks</a> now', 'ecpt'); ?></p>
		</div>
	<?php endif; ?>

	<?php if(isset($_GET['posttype-edit'])) : ?>
		<?php include('post-types-edit.php'); ?>
	<?php else : ?>
		<?php include('post-types-list.php'); ?>
	<?php endif; ?>
		<?php if(!isset($_GET['posttype-edit'])) : ?>
			<!--custom post type creation form-->
			<h3><?php _e('Create New Custom Post Type', 'ecpt'); ?></h3>
			<form method="post" action="" id="ecpt-add-posttype">
				<fieldset>
					<legend><?php _e('Post Type General', 'ecpt'); ?></legend><br/>

					<label for="ecpt-post-type-name"><?php _e('Post Type Name', 'ecpt'); ?><span class="required">*</span></label>
					<input type="text" name="post-type-name" id="ecpt-post-type-name" class="ecpt-text"  tabindex="1"/>
					<p class="ecpt-description"><?php _e('This is the name that you will use to query the custom post type.', 'ecpt'); ?> <strong><?php _e('Note', 'ecpt'); ?>:</strong> <?php _e('names should be no longer than 10 letters<a href="#" class="ecpt-help"><span class="tooltip center midnightblue">This is the name referenced by the database, if you don\'t know what that means, don\'t worry about it. Spaces and capitalization will be removed', 'ecpt'); ?></span></a></p><br/>

				</fieldset><br/>
				<fieldset>
					<legend><?php _e('Labels', 'ecpt'); ?></legend><br/>

					<label for="ecpt-label-single"><?php _e('Singular Label', 'ecpt'); ?></label>
					<input type="text" name="label-single" id="ecpt-label-single" class="ecpt-text" tabindex="2"/>
					<p class="ecpt-description"><?php _e('The label used for single post type items, such as "Book"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

					<label for="ecpt-label-plural"><?php _e('Plural Label', 'ecpt'); ?></label>
					<input type="text" name="label-plural" id="ecpt-label-plural" class="ecpt-text" tabindex="3"/>
					<p class="ecpt-description"><?php _e('The label used for plural post type items, such as "Books"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

					<fieldset id="ecpt-advanced-labels" style="display:none;">
						<legend><?php _e('Advanced Labels', 'ecpt'); ?></legend>

						<p><?php _e('These settings allow you to adjust the advanced display name options for this post type.', 'ecpt'); ?></p>

						<label for="ecpt-advanced-labels[add-new]"><?php _e('Add New', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[add-new]" id="ecpt-advanced-labels[add-new]" class="ecpt-text" tabindex="2" value="<?php _e('Add New', 'ecpt'); ?>"/>
						<p class="ecpt-description"><?php _e('The add new text. Default is "Add New", but could be "Add New Book"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[all-items]"><?php _e('All Items', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[all-items]" id="ecpt-advanced-labels[all-items]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('The all items text used in the menu. Default is the name of your post type entered above.', 'ecpt'); ?>
						<a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[add-new-item]"><?php _e('Add New Item', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[add-new-item]" id="ecpt-advanced-labels[add-new-item]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('The Add New Item text. Default is "Add New {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[edit-item]"><?php _e('Edit Item', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[edit-item]" id="ecpt-advanced-labels[edit-item]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('The Edit Item text. Default is "Edit {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[new-item]"><?php _e('New Item', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[new-item]" id="ecpt-advanced-labels[new-item]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('The new item text. Default is "New {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[view-item]"><?php _e('View Item', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[view-item]" id="ecpt-advanced-labels[view-item]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('The view item text. Default is "View {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[search-items]"><?php _e('Search Items', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[search-items]" id="ecpt-advanced-labels[search-items]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('The search items text. Default is "Search {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[not-found]"><?php _e('Not Found', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[not-found]" id="ecpt-advanced-labels[not-found]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('The no items found text. Default is "No {post type name} found"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[not-found-in-trash]"><?php _e('Not Found in Trash', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[not-found-in-trash]" id="ecpt-advanced-labels[not-found-in-trash]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('The no items found in trash text. Default is "No {post type name} found in Trash"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[parent-item-colon]"><?php _e('Parent Item Text', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[parent-item-colon]" id="ecpt-advanced-labels[parent-item-colon]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('Text used for "Parent Item" label. Default is "Parent {post type name}"', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

						<label for="ecpt-advanced-labels[menu-name]"><?php _e('Menu Name', 'ecpt'); ?></label>
						<input type="text" name="advanced-labels[menu-name]" id="ecpt-advanced-labels[menu-name]" class="ecpt-text" tabindex="2" value=""/>
						<p class="ecpt-description"><?php _e('Name used for the menu text. Defaults to the name of the post type', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you leave this blank, the name field above will be used', 'ecpt'); ?></span></a></p><br/>

					</fieldset>
					<button class="ecpt-advanced-labels button-secondary"><?php _e('Show Advanced Labels', 'ecpt'); ?></button>
					<button class="ecpt-advanced-labels button-secondary" style="display:none;"><?php _e('Hide Advanced Labels', 'ecpt'); ?></button>
				</fieldset><br/>

				<fieldset>
					<legend><?php _e('Post Type Options', 'ecpt'); ?></legend><br/>

					<label for="ecpt-options-hierarchical"><?php _e('Hierarchical', 'ecpt'); ?>?</label>
					<input type="checkbox" name="options-hierarchical" id="ecpt-options-hierarchical" class="ecpt-checkbox" tabindex="4"/>
					<p class="ecpt-description"><?php _e('Enabling this means that items can have parents and child items', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('Hierarchical post types work the same way that the regular Pages work.', 'ecpt'); ?></span></a></p><br/>

					<label for="ecpt-options-archives"><?php _e('Enable Archives?', 'ecpt'); ?></label>
					<input type="checkbox" name="options-archives" id="ecpt-options-archives" class="ecpt-checkbox" checked="checked" tabindex="5"/>
					<p class="ecpt-description"><?php _e('This will enable archives, such as monthly and yearly, for this post type', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('Enabling this option will create archives for your post type, so that you can display a list of all items filed under a particular month or taxonomy', 'ecpt'); ?></span></a></p><br/>

					<label for="options-post_formats"><?php _e('Post Formats?', 'ecpt'); ?></label>
					<input type="checkbox" name="options-post_formats" id="options-post_formats" class="ecpt-checkbox" checked="checked" tabindex="6"/>
					<p class="ecpt-description"><?php _e('This will enable post formats, gallery, aside, default', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will allow the new 3.1 feature for post formats to be used for this post type', 'ecpt'); ?></span></a></p><br/>

					<label for="options-search"><?php _e('Exclude from Search?', 'ecpt'); ?></label>
					<input type="checkbox" name="options-search" id="options-search" class="ecpt-checkbox" tabindex="7"/>
					<p class="ecpt-description"><?php _e('Checking this option will prevent this post type from showing up in search results', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you don\'t want this post type to be searchable, enable this option', 'ecpt'); ?></span></a></p><br/>

					<label for="options-nav"><?php _e('Show in Nav Menus?', 'ecpt'); ?></label>
					<input type="checkbox" name="options-nav" id="options-nav" class="ecpt-checkbox" checked="checked" tabindex="8"/>
					<p class="ecpt-description"><?php _e('Checking this will cause this post type to show up in the custom nav menu interface', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will allow you to add items from this post type to custom navigation menus', 'ecpt'); ?></span></a></p><br/>

					<label for="upload_image_1"><?php _e('Menu Icon', 'ecpt'); ?></label>
					<input type="text" name="options-icon" id="upload_image_1" class="posttype-menu-icon ecpt-text" tabindex="9" />
					<input id="upload_image_button_1" class="ecpt_upload_image_button button-secondary" value="<?php _e('Choose Image', 'ecpt'); ?>" type="button" /><br/>
					<p class="ecpt-description ecpt-upload-desc"><?php _e('Enter the URL to your menu icon, or click Choose Image to upload an icon. Optimal size: 16x16 px', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This is the icon that appears to the left of the post type name in the left navigation menu', 'ecpt'); ?></span></a></p><br/>


				</fieldset><br/>

				<fieldset>
					<legend><?php _e('Post Type Supports', 'ecpt'); ?></legend><br/>

					<label for="options-title"><?php _e('Title', 'ecpt'); ?></label>
					<input type="checkbox" name="options-title" id="options-title" class="ecpt-checkbox" checked="checked" tabindex="10"/>
					<p class="ecpt-description"><?php _e('Enable titles for this post type?', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enabled the title field for the post type', 'ecpt'); ?></span></a></p><br/>

					<label for="options-editor"><?php _e('Editor', 'ecpt'); ?></label>
					<input type="checkbox" name="options-editor" id="options-editor" class="ecpt-checkbox" checked="checked" tabindex="11"/>
					<p class="ecpt-description"><?php _e('Enable the main content editor for this post type?', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enable the main content editor, including upload media and formating buttons', 'ecpt'); ?></span></a></p><br/>

					<label for="options-author"><?php _e('Author', 'ecpt'); ?></label>
					<input type="checkbox" name="options-author" id="options-author" class="ecpt-checkbox" checked="checked" tabindex="12"/>
					<p class="ecpt-description"><?php _e('Enable author selection for this post type?', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enable the drop down author selection', 'ecpt'); ?></span></a></p><br/>

					<label for="options-thumbnail"><?php _e('Thumbnail', 'ecpt'); ?></label>
					<input type="checkbox" name="options-thumbnail" id="options-thumbnail" class="ecpt-checkbox" checked="checked" tabindex="13"/>
					<p class="ecpt-description"><?php _e('Enable the featured post image for this post type?', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enable the featured post thumbnail option', 'ecpt'); ?></span></a></p><br/>

					<label for="options-excerpt"><?php _e('Excerpt', 'ecpt'); ?></label>
					<input type="checkbox" name="options-excerpt" id="options-excerpt" class="ecpt-checkbox" checked="checked" tabindex="14"/>
					<p class="ecpt-description"><?php _e('Enable the custom crafted excerpt for this post type?', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enable the hand crafted excerpt box that can be used in place of the auto-generated excerpt', 'ecpt'); ?></span></a></p><br/>

					<label for="options-custom-fields"><?php _e('Custom Fields', 'ecpt'); ?></label>
					<input type="checkbox" name="options-custom-fields" id="options-custom-fields" class="ecpt-checkbox" checked="checked" tabindex="15"/>
					<p class="ecpt-description"><?php _e('Enable custom fields for this post type?', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enable the custom fields for this post type', 'ecpt'); ?></span></a></p><br/>

					<label for="options-comments"><?php _e('Comments', 'ecpt'); ?></label>
					<input type="checkbox" name="options-comments" id="options-comments" class="ecpt-checkbox" checked="checked" tabindex="16"/>
					<p class="ecpt-description"><?php _e('Enable comments for this post type?', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enable the option to turn on or off comments for this post type','ecpt'); ?></span></a></p><br/>

					<label for="options-revisions"><?php _e('Revisions','ecpt'); ?></label>
					<input type="checkbox" name="options-revisions" id="options-revisions" class="ecpt-checkbox" checked="checked" tabindex="17"/>
					<p class="ecpt-description"><?php _e('Enable revisions for this post type?','ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enable automatic revision control, allowing you to revert back to previous item versions', 'ecpt'); ?></span></a></p><br/>

					<label for="options-tags"><?php _e('Post Tags', 'ecpt'); ?></label>
					<input type="checkbox" name="options-tags" id="options-tags" class="ecpt-checkbox"  tabindex="18"/>
					<p class="ecpt-description"><?php _e('Enable post tags for this post type?', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enable the default post tags taxonomy for this post type', 'ecpt'); ?></span></a></p><br/>

					<label for="options-categories"><?php _e('Categories', 'ecpt'); ?></label>
					<input type="checkbox" name="options-categories" id="options-categories" class="ecpt-checkbox" tabindex="19"/>
					<p class="ecpt-description"><?php _e('Enable categories?','ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('This will enable the default categories taxonomy for this post type', 'ecpt'); ?></span></a></p><br/>

					<label for="options-advanced-supports"><?php _e('Advanced Supports', 'ecpt'); ?></label>
					<input type="text" name="options-advanced-supports" id="options-advanced-supports" class="ecpt-text regular-text" tabindex="20"/>
					<p class="ecpt-description"><?php _e('Additional support options. Separate each by a comma.','ecpt'); ?>
						<a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('For advanced users only. To enable custom support options, such as "headway-seo", enter each option here separated by a comma.', 'ecpt'); ?></span></a>
					</p><br/>


				</fieldset><br/>

				<fieldset>
					<legend><?php _e('Advanced', 'ecpt'); ?></legend><br/>

					<label for="advanced-position"><?php _e('Menu Position', 'ecpt'); ?></label>
					<input type="text" name="advanced-position" id="advanced-position" class="ecpt-text" tabindex="21" />
					<p class="ecpt-description">
						<?php _e('Enter the menu position for the post type. Click the help icon for a list of options', 'ecpt'); ?>
						<a href="#" class="ecpt-help"><span class="tooltip center midnightblue">
						5 - <?php _e('below Posts', 'ecpt'); ?><br/>
						10 - <?php _e('below Media', 'ecpt'); ?><br/>
						15 - <?php _e('below Links', 'ecpt'); ?><br/>
						20 - <?php _e('below Pages', 'ecpt'); ?><br/>
						25 - <?php _e('below Comments', 'ecpt'); ?><br/>
						60 - <?php _e('below first separator', 'ecpt'); ?><br/>
						65 - <?php _e('below Plugins', 'ecpt'); ?><br/>
						70 - <?php _e('below Users', 'ecpt'); ?><br/>
						75 - <?php _e('below Tools', 'ecpt'); ?><br/>
						80 - <?php _e('below Settings', 'ecpt'); ?><br/>
						100 - <?php _e('below second separator', 'ecpt'); ?><br/>
						<br/></span></a>
					</p><br/>

					<label for="advanced-slug"><?php _e('Post Type Slug', 'ecpt'); ?></label>
					<input type="text" name="advanced-slug" id="advanced-slug" class="ecpt-text" tabindex="22" />
					<p class="ecpt-description">
						<?php _e('Enter the URL friendly slug to use for your post type.', 'ecpt'); ?>
						<a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('The slug is the URL friendly name of your post type. It will be displayed in the URL when viewing a post type entry or archive. Only advanced users should enter anything here', 'ecpt'); ?><br/></span></a>
					</p><br/>

					<label for="advanced-with-front"><?php _e('Disable with_front?', 'ecpt'); ?></label>
					<input type="checkbox" name="advanced-with-front" id="advanced-with-front" class="ecpt-checkbox" tabindex="23" checked="checked"/>
					<p class="ecpt-description"><?php _e('Checking this box means that post type slugs will not be prepended with the front base', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If your permalink structure is /blog/, then your links will be: /blog/{post-type-name}/ if you leave this unchecked<br/>Otherwise your your permalinks will be /{post-type-name}/', 'ecpt'); ?></span></a></p><br/>


				</fieldset><br/>
				<?php echo wp_nonce_field('ecpt_add_post_type_nonce', 'ecpt-cpt-nonce'); ?>
				<input type="hidden" name="ecpt-action" value="add-post-type"/>
				<input type="submit" name="ecpt-submit" id="ecpt-submit" class="button-primary" value="<?php _e('Add Post Type', 'ecpt'); ?>"  tabindex="24"/>
			</form>
		<?php endif; ?>
	</div>
</div>
<?php
}