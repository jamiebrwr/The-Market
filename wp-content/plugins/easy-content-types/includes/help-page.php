<?php

function ecpt_help_page() {

	?>
	<div class="wrap">
		<div id="ecpt-wrap" class="ecpt-help-page">
			<h2><?php _e('Easy Custom Content Types Help', 'ecpt'); ?></h2>
			<p><?php _e('Index', 'ecpt');?></p>
			<ul>
				<li><a href="#posttypes"><?php _e('Post Types', 'ecpt'); ?></a>
					<ul>
						<li><a href="#creating-post-types"><?php _e('Creating Post Types', 'ecpt'); ?></a></li>
						<li><a href="#post-type-labels"><?php _e('Post Type Labels', 'ecpt'); ?></a></li>
						<li><a href="#post-type-options"><?php _e('Post Type Options', 'ecpt'); ?></a></li>
						<li><a href="#post-type-support-options"><?php _e('Post Type Support Options', 'ecpt'); ?></a></li>
						<li><a href="#post-type-advanced"><?php _e('Post Type Advanced Options', 'ecpt'); ?></a></li>
						<li><a href="#editing-post-types"><?php _e('Editing Post Types', 'ecpt'); ?></a></li>
						<li><a href="#theme-template-files"><?php _e('Theme Template Files', 'ecpt'); ?></a></li>
						<li><a href="#template-hierarchy"><?php _e('Template Hierarchy', 'ecpt'); ?></a></li>
						<li><a href="#showing-posttypes"><?php _e('Querying Post Types', 'ecpt'); ?></a></li>
					</ul>				
				</li>
				<li><a href="#taxonomies"><?php _e('Taxonomies', 'ecpt'); ?></a>
					<ul>
						<li><a href="#creating-taxonomies"><?php _e('Creating Taxonomies', 'ecpt'); ?></a></li>
						<li><a href="#taxonomy-objects"><?php _e('Taxonomy Objects', 'ecpt'); ?></a></li>
						<li><a href="#taxonomy-options"><?php _e('Taxonomy Options', 'ecpt'); ?></a></li>
						<li><a href="#editing-taxonomies"><?php _e('Editing Taxonomies', 'ecpt'); ?></a></li>
						<li><a href="#taxonomy-info"><?php _e('Displaying Taxonomy Info', 'ecpt'); ?></a></li>
						<li><a href="#taxonomy-posts"><?php _e('Displaying Posts with a Taxonomy', 'ecpt'); ?></a></li>
						<li><a href="#taxonomy-defaults"><?php _e('Adding Default Category and Post Tags to Custom Post Types', 'ecpt'); ?></a></li>
						<li><a href="#taxonomy-advanced-slugs"><?php _e('Setting {post-type}/{taxonomy} permalink structures', 'ecpt'); ?></a></li>
					</ul>				
				</li>
				<li><a href="#metaboxes"><?php _e('Meta Boxes', 'ecpt'); ?></a>
					<ul>
						<li><a href="#creating-metaboxes"><?php _e('Creating Meta Boxes', 'ecpt'); ?></a></li>
						<li><a href="#metabox-locations"><?php _e('Selecting Meta Box Location', 'ecpt'); ?></a></li>
						<li><a href="#editing-metaboxes"><?php _e('Editing Meta Boxes', 'ecpt'); ?></a></li>
						<li><a href="#metabox-fields"><?php _e('Adding / Editing Fields to Meta Box', 'ecpt'); ?></a></li>
						<li><a href="#field-types"><?php _e('Field Types', 'ecpt'); ?></a></li>
						<li><a href="#field-info"><?php _e('Displaying Field Info in Your template', 'ecpt'); ?></a></li>
					</ul>
				</li>
				<li><a href="#access"><?php _e('User Access', 'ecpt'); ?></a>
			</ul>
			
			
			<h3 id="posttypes"><?php _e('Post Types', 'ecpt'); ?></h3>
				<div class="ecpt_section">
				<p id="creating-post-types" class="ecpt_title"><strong><?php _e('Creating Post Types', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
					<p>To create a new custom post type, first click on "Post Types" from the "Content Types" menu. You will now be presented with a screen displaying a list of all of the currently registered custom post types (through this plugin only), as well as a form to create a new post type.</p>
					
					<p>Fill in each of the fields, and select the options you want for your post type, then click "Add Post Type". The screen will refresh and you will see your newly added post type in the list, as well as a menu item in the left WordPress navigation.</p>
					
					<p>The only required field is "Post Type Name". Whatever you enter in this field will be used as the main post type name, meaning that this is the name that will use to query the post type from the database. This field will also be used for the Singular and Plural labels, if these fields are left empty.</p>
					
					<p><em>Note</em>, whatever you enter into the Post Type Name field is automatically lowercased and all spaces removed. So, if you enter "My Post Type", it would be saved as "myposttype", and this is the value you'd use to query the database.</p>
					
					<p><em>TIP:</em> Every field has a blue question mark to the right of it. Click these for hints if you are confused.</p>
				</div>
				
				<p id="post-type-labels" class="ecpt_title"><strong><?php _e('Post Type Labels', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>The post type labels are the names for the post type that are displayed through the interface to the user. The Singular Name refers to single items of the post type, and, obviously, the Plural Name refers to plural items of the post type. So, for example, if you have a post type called Books, then the singular label would be displayed as "Book", and the plural label would be "Books". <em>Note</em>, the plurality is not automatically determined from the Post Type Name field. The values you enter in these two fields are what will be used.</p>
					
					<p>This two fields both accept spaces and capitalization.</p>
				</div>
				
				<p id="post-type-options" class="ecpt_title"><strong><?php _e('Post Type Options', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p><em>Hierarchical</em>: This option controls whether or not a post type is hierarchical, meaning that parent and child items can be specified. This is how the default WordPress Pages behave.</p>
					<p><em>Enable Arhcives</em>: This option controls whether post type archives, monthly, yearly, categorical, can be displayed. If this option is disabled, you will be unable view archives of this post type.</p>
					<p><em>Post Formats</em>: This option controls whether <a href="http://codex.wordpress.org/Post_Formats">Post Formats</a> are enabled for this post type.</p>
					<p><em>Exclude From Search</em>: This option, if enabled, will prevent a post type from being searchable, through your websites search form. Items are still searchable in the admin.</p>
					<p><em>Show in Nav Menus</em>: This option, when enabled, when cause a post type, and all of it's published items, to show up in the WP navigation menu interface, meaning that you can add individual items to your navigation menus.</p>
					<p><em>Menu Icon</em>: This is the image displayed next to your post type name in the main WordPress admin menu. If no image is specified, the default thumb tack image will be used.</p>
				</div>
				
				<p id="post-type-support-options" class="ecpt_title"><strong><?php _e('Post Type Support Options', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p><em>Title</em>: This option will make the Title field available for a post type in the main post editor.</p>
					<p><em>Editor</em>: This option will enable the main content editor for a post type, including the Visual / HTML editors, all media upload buttons, and all formatting options.</p>
					<p><em>Author</em>: This option will enable the drop-down author selection for a post type.</p>
					<p><em>Thumbnail</em>: This option will allow the Featured Post Thumbnail for a post type.</p>
					<p><em>Excerpt</em>: This option will enable the hand-crafted, custom excerpt box for a post type.</p>
					<p><em>Custom Fields</em>: This option will enable the use of custom fields for a post type.</p>
					<p><em>Comments</em>: This option will enable the Comments ON / OFF feature for a post type, allowing you to specify whether comments should be allowed for a particular item.</p>
					<p><em>Revisions</em>: This option will enable automatic item revisions, allowing you to revert back to previous verions of an item if need be.</p>
				</div>
				
				<p id="post-type-advanced" class="ecpt_title"><strong><?php _e('Post Type Advanced Options', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p><em>Menu Position</em>: This is the position in the left menu bar that your post type page will be placed. Choose from a number below and enter it in the field. </p>
						<div style="padding-left: 30px;">
							5 - below Posts<br/>
							10 - below Media<br/>
							15 - below Links<br/>
							20 - below Pages<br/>
							25 - below Comments<br/>
							60 - below first separator<br/>
							65 - below Plugins<br/>
							70 - below Users<br/>
							75 - below Tools<br/>
							80 - below Settings<br/>
							100 - below second separator
						</div>
						
					<p><em>Slug</em>: The post type slug allows you to define a custom permalink for your post type. The permalink is what shows up in the URL before the post type entry name. For example, you have a post type named Books and you are viewing the Books entry named My Great Book; the url to this book will look something like this: http://yousite.com/books/my-great-book. Note that by default, ECPT will use a lowercased (and spaces removed) version of the post type name as the slug.</p>

					<p>If you wanted to change the /books/ part of the url above, you'd enter your desired value in the Slug field. So, for example, if you entered "timeless-books", the url to My Great Book would be http://yoursite.com/timless-books/my-great-book.</p>
					
					<p>The slug should be URL friendly, and so no spaces or capitalization is allowed. If you try to enter "Timeless Books" as your slug, it will be saved as "timeless-books".</p>
					
					<p><em>Disable with_front</em>: If you go to your Permalinks settings page and look at the Custom Structure, you will see that it is prepended with something like /blog/. If with_front is enabled, this /blog/ (or whatever yours may be), will be included in your post type permalink structure. If, however, it is disabled, then it will not be included in your structure.</p>
					
				</div>
				
				<p id="editing-post-types" class="ecpt_title"><strong><?php _e('Editing Post Types', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>Once a post type is created, it may be edited at any time by first clicking "Post Types" in the "Content Types" menu, then clicking "Edit" on the post type you wish to modify. The Edit link in towards the right side in the "Edit" column.</p>
					
					<p>When you click "Edit", you will be taken to a new screen displaying only the information pertaining to the particular post type you are editing. Once you have made your changes, click Update and you will be redirected back to the main Post Types screen.</p>
					
					<p>If you wish to cancel editing a post type, without saving, you can click the "Go Back" link at the top, and you will be returned to the main Post Types screen without making any changes to your post type.</p>
				</div>
				
				<p id="theme-template-files" class="ecpt_title"><strong><?php _e('Theme Template Files', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>In the "Settings" page, there is an option to automatically create theme template files. If these options are enabled, template files specific to the post type will be created when post types are created. For example, if you create a post type called "Books", then a template file called <em>single-books.php</em> will be created in your theme directory. Another template file called <em>archive-books.php</em> will also be created, and it will be used for archive displays of this post type.</p>
				</div>
				
				<p id="template-hierarchy" class="ecpt_title"><strong><?php _e('Template Hierarchy', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>The template hierarchy refers to which theme file is used in certain circumstances, and which files act as backups if those files do not exist.</p>
					
					<p>If the automatic template creation options are enabled, then those created files will always be used when displaying content from the post types.</p>
					
					<p>For Single post type items, the first template that WordPress will try to use is <em>single-{post-type-name}.php</em>. If that file does not exist, then WordPress will use <em>single.php</em>. And if that doesn't exist, then WordPress will use <em>index.php</em>.</p>
					
					<p>For Archives, the first template that WordPress will try to use is <em>archive-{post-type-name}.php</em>. If that file does not exist, then WordPress will use <em>archive.php</em>. And if that doesn't exist, then WordPress will use <em>index.php</em>.</p>
				</div>
				
				<p id="showing-posttypes" class="ecpt_title"><strong><?php _e('Querying Post Types', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
					<div class="ecpt_section">
						<p><strong>Showing Items from a Post Type with a Short Code</strong></p>
						<p>Easy Content Types provides a short code that you can use to display items from a custom post type an page/post in your WordPress site.</p>
						<p><em>[ecpt_query]</em></p>
						<p>This short code accepts several parameters:</p>
						<ul>
							<li><em>post_type</em> - this is the post type you want to show. Default is "post"</li>
							<li><em>tax</em> - this is taxonomy of the post type you want to show items from. Default is NULL.</li>
							<li><em>terms</em> - this is a comma deliminated list of the taxonomy terms you want to display items from. Default is NULL</li>
							<li><em>number</em> - this is the number of items you want to display</li>
							<li><em>orderby</em> - display posts ordered by "title", "post_date" (default), or "rand" (random)</li>
							<li><em>order</em> - ASC (ascending) or DESC (descending) order</li>
							<li><em>thumbnails</em> - yes/no - whether to display Featured Images with each post (if they have one)</li>
							<li><em>thumb_size</em> - the size in pixels of the thumbnail to show. Always square.</li>
						</ul>
						
						<p>So to display the latest 5 items from the Books custom post type, you would use:</p>
						
						<p><em>[ecpt_query post_type="books" number=5]</em></p>
						
						<p>To display the latest 5 items from the Books post type that have a Genre of Fantasy, and are ordered by book title you would use:</p>
						
						<p><em>[ecpt_query post_type="books" tax="genre" terms="fantasy" number=5 orderby="title"]</em></p>
												
						<p><strong>Showing Items With Thumbnails</strong></p>
						
						<p>To display a post list with thumbnails, use a short code like this:</p>
						
						<p><em>[ecpt_query post_type="book" thumbnails="yes" thumb_size="20"]</em></p>
						
						<p><strong>Showing Items from a Post Type in a Template File</strong></p>
						
						<p>The easiest way is to use the <em>do_shortcode()</em> function in conjunction with the short code described above. Like so:</p>
						
						<p><em>echo do_shortcode('[ecpt_query post_type="books" number=5]');</em></p>
						
						<p>If you know what you are doing, then it is advised that you use a custom query instead to show latest items from a post type. Here's one example of what the query may look like:</p>
						
						<p>
						<em>
						&lt;?php 
						$items = new WP_Query( array( 'post_type' => 'post_type_name', 'showposts' => 10 ) ); <br/>
						if( $items->have_posts() :<br/>
							&nbsp;while( $items->have_posts() ) : $items->the_post();<br/>
								&nbsp;// show item info here <br/>
							&nbsp;endwhile;<br/>
							&nbsp;wp_reset_postdata();<br/>
						endif;<br/>
						?&gt;
						</em></p>
						<p>You can also do the same thing using a get_posts() function:</p>
						
						<p>
						<em>
						&lt;?php 
						get_posts( array( 'post_type' => 'post_type_name', 'showposts' => 10 ) ); <br/>
						// the wordpress loop goes here<br/>
						?&gt;
						</em>
						</p>
					</div>
			<h3 id="taxonomies"><?php _e('Taxonomies', 'ecpt'); ?></h3>
				<p id="creating-taxonomies" class="ecpt_title"><strong><?php _e('Creating Taxonomies', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>First, click "Taxonomies" in the "Content Types" menu, then fill in all of the form fields and click "Add Taxonomy". The screen will refresh and your new taxonomy will be display in the custom taxonomy table at the top of the screen.</p>
					
					<p>There are two required files: Taxonomy Name and Object.</p>
					
					<p>The value that you enter in Taxonomy Name will be used as the main name of the taxonomy, meaning that this is what will be used to query the taxonomy from the database. Any value you enter here, will be lowercased and all spaces removed. So, for example, if you enter "Music Genres", then the name will be converte to "musicgenres".</p>
					
					<p><em>Labels</em>: The Singular Label is the name that will be used to refer to single taxonomy terms. The Plural Label is the name that will be used to refer to plural taxonomy terms. So, for example, if you have a taxonomy name "Genres", then the singular label might be "Genre", and the plural label might be "Genres".</p>
				</div>
				
				<p id="taxonomy-objects" class="ecpt_title"><strong><?php _e('Taxonomy Objects', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>The Taxonomy Objects are the post types that will receive the custom taxonomy. So, for example, if you want to apply your taxonomy to the regular WordPress Page and also a custom post type called "Books", then you'd choose "page" and "books" when creating your taxonomy.</p>
					
					<p>You may choose as many objects as you wish, but must choose at least one.</p>
				</div>
				
				<p id="taxonomy-options" class="ecpt_title"><strong><?php _e('Taxonomy Options', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p><em>Hierarchical</em> - This option will enable archives for a custom taxonomy, allowing you to place your taxonomies into tiers with child and parent terms.</p>
					
					<p><em>Show Tag Cloud</em> - This option will allow the terms (similar to post tags) of your taxonomy to be displayed in a "tag cloud" format, meaning that you can display links to the term archives and also display the most popular terms.</p>
					
					<p><em>Show in Nav Menus</em> - This option will allow terms of this taxonomy to appear in the custom WP nav menus.</p>
					
					<p><em>Slug</em> - This option will allow you to set the name of the taxonomy that show up in the permalink structure. For example, if you have a taxonomy name "Genres", your permalink structure will, by default, look like this:</p> 
					
					<p>/genres/genre-term/</p>
					
					<p>But, if you choose to set a custom slug, your permalink could look like this:</p>
					<p>/genre-types/genre-term/</p>
					
					<p><em>Disable with_front</em>: If you go to your Permalinks settings page and look at the Custom Structure, you will see that it is prepended with something like /blog/. If with_front is enabled, this /blog/ (or whatever yours may be), will be included in your taxonomy permalink structure. If, however, it is disabled, then it will not be included in your structure.</p>
				</div>
				
				<p id="editing-taxonomies" class="ecpt_title"><strong><?php _e('Editing Taxonomies', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>Once you have created a custom taxonomy, you can edit the taxonomy at any time. To do this, first click on the "Taxonomies" link from the "Content Types" menu, then click "Edit" on the taxonomy you wish to edit. The edit link is towards the right side of the screen on the Taxonomies screen.</p>
					
					<p>When you have clicked "Edit", the information for the particular taxonomy you are editing will be displayed. Once you have modified all of the necessary information, click Update and your changes will be saved. Then you will be redirected back to the main taxonomy page.</p>
					
					<p>If you wish to exit from the edit screen without saving any changes, click the "Go Back" link at the top of the screen.</p>
				</div>
				
				<p id="taxonomy-info" class="ecpt_title"><strong><?php _e('Displaying Taxonomy Info', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p><em>List of Terms Attached to Current Post</em> - If you want to display a list of all the terms of a custom taxonomy attached to the currently view post (or custom post type), you can use this:
						<pre>echo get_the_term_list( $post->ID, $taxonomy, $before, $sep, $after );</pre><br/>
						<ul>
							<li><em>$post->ID</em> - the ID of the post you wish to display. Use $post-> for current post</li>
							<li><em>$taxonomy</em> - the name of the taxonomy you wish to show terms from</li>
							<li><em>$before</em> - text to show before the list of terms</li>
							<li><em>$sep</em> - text or HTML tag to use to separate the terms inside the list</li>
							<li><em>$after</em> - text or show after the list of terms</li>
						</ul>
						So, for example, if your taxonomy was named "Genres", you would do something like this:
						<pre>echo get_the_term_list( $post->ID, 'genres', 'Genres: ', ' ', '' );</pre><br/>
						which would display somthing like this:<br/>
						<pre>Genres: Genre1, Genre2 . . . </pre>
						Each genre would be linked to an archive of all posts with the same genre.
						
					</p>
				</div>
				
				<p id="taxonomy-posts" class="ecpt_title"><strong><?php _e('Displaying Posts with a Taxonomy', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
					<div class="ecpt_section">
						<p>If you want to display a list of posts that have a particular taxonomy, then you can use a query_posts() like this:
						
						<pre>query_posts( array( 'genres' => 'hard-rock', 'showposts' => 10 ) ); </pre>
						
						<p>The query above will just display posts that have the "hard-rock" term, but if you'd like to get more advanced and learn how to pull posts that meet several criteria, perhaps in the "hard-rock" genre, have a "year" of 1990, and a "country" of "America", you can use the WordPress 3.1 <em>tax_query</em> feature. This is advanced feature, so I will let you read my tutorial at <a href="http://www.wpmods.com/query-multiple-taxonomies-in-wp-3-1">WP Mods</a> if you are interested.
						
					</div>
				
				<p id="taxonomy-defaults" class="ecpt_title"><strong><?php _e('Adding Default Category and Post Tags to Custom Post Types', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
					<div class="ecpt_section">
						<p>To enable the default Category and / or Post Tags on a custom post type all you need to do is check the box for Post Tags or Categories on the post type creation or edit page.</p>
					</div>
					
				<p id="taxonomy-advanced-slugs" class="ecpt_title"><strong><?php _e('Setting {post-type}/{taxonomy} permalink structures', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
					<div class="ecpt_section">
						<p>If you want your taxonomy permalinks to display like this:</p>
						
						<p>/{post-type-slug}/{taxonomy-slug}/</p>
						
						<p>You will need to enter a custom value in the taxonomy slug field. It is very simple but must be done correctly, otherwise your permalink structure will break.</p>
						
						<p>Let's say that you have a post type name "Books", with a slug of "books", and it has a taxonomy attached to it called "Genres" with a slug of "genres", and when viewing a genre term archive you want the permalink structure to look like this:</p>
						
						<p>/books/genres/my-genre/</p>
						
						<p>you would need to enter</p>
						
						<p>/books/genres/</p>
						
						<p>in your taxonomy slug field</p>
						
						<p>It is very, very important that the slug of your post type and the value you enter in the taxonomy slug match exactly.</p>
						
					</div>
				
			<h3 id="metaboxes"><?php _e('Meta Boxes', 'ecpt'); ?></h3>
				<p id="creating-metaboxes" class="ecpt_title"><strong><?php _e('Creating Meta Boxes', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>To create a custom metabox, first click on "Meta Boxes" in the main "Content Types" menu. All already created meta boxes will be displayed in the table at the top of the page.</p>
					
					<p>Adding a new metabox is simple, just fill out the "Create New Custom Metabox" form and click "Add Meta Box".</p>
					
					<p>The metabox name is the only required field and the value you enter here is what will be displayed in the header of the metabox, on the editor screen.</p>
				</div>
				
				<p id="metabox-locations" class="ecpt_title"><strong><?php _e('Selecting Meta Box Location', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>Their are several locations where you can place your custom metabox on the editor screen. The first option is the "Page". This determines which post type page the metabox appears one. For example, if you choose "post", then your metabox appear on the regular WordPress Post editor screens. If you choose, say "Books", then your metabox will appear on the custom post type called "books".</p>
					
					<p>The second level of placement control is the "Context" option. This determines where on the screen the metabox appears.
						<ul>
							<li>normal - in the left, main column of the post editor</li>
							<li>advanced - in the left, main column of the post editor above any "normal" metaboxes</li>
							<li>side - in the right, side column of the post editor</li>
						</ul>
					</p>
					
					<p>The third level of placement control is the "Priority" option. This determines how "high" on the screen the metabox should appear. The priority hierarchy goes like this:
					<ol>
						<li>high</li>
						<li>core</li>
						<li>default</li>
						<li>low</li>
					</ol>
				
				<p id="editing-metaboxes" class="ecpt_title"><strong><?php _e('Editing Meta Boxes', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				
					<p>To edit a metaox you have created, first click "Meta Boxes" from the main "Content Types" menu, then click "Edit" towards the right side of the screen for the particular meta box you wish to modify. Once you do this, you will be directed to a screen displaying all the options for this meta box. When you have made your changes, click "Update". You will now be redirected back to the main Meta Box screen and all your changes will be saved.</p>
					
					<p>If you wish to cancel editing a meta box without saving any changes, simply click the "Go Back" link at the top of the screen. You will be redirected to the main meta box screen without making any changes.</p>
				</div>
				
				<p id="metabox-fields" class="ecpt_title"><strong><?php _e('Adding / Editing Fields to Meta Box', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p><em>Adding Fields</em> - Every meta box can have its own unique fields. To add fields to a meta box, click "Edit Fields" towards the right side of the screen. You will now be taken to a screen displaying all the fields this meta box currently contains, if any. To add a new field, fill in the "Field Name" input, select the type of field you'd like to add, and click "Add Field". Your screen will refresh and you will see the new field in the list of fields. You may add as many fields as you'd like.</p>
					
					<p>If you choose either "Radio" or "Select" as your field type, a new "Options" input will become available. Put all of the available options you'd like your field to have here, each separated by a comma.</p>
					
					<p><em>Editing Fields</em> - If you wish to change the name, type, or options of a field, simply click the "Edit" link towards the right side of the screen. You will now be able to make any changes you wish. Once complete, click "Update" to save your changes, or click "Go Back" to cancel.</p>
					
					<p>If you wish to change the order of your fields (the order they are displayed on your screen here is the order they will be displayed in the meta box), you may simply drag and drop your fields into the desireable order using the cross hair icon.</p>
					
					<p><em>Deleting Fields</em> - To delete a field, click the "Delete" link towards the right of the screen for the field you wish to remove. The field will disappear. There is no need to refresh.</p>
				</div>
				
				<p id="field-types" class="ecpt_title"><strong><?php _e('Field Types', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>There are six available field types to choose from:
						<ol>
							<li><em>text</em> - a plain, single line text input</li>
							<li><em>textarea</em> - a large, multiline text input with formatting controls</li>
							<li><em>select</em> - a drop down options menu</li>
							<li><em>checkbox</em> - a single true / false checkbox</li>
							<li><em>radio</em> - a group of radio options</li>
							<li><em>date</em> - a plain, single line text input with drop down date picker</li>
							<li><em>upload</em> - a plain, single line text input with an upload button that allows you to insert an image or file url through the WordPress media uploader</li>
							<li><em>slider</em> - a jQuery UI slider that you can use to adjust the numerical value of a field with a nice draggable slider</li>
							<li><em>repeatable</em> - a single line text input that can be repeated an unlimited number of times. Great for lists.</li>
							<li><em>repeatable upload</em> - a file upload that can be repeated an unlimited number of times. Great for file or image lists.</li>
						</ol>
						<strong>NOTE: If your metabox contains a textarea, you should NOT give it a "side" context due to space constraints.</strong>
				</div>
				<p id="field-info" class="ecpt_title"><strong><?php _e('Displaying Field Info in Your template', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>By default, WordPress will never automatically display any of the data entered into custom meta boxes. For that reason, I have provided several easy ways for your to display the information yourself.</p>
				
					<p><em>Automatically Displaying Meta Field Info</em></p>
				
					<p>Since v2.3, ECPT now has a function that will allow you to automatically display values for all meta fields created with ECPT. In the Settings page, there is now a series of options for each custom post type you have created. These options will allow you to set all meta fields attached to a post type to be automatically displayed in an unordered list at the bottom of the post content.</p>
					
					<p>This automatic setting is still in development, so if you want more control, or if you simply want to do it yourself, while still displaying meta fields automatically, you can use the <em>ecpt_display_meta()</em> template tag anywhere in your single.php (or single-{post-type}.php or page.php) file.</p>
					
					<p>The complete function looks like this:</p>
					<pre>ecpt_display_meta($metabox, $type = 'all', $descriptions = true, $images = true, $dateformat = 'F j, Y', $blank = false, $repeatable_images = false)</pre>
					<ul>
						<li>$metabox - this is the ID of the meta box. This value can be found in the ID column on the meta box list page</li>
						<li>$type - this is the type of field you wish to display. Use "all" to display all fields. You can also pass an array of field types like this: <br/><pre>array('text', 'textarea', 'upload')</pre></li>
						<li>$descriptions - true/false - this determies whether field descriptions are shown after the field title</li>
						<li>$images - true/false - if set to true, any upload field that contains an image url will automatically render the image in an IMG tag, instead of simply the file url</li>
						<li>$dateFormat - this is the format in which to display date stamps from date fields. Refer to <a href="http://codex.wordpress.org/Formatting_Date_and_Time">this article</a> for information on the different format options</li>
						<li>$blank - this determines whether links open in new windows or in the same. Set to true to open in new windows.</li>
						<li>$repeatable_images - this determines whether images in repeatable upload fields should be rendered, or left as file URLs</li>
					</ul>
					
					<p>So, to use this function in your theme's template files, you can do this:
					
					<pre>&lt;?php echo ecpt_display_meta('metaboxname'); ?&gt;</pre>
					
					This will display the meta with all of the default options. If you want to alter the way the meta is displayed, you might use:
					
					<pre>&lt;?php echo ecpt_display_meta('metaboxname', array('text', 'upload', 'date'), false, true); ?&gt;</pre>
					
					This would display all TEXT, UPLOAD, and DATE fields from the "metaboxname" meta box; it would not show any field descriptions, and it would render images.
					</p>
					
					<p>You may also display the values from individual fields by using the methods described below.</p>
					
					<p><em>Using Shortcodes</em>:</p>
					
					<p>The information from any and all fields can be displayed in a post or page using a shortcode, like this:
						<pre>[ecpt_field id="fieldname"]</pre><br/>
					So, if your field name was "contact", you'd use:<br/>
						<pre>[ecpt_field id="contact"]</pre><br/>
					</p>
					
					<p>With version 1.3+, there are also two additional parameters for shortcodes:
						<ol>
						<li><em>image</em> - This allows you to choose whether to display the image (for upload and repeatable upload fields only), or to simply return the url of the image. By setting <em>image=true</em>, WordPress will display the image.<br/>Default: false</li>
						<li><em>url</em> - This allows you to set a clickable url for the content of the field, either image or text. To define a url, use <em>url="http://yoursite.com"</em></li>
						<li><strong>Note</strong>: as of v2.3.7, URLs are automatically rendered, so the URL parameter has been removed.</li>
						</ol>
						So, for example, to display an image and make it clickable, your shortcode format will look like this:<br/>
						<pre>[ecpt_field id="image" url="http://google.com" image=true]</pre>
					</p>
					
					<p><em>Using Template Tags</em>:</p>
					
					<p>You can also display the information in your theme's template files using template tags, like this:
					
					<pre>echo get_post_meta($post->ID, 'ecpt_fieldname', true);</pre><br/>
					
					<em>fieldname</em> is replaced with the name of your field. So, if your field is named "Contact", you would use:
					<pre>echo get_post_meta($post->ID, 'ecpt_contact', true);</pre><br/></p>
			
					<p><em>Note</em>, names with more than one word or uppercased are automatically converted to single words and lowercased. For example, <em>Test Field</em> becomes <em>testfield</em></p>
					
					<p><em>Note about date fields</em>; as of Easy Content Types v2.3.9 and later, all date fields are stored as unix timestamps. This means that if you want to display a nicely formatted date stored in a date field, you have to first convert the timestamp to a human readable time. Here is an example::</p>
					
					<pre>$date = get_post_meta($post->ID, 'ecpt_datefield', true);<br/>echo date('F j, Y', $date);</pre></p>
					<p>This example will output the date in this format: January 17, 2012</p>
					
				</div>
			<h3 id="access"><?php _e('User Access', 'ecpt'); ?></h3>
				<p id="user-access" class="ecpt_title"><strong><?php _e('User Level Access', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>
						Inside of the "Settings" page, from the main "Content Types" menu, you may control what user levels have access to the functions provided by this plugin.
					</p>
					
					<p>There are three different user levels:
						<ol>
							<li>Admin</li>
							<li>Editor</li>
							<li>Author</li>
						</ol>
						These user levels correspond to the default user roles assigned to registered WordPress users.</p>
						
					<p>By adjusting the user levels, you can control which user levels have the ability to:
						<ul>
							<li>Access any menu of the plugin</li>
							<li>Create custom Post Types</li>
							<li>Create custom Taxonomies</li>
							<li>Create custom Meta Boxes</li>
						</ul>
					</p>
					<p><em>Note:</em> - The user level given to the custom content menu is considered the "master" user level. Only users that have the same user level as set for the custom content menu will be able to access any of the lower menus.</p>
				</div>
		</div><!--end ecpt-wrap-->
	<div><!--end wrap-->
	<?php

}

?>