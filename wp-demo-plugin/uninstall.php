<?php

/**
 * Triggered on uninstall
 * */

defined('WP_UNINSTALL_PLUGIN') or die('You cant access this file.');

// Access db
global $wpdb;

// Clear ppsts data.
/* $books = get_posts([
    'post_type' => 'book',
    'numberposts' => -1
]);

foreach($books as $book) {
    wp_delete_post($book->ID, true);
}
*/

$wpdb->query("DELETE FROM wp_posts WHERE post_type='book'");
$wpdb->query("DELETE FROM wp_postsmeta WHERE post_id NOT IN(SELECT id from wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN(SELECT id from wp_posts)");
