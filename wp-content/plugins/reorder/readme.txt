=== Reorder ===
Contributors: Ben Kennedy
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=benjitastic%40gmail%2ecom&lc=US&item_name=Ben%20Kennedy%20%2d%20Reorder%20Wordpress%20Plugin&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest
Tags: reorder, order, orderby, posts, custom posts, custom, post type, menu order, menu_order, drag, drop
Requires at least: 3.0
Tested up to: 3.0+
Stable tag: 3.0

Reorder enables Wordpress users and developers to easily reorder any Wordpress content by simply dragging and dropping. Supports hierarchical reordering of pages.

MUST HAVE VERSION 3.0 OF WORDPRESS

== Description ==

Enables simple drag and drop reordering of all post types.

== Installation ==

1. Upload the `reorder` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done

No extra configuration needs to be done when using the standard loop or query_posts() to reorder posts.

Note: 

To use get_posts() it is necessary to reverse the array. 

Instead of this code: get_posts();

Use this: array_reverse(get_posts('orderby=menu_order&order=DESC'));

Simply changing the order to ASC does not do the trick.

== Screenshots ==

== Changelog ==
= 1.0 =
* First public version
= 1.1 =
* fix conflict with postmash/pagemash plugins.
* enable "reorder" for standard "posts"
= 2.0 =
* major rewrite to allow for hierarchical reordering -- essentially a new plugin.
= 2.1 =
* fix issue of multiple menu_order values of 0. Sorts posts by menu_order and then date published.
* add fix for get_posts()

== Upgrade Notice ==
-