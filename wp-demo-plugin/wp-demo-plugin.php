<?php

/*
 * Plugin Name: Demo Plugin
 * Description: Wordpress custom plugin demonstartion.
 * Plugin URI: https://github.com/malaynayak/wordpress-custom-theme
 * Author: Malay Nayak
 * Author URI: https://github.com/malaynayak
 */

if (!defined('ABSPATH')) {
    die('Access forbidden.');
}

require_once plugin_dir_path(__FILE__).'Demo_Widget.php';

/* Register and load the widget */
function demo_load_widget() {
    register_widget('demo_Widget');
}
add_action('widgets_init', 'demo_load_widget');

/* Register Short Codes */
add_action('init', 'demo_register_shortcodes');

function demo_register_shortcodes() {
    add_shortcode('demo_form', 'demo_form_shortcode');
}

function demo_form_shortcode( $args, $content="" ) {
    $output = '
        <div class="slb">
            <form id="slb_form" class="slb-form" method="POST">
                <p class="slb-input-container">
                    <label>Your Name</label></br>
                    <input type="text" name="slb_fname" placeholder="First Name" />
                    <input type="text" name="slb_lname" placeholder="Last Name" />
                 </p>
                 <p class="slb-input-container">
                    <label>Email</label></br>
                    <input type="email" name="slb_email" placeholder="Email" />
                 </p>';
    if (strlen($content)) {
        $output .= '<div class="slb-content">'. wpautop($content) .'</div>';
    }
    $output .= '<p class="slb-input-container">
                    <input type="submit" name="slb_submit" value="Sign Up" />
                 </p>
            </form>
        </div>
    ';
    return $output;
}

/* Add custom taxonomy */
add_action( 'init', 'add_custom_taxonomies', 0 );

function add_custom_taxonomies() {
    // Add new "Locations" taxonomy to Posts
    register_taxonomy(
		'location',
		'post',
		array(
			'hierarchical'          => true,
			'query_var'             => 'location_name',
			'rewrite' => array(
                'slug' => 'locations', // This controls the base slug that will display before each term
                'with_front' => false, // Don't display the location base before "/locations/"
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
            ),
			'public'                => true,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'_builtin'              => true,
            'labels' => array(
                'name' => _x( 'Locations', 'taxonomy general name' ),
                'singular_name' => _x( 'Location', 'taxonomy singular name' ),
                'search_items' =>  __( 'Search Locations' ),
                'all_items' => __( 'All Locations' ),
                'parent_item' => __( 'Parent Location' ),
                'parent_item_colon' => __( 'Parent Location:' ),
                'edit_item' => __( 'Edit Location' ),
                'update_item' => __( 'Update Location' ),
                'add_new_item' => __( 'Add New Location' ),
                'new_item_name' => __( 'New Location Name' ),
                'menu_name' => __( 'Locations' ),
            ),
			'show_in_rest'          => true,
			'rest_base'             => 'locations',
		)
	);
}