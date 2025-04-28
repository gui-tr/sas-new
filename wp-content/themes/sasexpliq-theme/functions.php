<?php
/**
 * Sasexpliq Theme functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Define theme constants
define( 'SASEXPLIQ_THEME_DIR', get_template_directory() );
define( 'SASEXPLIQ_THEME_URI', get_template_directory_uri() );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function sasexpliq_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );

    // Register navigation menus
    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary Menu', 'sasexpliq' ),
            'themes-menu' => esc_html__( 'Themes Menu', 'sasexpliq' ),
        )
    );

    // Switch default core markup to output valid HTML5
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom logo feature
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action( 'after_setup_theme', 'sasexpliq_setup' );

/**
 * Enqueue scripts and styles.
 */
function sasexpliq_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'sasexpliq-style', SASEXPLIQ_THEME_URI . '/assets/css/main.css', array(), '1.0.0' );
    
    // Enqueue responsive styles
    wp_enqueue_style( 'sasexpliq-responsive', SASEXPLIQ_THEME_URI . '/assets/css/responsive.css', array('sasexpliq-style'), '1.0.0' );
    
    // Enqueue footer styles
    wp_enqueue_style( 'sasexpliq-footer', SASEXPLIQ_THEME_URI . '/assets/css/footer.css', array('sasexpliq-style'), '1.0.0' );
    
    // Enqueue main JavaScript file
    wp_enqueue_script( 'sasexpliq-main', SASEXPLIQ_THEME_URI . '/assets/js/main.js', array('jquery'), '1.0.0', true );
    
    // Enqueue dark mode JavaScript
    wp_enqueue_script( 'sasexpliq-dark-mode', SASEXPLIQ_THEME_URI . '/assets/js/dark-mode.js', array(), '1.0.0', true );
    
    // Localize script for AJAX
    wp_localize_script( 'sasexpliq-main', 'sasexpliq_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'sasexpliq-nonce' ),
    ) );
    
    // Conditionally load the Qui sommes-nous CSS on the appropriate page
    if (is_page_template('page-qui-sommes-nous.php') || is_page('qui-sommes-nous')) {
        wp_enqueue_style('sasexpliq-qui-sommes-nous', SASEXPLIQ_THEME_URI . '/assets/css/qui-sommes-nous.css', array('sasexpliq-style'), '1.0.1');
    }

    // Load theme and article styles when viewing theme or article post types
    if (is_singular('theme') || is_singular('article')) {
        wp_enqueue_style('sasexpliq-theme-article', SASEXPLIQ_THEME_URI . '/assets/css/theme-article.css', array('sasexpliq-style'), '1.0.0');
    }

    // Conditionally load the À propos CSS on the appropriate page
    if (is_page_template('page-a-propos.php') || is_page('a-propos')) {
        wp_enqueue_style('sasexpliq-a-propos', SASEXPLIQ_THEME_URI . '/assets/css/a-propos.css', array('sasexpliq-style'), '1.0.0');
    }
}
add_action( 'wp_enqueue_scripts', 'sasexpliq_scripts' );

/**
 * Filter to ensure "Accueil" menu item links to homepage
 */
function sasexpliq_filter_nav_menu_items($items, $args) {
    // Only apply to primary menu
    if ($args->theme_location == 'primary') {
        foreach ($items as $item) {
            // Check if the menu item title is "Accueil"
            if ($item->title == 'Accueil') {
                // Set the URL to the homepage
                $item->url = home_url('/');
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'sasexpliq_filter_nav_menu_items', 10, 2);

/**
 * Register widget area.
 */
function sasexpliq_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'sasexpliq' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'sasexpliq' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'sasexpliq_widgets_init' );

/**
 * Create custom post type for Themes
 */
function sasexpliq_register_post_types() {
    $labels = array(
        'name'               => _x( 'Thèmes', 'post type general name', 'sasexpliq' ),
        'singular_name'      => _x( 'Thème', 'post type singular name', 'sasexpliq' ),
        'menu_name'          => _x( 'Thèmes', 'admin menu', 'sasexpliq' ),
        'name_admin_bar'     => _x( 'Thème', 'add new on admin bar', 'sasexpliq' ),
        'add_new'            => _x( 'Ajouter', 'theme', 'sasexpliq' ),
        'add_new_item'       => __( 'Ajouter un thème', 'sasexpliq' ),
        'new_item'           => __( 'Nouveau thème', 'sasexpliq' ),
        'edit_item'          => __( 'Modifier le thème', 'sasexpliq' ),
        'view_item'          => __( 'Voir le thème', 'sasexpliq' ),
        'all_items'          => __( 'Tous les thèmes', 'sasexpliq' ),
        'search_items'       => __( 'Rechercher des thèmes', 'sasexpliq' ),
        'not_found'          => __( 'Aucun thème trouvé.', 'sasexpliq' ),
        'not_found_in_trash' => __( 'Aucun thème trouvé dans la corbeille.', 'sasexpliq' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'theme' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-chat',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'theme', $args );
}
add_action( 'init', 'sasexpliq_register_post_types' );

/**
 * Add theme color taxonomy to themes
 */
function sasexpliq_register_taxonomies() {
    $labels = array(
        'name'              => _x( 'Couleurs de thème', 'taxonomy general name', 'sasexpliq' ),
        'singular_name'     => _x( 'Couleur de thème', 'taxonomy singular name', 'sasexpliq' ),
        'search_items'      => __( 'Rechercher les couleurs', 'sasexpliq' ),
        'all_items'         => __( 'Toutes les couleurs', 'sasexpliq' ),
        'edit_item'         => __( 'Modifier la couleur', 'sasexpliq' ),
        'update_item'       => __( 'Mettre à jour la couleur', 'sasexpliq' ),
        'add_new_item'      => __( 'Ajouter une nouvelle couleur', 'sasexpliq' ),
        'new_item_name'     => __( 'Nouvelle couleur', 'sasexpliq' ),
        'menu_name'         => __( 'Couleurs', 'sasexpliq' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'theme-color' ),
    );

    register_taxonomy( 'theme_color', array( 'theme' ), $args );
}
add_action( 'init', 'sasexpliq_register_taxonomies' );

/**
 * Contact form processing
 */
function sasexpliq_process_contact_form() {
    if ( !isset( $_POST['sasexpliq_contact_nonce'] ) || !wp_verify_nonce( $_POST['sasexpliq_contact_nonce'], 'sasexpliq_contact_form' ) ) {
        wp_die( 'Unauthorized access', 'Error', array( 'response' => 403 ) );
    }

    $name = sanitize_text_field( $_POST['name'] );
    $email = sanitize_email( $_POST['email'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    // Simple validation
    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
        exit;
    }

    // Email content
    $to = get_option( 'admin_email' );
    $subject = 'Nouveau message de contact de ' . $name;
    $body = "Nom: $name\n\nEmail: $email\n\nMessage:\n$message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    // Send email
    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_redirect( add_query_arg( 'contact', 'success', wp_get_referer() ) );
    } else {
        wp_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
    }
    exit;
}
add_action( 'admin_post_sasexpliq_contact_form', 'sasexpliq_process_contact_form' );
add_action( 'admin_post_nopriv_sasexpliq_contact_form', 'sasexpliq_process_contact_form' );


/**
 * Create custom post type for Articles
 * Add this code to your functions.php file
 */
function sasexpliq_register_article_post_type() {
    $labels = array(
        'name'               => _x( 'Articles', 'post type general name', 'sasexpliq' ),
        'singular_name'      => _x( 'Article', 'post type singular name', 'sasexpliq' ),
        'menu_name'          => _x( 'Articles', 'admin menu', 'sasexpliq' ),
        'name_admin_bar'     => _x( 'Article', 'add new on admin bar', 'sasexpliq' ),
        'add_new'            => _x( 'Ajouter', 'article', 'sasexpliq' ),
        'add_new_item'       => __( 'Ajouter un article', 'sasexpliq' ),
        'new_item'           => __( 'Nouvel article', 'sasexpliq' ),
        'edit_item'          => __( 'Modifier l\'article', 'sasexpliq' ),
        'view_item'          => __( 'Voir l\'article', 'sasexpliq' ),
        'all_items'          => __( 'Tous les articles', 'sasexpliq' ),
        'search_items'       => __( 'Rechercher des articles', 'sasexpliq' ),
        'not_found'          => __( 'Aucun article trouvé.', 'sasexpliq' ),
        'not_found_in_trash' => __( 'Aucun article trouvé dans la corbeille.', 'sasexpliq' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'article' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-media-text',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'article', $args );
}
add_action( 'init', 'sasexpliq_register_article_post_type' );

/**
 * Add articles to theme_color taxonomy
 */
function sasexpliq_update_theme_color_taxonomy() {
    // Get the existing 'theme_color' taxonomy and add it to the 'article' post type
    register_taxonomy_for_object_type( 'theme_color', 'article' );
}
add_action( 'init', 'sasexpliq_update_theme_color_taxonomy', 11 ); // Priority 11 to run after the taxonomy registration

/**
 * Change the theme_color taxonomy labels to be more user-friendly
 */
function sasexpliq_rename_theme_color_taxonomy() {
    global $wp_taxonomies;
    
    if (isset($wp_taxonomies['theme_color'])) {
        $labels = &$wp_taxonomies['theme_color']->labels;
        
        $labels->name = 'Thèmes';
        $labels->singular_name = 'Thème';
        $labels->search_items = 'Rechercher les thèmes';
        $labels->all_items = 'Tous les thèmes';
        $labels->edit_item = 'Modifier le thème';
        $labels->update_item = 'Mettre à jour le thème';
        $labels->add_new_item = 'Ajouter un nouveau thème';
        $labels->new_item_name = 'Nouveau thème';
        $labels->menu_name = 'Thèmes';
    }
}
add_action('init', 'sasexpliq_rename_theme_color_taxonomy', 1000);

// /**
//  * Modify article post type to include theme in URL structure
//  */
// function sasexpliq_modify_article_permalink($post_link, $post) {
//     if ($post->post_type === 'article') {
//         // Get the theme color terms for this article
//         $terms = get_the_terms($post->ID, 'theme_color');
        
//         if ($terms && !is_wp_error($terms)) {
//             $theme_slug = $terms[0]->slug;
            
//             // Get the theme post that matches this term
//             $theme_args = array(
//                 'post_type' => 'theme',
//                 'posts_per_page' => 1,
//                 'tax_query' => array(
//                     array(
//                         'taxonomy' => 'theme_color',
//                         'field' => 'slug',
//                         'terms' => $theme_slug,
//                     ),
//                 ),
//             );
            
//             $theme_query = new WP_Query($theme_args);
//             if ($theme_query->have_posts()) {
//                 $theme_query->the_post();
//                 $theme_post_name = get_post_field('post_name', get_the_ID());
//                 wp_reset_postdata();
                
//                 // Replace the "article" part with "theme/theme-name"
//                 $post_link = str_replace('article/', 'theme/' . $theme_post_name . '/', $post_link);
//             }
//         }
//     }
    
//     return $post_link;
// }
// add_filter('post_type_link', 'sasexpliq_modify_article_permalink', 10, 2);

// /**
//  * Add a rewrite rule to handle the new URL structure
//  */
// function sasexpliq_add_article_rewrite_rules() {
//     add_rewrite_rule(
//         'theme/([^/]+)/([^/]+)/?$',
//         'index.php?post_type=article&name=$2',
//         'top'
//     );
// }
// add_action('init', 'sasexpliq_add_article_rewrite_rules');

/**
 * Include additional files
 */
require SASEXPLIQ_THEME_DIR . '/inc/template-functions.php';