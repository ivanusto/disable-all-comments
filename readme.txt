=== Disable All Comments ===
Contributors: ivanlin
Tags: comments, disable comments, remove comments, spam, security
Requires at least: 4.7
Tested up to: 7.0
Requires PHP: 7.0
Stable tag: 1.1.0
License: Apache-2.0
License URI: https://www.apache.org/licenses/LICENSE-2.0
Donate link: https://yblog.org

Completely disable all comment features in WordPress, including REST API, XML-RPC, and feeds.

== Description ==

"Disable All Comments" is a lightweight and high-performance WordPress plugin that completely disables all standard comment features across your website.

Key Features:

* Disable comment and trackback support from all post types (posts, pages, and custom post types).
* Hide existing comments from rendering on frontend templates.
* Block direct HTTP POST requests to wp-comments-post.php (returns 403 Forbidden).
* Remove comment endpoints from WordPress REST API (/wp/v2/comments).
* Disable comment-related XML-RPC methods (like wp.newComment).
* Redirect comment RSS feeds to homepage and remove Pingback headers and links.
* Clean up the admin dashboard (hide Comments menu, admin bar node, widget, and columns).

This plugin is perfect for:

* Corporate or portfolio websites that do not require comment functionalities.
* Blogs using third-party comment systems (such as Facebook Comments or Disqus).
* Webmasters looking to eliminate comment spam and improve server performance.

This plugin is one of the origin projects of Omni Webmaster & SEO Suite, an all-in-one webmaster toolkit by the same author that consolidates and optimizes these standalone plugins: https://github.com/ivanusto/omni-webmaster-seo-suite

== Installation ==

1. Upload the 'disable-all-comments' folder to the '/wp-content/plugins/' directory, or install directly through the WordPress admin panel.
2. Activate the plugin through the 'Plugins' menu.
3. Upon activation, all comment functionalities will be instantly disabled globally.

== Frequently Asked Questions ==

= Will this plugin delete my existing comments from the database? =

No. This plugin only disables and hides comment features. It does not modify or delete any comment data from your database.

= Will comments function again if I deactivate the plugin? =

Yes. Deactivating the plugin restores all WordPress default comment behaviors.

= Is this plugin compatible with other plugins? =

Yes, this plugin is compatible with most WordPress themes and plugins.

== Changelog ==

= 1.1.0 =
* New: Complete block of direct POST requests to wp-comments-post.php
* New: Disable REST API comment endpoints and XML-RPC comment methods
* New: Remove Pingback headers/links and redirect comment feeds
* Optimize: Cleaned up activation/uninstall hooks using a standard uninstall.php
* Optimize: Code refactoring and localization formatting (En/Zh-TW)

= 1.0.0 =
* Initial release
