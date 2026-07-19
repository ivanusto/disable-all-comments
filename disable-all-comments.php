<?php
/**
 * Plugin Name: Disable All Comments
 * Plugin URI: https://yblog.org
 * Description: Completely disable all comment features in WordPress, including REST API, XML-RPC, and feeds. / 完全禁用 WordPress 網站的所有留言功能，包括 REST API、XML-RPC 與 RSS Feed。
 * Version: 1.1.0
 * Author: Ivan Lin
 * Author URI: https://yblog.org
 * License: Apache-2.0
 * License URI: https://www.apache.org/licenses/LICENSE-2.0
 * Text Domain: disable-all-comments
 * Domain Path: /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Disable_All_Comments {
    
    /**
     * Constructor
     */
    public function __construct() {
        // Disable comments support on init
        add_action('init', array($this, 'disable_comments_support'));
        
        // Close comments and pings
        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);
        
        // Hide existing comments
        add_filter('comments_array', '__return_empty_array', 10, 2);
        
        // Remove admin elements
        add_action('admin_menu', array($this, 'remove_comments_menu'));
        add_action('admin_bar_menu', array($this, 'remove_comments_admin_bar'), 999);
        add_action('wp_dashboard_setup', array($this, 'remove_comments_dashboard_widget'));
        
        // Add settings page
        add_action('admin_menu', array($this, 'add_settings_page'));
        
        // Block comment post requests
        add_action('init', array($this, 'block_comments_post'));

        // Redirect comment feeds
        add_action('template_redirect', array($this, 'redirect_comment_feeds'));

        // Disable REST API comment endpoints
        add_filter('rest_endpoints', array($this, 'disable_comments_rest_endpoints'));

        // Disable XML-RPC comment methods
        add_filter('xmlrpc_comments_methods', array($this, 'disable_xmlrpc_comments'));

        // Remove pingback headers
        add_filter('wp_headers', array($this, 'filter_wp_headers'));
        add_filter('bloginfo_url', array($this, 'disable_pingback_url'), 10, 2);

        // Remove comments column from admin tables
        add_filter('manage_posts_columns', array($this, 'remove_comments_column'));
        add_filter('manage_pages_columns', array($this, 'remove_comments_column'));
        
        // Hook into custom post types columns
        add_action('admin_init', array($this, 'remove_comments_column_cpt'));

        // Hooks for activation/deactivation
        register_activation_hook(__FILE__, array($this, 'plugin_activation'));
        register_deactivation_hook(__FILE__, array($this, 'plugin_deactivation'));
    }

    /**
     * Disable comment support for all post types
     */
    public function disable_comments_support() {
        $post_types = get_post_types();
        foreach ($post_types as $post_type) {
            if (post_type_supports($post_type, 'comments')) {
                remove_post_type_support($post_type, 'comments');
                remove_post_type_support($post_type, 'trackbacks');
            }
        }
    }
    
    /**
     * Remove comments from admin menu
     */
    public function remove_comments_menu() {
        remove_menu_page('edit-comments.php');
    }
    
    /**
     * Remove comments from admin bar
     */
    public function remove_comments_admin_bar($wp_admin_bar) {
        $wp_admin_bar->remove_node('comments');
    }
    
    /**
     * Remove comments widget from dashboard
     */
    public function remove_comments_dashboard_widget() {
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    }
    
    /**
     * Remove comments column from posts and pages
     */
    public function remove_comments_column($columns) {
        if (isset($columns['comments'])) {
            unset($columns['comments']);
        }
        return $columns;
    }

    /**
     * Remove comments column from custom post types
     */
    public function remove_comments_column_cpt() {
        $post_types = get_post_types(array('public' => true), 'names');
        foreach ($post_types as $post_type) {
            add_filter("manage_edit-{$post_type}_columns", array($this, 'remove_comments_column'));
        }
    }
    
    /**
     * Block direct access to wp-comments-post.php
     */
    public function block_comments_post() {
        global $pagenow;
        $request_uri = isset($_SERVER['REQUEST_URI']) ? esc_url_raw(wp_unslash($_SERVER['REQUEST_URI'])) : '';
        if ($pagenow === 'wp-comments-post.php' || strpos($request_uri, 'wp-comments-post.php') !== false) {
            wp_die(
                esc_html__('Comments are closed on this site.', 'disable-all-comments'),
                esc_html__('Comments Disabled', 'disable-all-comments'),
                array('response' => 403)
            );
        }
    }

    /**
     * Redirect comment feeds to homepage
     */
    public function redirect_comment_feeds() {
        if (is_comment_feed()) {
            wp_safe_redirect(home_url('/'), 301);
            exit;
        }
    }

    /**
     * Disable REST API endpoints for comments
     */
    public function disable_comments_rest_endpoints($endpoints) {
        $comment_endpoints = array(
            '/wp/v2/comments',
            '/wp/v2/comments/(?P<id>[\d]+)'
        );
        foreach ($comment_endpoints as $endpoint) {
            if (isset($endpoints[$endpoint])) {
                unset($endpoints[$endpoint]);
            }
        }
        return $endpoints;
    }

    /**
     * Disable comment XML-RPC methods
     */
    public function disable_xmlrpc_comments($methods) {
        $comment_methods = array(
            'wp.newComment',
            'wp.getComment',
            'wp.getComments',
            'wp.getCommentStatusList',
            'wp.getCommentCount',
            'wp.editComment',
            'wp.deleteComment'
        );
        foreach ($comment_methods as $method) {
            if (isset($methods[$method])) {
                unset($methods[$method]);
            }
        }
        return $methods;
    }

    /**
     * Filter out X-Pingback headers
     */
    public function filter_wp_headers($headers) {
        if (isset($headers['X-Pingback'])) {
            unset($headers['X-Pingback']);
        }
        return $headers;
    }

    /**
     * Disable pingback url
     */
    public function disable_pingback_url($output, $show) {
        if ($show === 'pingback_url') {
            return '';
        }
        return $output;
    }
    
    /**
     * Add Settings Page
     */
    public function add_settings_page() {
        add_options_page(
            __('Comments Settings', 'disable-all-comments'),
            __('Disable Comments', 'disable-all-comments'),
            'manage_options',
            'disable-all-comments',
            array($this, 'render_settings_page')
        );
    }
    
    /**
     * Render Settings Page
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Disable Comments Settings', 'disable-all-comments'); ?></h1>
            <div class="notice notice-success">
                <p><?php esc_html_e('All comment features have been successfully disabled.', 'disable-all-comments'); ?></p>
            </div>
            <div class="card" style="max-width: 800px; margin-top: 20px;">
                <h2><?php esc_html_e('Active Enforcements', 'disable-all-comments'); ?></h2>
                <p><?php esc_html_e('This plugin enforces the following settings globally:', 'disable-all-comments'); ?></p>
                <ul style="list-style-type: disc; margin-left: 20px; line-height: 1.6;">
                    <li><strong><?php esc_html_e('Comment Support:', 'disable-all-comments'); ?></strong> <?php esc_html_e('Disabled for all post types (posts, pages, and custom post types).', 'disable-all-comments'); ?></li>
                    <li><strong><?php esc_html_e('Existing Comments:', 'disable-all-comments'); ?></strong> <?php esc_html_e('Hidden from displaying on front-end templates.', 'disable-all-comments'); ?></li>
                    <li><strong><?php esc_html_e('Spam Prevention:', 'disable-all-comments'); ?></strong> <?php esc_html_e('Direct HTTP POST requests to wp-comments-post.php are blocked (403 Forbidden).', 'disable-all-comments'); ?></li>
                    <li><strong><?php esc_html_e('API Access:', 'disable-all-comments'); ?></strong> <?php esc_html_e('Comment endpoints are removed from WordPress REST API and comment XML-RPC methods are disabled.', 'disable-all-comments'); ?></li>
                    <li><strong><?php esc_html_e('Feeds & Pingbacks:', 'disable-all-comments'); ?></strong> <?php esc_html_e('Comment RSS feeds are redirected to homepage. Pingback headers and links are removed.', 'disable-all-comments'); ?></li>
                    <li><strong><?php esc_html_e('Dashboard Clean-up:', 'disable-all-comments'); ?></strong> <?php esc_html_e('Comments menu, admin bar node, recent comments widget, and comments table columns are hidden.', 'disable-all-comments'); ?></li>
                </ul>
            </div>
        </div>
        <?php
    }
    
    /**
     * Plugin activation hook
     */
    public function plugin_activation() {
        add_option('disable_all_comments_activated', true);
    }
    
    /**
     * Plugin deactivation hook
     */
    public function plugin_deactivation() {
        delete_option('disable_all_comments_activated');
    }
}

// Initialize the plugin.
new Disable_All_Comments();
