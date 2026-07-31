# Disable All Comments

Completely disable all comment features in WordPress, including REST API, XML-RPC, and feeds.

## Description

**Disable All Comments** is a lightweight, high-performance WordPress plugin that completely disables all standard comment features across your website. It is designed to save server resources, reduce spam, and simplify the admin interface for websites that do not require comment functionalities (such as corporate portfolios, landing pages, or blogs using third-party comment systems).

### Key Features
- **Disable Comment Support:** Removes comment and trackback support from all post types (posts, pages, and custom post types).
- **Hide Existing Comments:** Hides existing comments from rendering on front-end templates without modifying database records.
- **Direct Access Protection:** Blocks direct HTTP POST requests to `wp-comments-post.php` with a `403 Forbidden` response.
- **API & XML-RPC Disabling:** Removes comment-related endpoints from the WordPress REST API (`/wp/v2/comments`) and disables comment XML-RPC methods (e.g., `wp.newComment`).
- **Feeds & Pingbacks Cleanup:** Redirects comment RSS feeds to the homepage and removes pingback HTTP headers (`X-Pingback`) and links.
- **Clean Admin UI:** Removes the Comments menu, admin bar node, dashboard widget, and comments table columns.

## Installation

1. Upload the `disable-all-comments` folder to your `/wp-content/plugins/` directory, or install directly through the WordPress admin panel.
2. Activate the plugin through the **Plugins** menu.
3. Upon activation, all comment functionalities will be instantly disabled globally.

## Frequently Asked Questions

### Will this plugin delete my existing comments from the database?
No. This plugin only disables and hides comment features. It does not modify or delete any comment data from your database.

### Will comments function again if I deactivate the plugin?
Yes. Deactivating the plugin restores all WordPress default comment behaviors.

## Related Project

This plugin is one of the six origin projects of [Omni Webmaster & SEO Suite](https://github.com/ivanusto/omni-webmaster-seo-suite) — an all-in-one webmaster toolkit that consolidates and optimizes the author's standalone plugins, adding Meta Pixel tracking and monthly post data export on top.

## License / 授權條款

This project is licensed under the [GNU General Public License v2.0 or later (GPL-2.0-or-later)](LICENSE).