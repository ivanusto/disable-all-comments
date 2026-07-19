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

## License

This project is licensed under the Apache License 2.0. See the [LICENSE](LICENSE) file for details.
