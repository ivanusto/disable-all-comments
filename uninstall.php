<?php
/**
 * Disable All Comments Uninstall
 *
 * @package Disable_All_Comments
 */

// If uninstall not called from WordPress, exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete options
delete_option('disable_all_comments_activated');
