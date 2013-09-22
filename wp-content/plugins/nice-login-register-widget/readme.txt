=== Nice Login Widget ===
Contributors: sgPlanwize
Donate link: 
Tags: nice, widget, login, register, password, log-in, logout, log-out, user, ajax, authentication
Requires at least: 3.0.0
Tested up to: 3.5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add, build and manage login-register widget anywhere in your site.

== Description ==

An elegant login and register widget that can be placed in any widget area on your site.

* Add login/register widget in any widget area in your site.
* Uses only one area and screen to login, register, and retrieve forgotten passwords.
* Cleanly transitions by flipping between login, register, and forgotten password screens on command.
* Can appear horizontally or vertically.
* Ajax enabled authentication, allowing the whole process to take place on a single page instead of linking to the WordPress login page. 
* SSL compatible to keep your website secure.


= Translation =

* France (fr_FR) - [GabLeRoux](http://wordpress.org/support/profile/gableroux).


If you have created your own language translation, or have an update of an existing one, you can send [gettext PO and MO](http://codex.wordpress.org/Translating_WordPress) files to `info@superplug.in` so I can bundle it into next versions.


= Author Background =

This plugin is brought to you by the [SuperPlugin team](http://superplug.in/team).

We at SuperPlugin make our experience crafting WordPress sites for clients available to you - creating both free and premium plugins embodying the lessons we learned and the problems we've solved.

Visit [our site](http://superplug.in/?utm_source=nice_login_widget__wp.org_links&utm_medium=link&utm_campaign=Nice+Login+Widget) to learn more about us and our revolutionary new widget management plugin: [Power Widgets](http://superplug.in/power-widgets/product-tour?utm_source=nice_login_widget__wp.org_links&utm_medium=link&utm_campaign=Nice+Login+Widget)

== Installation ==

1. Upload `pw-login-widget.zip` to the `/wp-content/plugins/` directory.
2. Activate the plugin through `Plugins` menu.
3. Go to `Appearance->Widgets` ,in available widgets you will find `Nice Login/Regiter` widget, drag it to chosen widget area where you want it to appear.
4. Now visit your blog and you will see the login/register section.

== Frequently Asked Questions ==

= Can I change the float to either vertical or horizontal ? =

Yes you can. Go to widget options in the widgets area and the float can be adjusted to either horizontal or vertical.

= Can I choose which authentication control should take effect? =

Yes, simply switch the radio button between ajax authentication and WP regular authentication in the backend widget options.

= Can I get rid of the border or change it's color? =

Yes, you can change the border's color or get rid of it entirely in the backend widget options.

= How do I use the shortcode to insert the login widget in posts and pages? =

In order to enable the shortcode, you will have to go to the Widget menu under Appearances, then drag and drop the nice login widget into the custom widget area entitled Nice Login Widget Shortcode. Once in this is completed, you will be able to insert this widget area by using the [sp_login_shortcode] shortcode.

= Why can't I see the "don�t have an account?" link? =
In order to see this link you have to enable the "Anyone can register" option. This option is  found in Settings under the General section. 

= Will this work with my other plugins, such as "Limit Login Attempts" =
Our widget should be compatible with most other plugins associated with logging in. For example Limit Login Attempts. However, if you find that a plugin you use is not compatible, please let us know via a support request.

== Screenshots ==

1. Horizontal float.
2. Vertical float.
3. Back-end widget control.
4. Logged-In.
5. Ajax authentication in action.
6. Get the whole errors and messages in one place.
7. Get the whole errors and messages in one place.

== Changelog ==

= 1.1.1 =
* First version released.

= 1.2 =
* Fixed multisite bug issues.
* Fixed lost password bug issue.
* jQuery Feature has been added to the administrator widget control.
* Fixed bug when your blog is on "Anyone can register" unchecked and the "Don't have an account" link shows up. Now this link shows up properly. 

= 1.3 =
* JQuery capabilities performance improved.
* Fixed an jQuery issue that occurred when adding multiple login widgets in single documet.
* Ajax enabled authentication, allowing the whole process to take place on a single page instead of linking to the WordPress login page. 
* Added the option to turn the Widget Border on or off, or to change its color.
* Added shortcode capability, allowing the widget to placed within any page or post content.
* Enabled SSL communication to improve security.

== Upgrade Notice ==

= 1.1.1 =
First version released.

= 1.2 =

Now you can use the plugin on multisites.


Control the logged-in message with merge tags through widget options.

= 1.3 =

Ajax support added, allowing all actions to take place on the widget without moving to the WordPress login page.
Many bugs fixed and general capabilities was added.


