<?php

/*
 * Tell WordPress to run demotheme_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'demotheme_setup' );

function demotheme_setup() {
    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // Load regular editor styles into the new block-based editor.
    add_theme_support( 'editor-styles' );
        
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( [
        'primary' =>  __( 'Primary Menu', 'demotheme' ),
        'footer' =>  __( 'Footer Menu', 'demotheme' ) 
    ]);

    // Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );
    
    // Add css/js
    add_action( 'wp_enqueue_scripts', 'demotheme_resources' );
    // Change default excerpt length
    add_filter('excerpt_length', 'custom_excerpt_lenght');
    
    // Featured image support
    add_theme_support('post-thumbnails');
    add_image_size('small-thumbnail', 180, 120, true);
    add_image_size('tiny-thumbnail', 90, 60, true);
    add_image_size('banner-image', 920, 210, true);
    
    // Add tag metabox to page
    register_taxonomy_for_object_type('post_tag', 'page'); 
    // Add category metabox to page
    register_taxonomy_for_object_type('category', 'page');  
}

// Enqueue css/js
function demotheme_resources() {
    wp_enqueue_style('style', get_stylesheet_uri());
}

function demotheme_settings() {  
    // Add tag metabox to page
    register_taxonomy_for_object_type('post_tag', 'page'); 
    // Add category metabox to page
    register_taxonomy_for_object_type('category', 'page'); 
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'init', 'demotheme_settings' );

// Get post parent Id
function getTopParentId() {
    global $post;
    if ($post->post_parent) {
        $ansestors = array_reverse(get_post_ancestors($post->ID));
        return $ansestors[0];
    }
    return $post->ID;
}

// Check if a post has children
function has_children() {
    global $post;
    return count(get_pages('child_of='. $post->ID));
}

// Provide custom excerpt length value.
function custom_excerpt_lenght() {
    return 25;
}

// Register sidebars
function demotheme_widgets_init(){
    register_sidebar([
        'name' => 'Sidebar',
        'id' => 'sidebar1',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-heading">',
        'after_title' => '</h4>'
    ]);

    register_sidebar([
        'name' => 'Footer 1',
        'id' => 'footer1',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>'
    ]);

    register_sidebar([
        'name' => 'Footer 2',
        'id' => 'footer2',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>'
    ]);

    register_sidebar([
        'name' => 'Footer 3',
        'id' => 'footer3',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>'
    ]);

    register_sidebar([
        'name' => 'Footer 4',
        'id' => 'footer4',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>'
    ]);
}

// Init Widget.
add_action('widgets_init', 'demotheme_widgets_init');

// Customize Appearance options.
function demotheme_customize_register($wp_customize) {
    $wp_customize->add_setting('dt_link_color', [
        'default' => '#006ec3',
        'transport' => 'refresh'
    ]);

    $wp_customize->add_setting('dt_button_color', [
        'default' => '#006ec3',
        'transport' => 'refresh'
    ]);

    $wp_customize->add_section('dt_standard_colors', [
        'title' => __('Standard Colors', 'demotheme'),
        'priority' => 30
    ]);

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'dt_link_color_control', 
            [
                'label' => __('Link Color', 'demotheme'),
                'section' => 'dt_standard_colors',
                'settings' => 'dt_link_color'
            ]
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize, 'dt_button_color_control', 
            [
                'label' => __('Button Color', 'demotheme'),
                'section' => 'dt_standard_colors',
                'settings' => 'dt_button_color'
            ]
        )
    );
}   
add_action('customize_register', 'demotheme_customize_register');

// Output customize css
function demotheme_customize_css() { ?>
    <style type="text/css">
        a:link,
        a:visited
        {
            color: <?php echo get_theme_mod('dt_link_color'); ?>;
        }
        .site-header nav.site-nav ul li.current-menu-item  a:link,
        .site-header nav.site-nav ul li.current-menu-item  a:visited,
        .site-header nav.site-nav ul li.current-page-ancestor a:link,
        .site-header nav.site-nav ul li.current-page-ancestor a:visited {
            background-color: <?php echo get_theme_mod('dt_link_color'); ?>;
        }
        div.hd-search #searchsubmit, 
        .footer-widget-area  #searchform #searchsubmit,
        .posts-button:link,
        .posts-button:visited {
            background-color: <?php echo get_theme_mod('dt_button_color'); ?>;
        }
    </style>
<?php } add_action('wp_head', 'demotheme_customize_css'); 

// Footer callout
function demotheme_footer_callout($wp_customize) {
    // Add section.
    $wp_customize->add_section('dt_footer_callout', [
        'title' => __('Footer Callout', 'demotheme'),
        'priority' => 40
    ]);

    // Add settings
    $wp_customize->add_setting('dt_footer_callout_headline', [
        'default' => 'Example Headline',
        'transport' => 'refresh'
    ]);
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'dt_footer_callout_headline_control', 
            [
                'label' => __('Headline', 'demotheme'),
                'section' => 'dt_footer_callout',
                'settings' => 'dt_footer_callout_headline'
            ]
        )
    );

    $wp_customize->add_setting('dt_footer_callout_text', [
        'default' => 'Example text',
        'transport' => 'refresh'
    ]);
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'dt_footer_callout_text_control', 
            [
                'label' => __('Text', 'demotheme'),
                'section' => 'dt_footer_callout',
                'settings' => 'dt_footer_callout_text',
                'type' => 'textarea'
            ]
        )
    );

    $wp_customize->add_setting('dt_footer_callout_link');
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'dt_footer_callout_link_control', 
            [
                'label' => __('Link', 'demotheme'),
                'section' => 'dt_footer_callout',
                'settings' => 'dt_footer_callout_link',
                'type' => 'dropdown-pages'
            ]
        )
    );

    $wp_customize->add_setting('dt_footer_callout_image');
    $wp_customize->add_control(
        new WP_Customize_Cropped_Image_Control(
            $wp_customize, 'dt_footer_callout_image_control', 
            [
                'label' => __('Image', 'demotheme'),
                'section' => 'dt_footer_callout',
                'settings' => 'dt_footer_callout_image',
                'width' => 750,
                'height' => 750
            ]
        )
    );

    $wp_customize->add_setting('dt_footer_callout_display',[
        'default' => 'No'
    ]);
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'dt_footer_callout_display_control', 
            [
                'label' => __('Disply this section?', 'demotheme'),
                'section' => 'dt_footer_callout',
                'settings' => 'dt_footer_callout_display',
                'type' => 'select',
                'choices' => [
                    'No' => 'No',
                    'Yes' => 'Yes'
                ]
            ]
        )
    );
}
add_action('customize_register', 'demotheme_footer_callout');

// Custom post type
function  demotheme_custom_post_type() {
    $labels = [
        'name' => 'Portfolio',
        'singular_name' => 'Portfolio',
        'add_new_item' => 'New Portfolio',
        'add_new' => 'New Portfolio',
        'all_items' => 'Portfolios',
        'edit_item' => 'Edit Portfolio',
        'new_item' => 'New Portfolio',
        'view_item' => 'View Portfolio',
        'search_item' => 'Search Portfolio',
        'not_found' => 'No items found',
        'not_found_in_trash' => 'No items found in trash',
        'parent_item_colon' => 'Parent item'
    ];

    $args = [
        'labels' => $labels,
        'public' => TRUE,
        'has_archive' => TRUE,
        'publicly_queryable' => TRUE,
        'query_var' => TRUE,
        'rewrite' => TRUE,
        'capability_type' => 'post',
        'hierarchical' =>  FALSE,
        'show_in_rest' => TRUE,
        'supports' => [
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revision'
        ],
        'taxonomies' => [
            'category',
            'post_tag'
        ],
        'menu_position' => 5,
        'exclude_from_search' => FALSE
    ];
    register_post_type('portfolio', $args);
}
add_action('init', 'demotheme_custom_post_type');

?>