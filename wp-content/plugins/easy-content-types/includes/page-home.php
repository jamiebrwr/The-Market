<?php
function ecpt_home_page()
{
	?>
	<div class="wrap">
		<div id="ecpt-wrap">
			<h2><?php _e('About Custom Content Types Plugin', 'ecpt'); ?></h2>
			<div class="ecpt-row ecpt-clearfix">
				<div class="ecpt-box-long">
					<h3><?php _e('Created By Pippin Williamson', 'ecpt'); ?></h3>
					<p><?php _e('This plugin is designed to make the life of developers and non-developers alike much easier by providing an easy to use interface for creating custom post types, metaboxes, and taxonomies. By eliminating all of the hassel the create post types, taxonomies, and metaboxes, this plugin will likely become your new best friend.', 'ecpt'); ?></p>
					<p><?php _e('For developers, this plugin has everything you need when it comes to working with these three elements, including auto creation of template files. If you are not a developer, then you will still be able to make full use of this plugin. It is not limited to developers in any way.', 'ecpt'); ?></p>
				</div>
			</div>
			<div class="ecpt-row ecpt-clearfix">
				<div class="ecpt-box">
					<h3><?php _e('What are Custom Post Types', 'ecpt'); ?></h3>
					<p><?php _e('Custom post types are a way for you to logically organize the content within your WordPress powered website. Rather than simply filing all of your content into differently categorized posts or pages, custom post types allow you to define easy-to-understand "sections" of your website, such as Books, Music, Podcasts, etc.', 'ecpt'); ?></p>
				</div>
				<div class="ecpt-box">
					<h3><?php _e('What are Custom Taxonomies', 'ecpt'); ?></h3>
					<p><?php _e('Custom Taxonomies act very similar to the default Categories or Post Tags, with one major distinction: they can be named whatever you choose, allowing you to define an organization system that makes sense for your website. For example, if you run an online music catalog, it would make sense for you be able to organize your products into Genres, Years, and Country; and then each of those into further levels of distinction, such as Hard Rock, Pop, and Classical.', 'ecpt'); ?></p>
				</div>
			</div>
			<div class="ecpt-row ecpt-clearfix">
				<div class="ecpt-box">
					<h3><?php _e('What are Custom Meta Boxes', 'ecpt'); ?></h3>
					<p><?php _e('Custom Metaboxes are sets of additional editable fields that may be added to posts, page, and any custom post type. The fields contained within the meta boxes can be used to store any kind of data you choose. They\'re often used for image thumbnails, portfolio links, author bios, etc. The types of fields that may be included at: single line text inputs, large text areas, checkboxes, radio button groups, and drop down select menus.', 'ecpt'); ?></p>
				</div>
				<div class="ecpt-box">
					<h3><?php _e('Theme Templates for Custom Content Types', 'ecpt'); ?></h3>
					<p><?php _e('By separating a site\'s content into different custom post types, it makes things much easier to organize and understand. Included with the custom post types, are customizable theme templates that are used to display the post types on the front end of the website. This means that you can have one post type displayed in one manner, while another post type is displayed in a completely different way. Everything from layout to colors.', 'ecpt'); ?></p>
				</div>
			</div>
			<div class="ecpt-row ecpt-clearfix">
				<div class="ecpt-box-long">
					<h3><?php _e('Need Support?', 'ecpt'); ?></h3>
					<p><?php _e('Support for this plugin is provided through my dedicated support forum. The forum is for legal purchasers of Easy Content Types. If you have obtained the plugin elsewhere (except through a valid contest or give away), please do us all a favor a refrain from asking questions on the support forum.', 'ecpt'); ?></p>
					<p><?php _e('The support forum can be found here:', 'ecpt'); ?> <a href="http://support.pippinsplugins.com/forums/">Plugin Support Forum</a></p>
				</div>
			</div>
		</div><!--end ecpt-wrap-->
	</div><!--end wrap-->
	<?php
}
?>