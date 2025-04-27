<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function sasexpliq_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'sasexpliq_pingback_header' );

/**
 * Add custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sasexpliq_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_action( 'body_class', 'sasexpliq_body_classes' );

/**
 * Generate SVG markup for theme icons
 *
 * @param string $icon Icon name
 * @param array  $args Icon arguments
 * @return string SVG markup
 */
function sasexpliq_get_icon_svg( $icon, $args = array() ) {
    // Default values for arguments
    $defaults = array(
        'width'  => 24,
        'height' => 24,
        'fill'   => 'currentColor',
        'class'  => '',
    );
    
    $args = wp_parse_args( $args, $defaults );
    
    // SVG icon classes
    $class = 'icon icon-' . $icon;
    
    if ( ! empty( $args['class'] ) ) {
        $class .= ' ' . $args['class'];
    }
    
    // SVG markup based on icon name
    switch ( $icon ) {
        case 'instagram':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . esc_attr( $args['width'] ) . '" height="' . esc_attr( $args['height'] ) . '" viewBox="0 0 24 24" fill="' . esc_attr( $args['fill'] ) . '" class="' . esc_attr( $class ) . '"><path d="M12 2C14.717 2 15.056 2.01 16.122 2.06C17.187 2.11 17.912 2.277 18.55 2.525C19.21 2.779 19.766 3.123 20.322 3.678C20.8305 4.1779 21.224 4.78259 21.475 5.45C21.722 6.087 21.89 6.813 21.94 7.878C21.987 8.944 22 9.283 22 12C22 14.717 21.99 15.056 21.94 16.122C21.89 17.187 21.722 17.912 21.475 18.55C21.2247 19.2178 20.8311 19.8226 20.322 20.322C19.822 20.8303 19.2173 21.2238 18.55 21.475C17.913 21.722 17.187 21.89 16.122 21.94C15.056 21.987 14.717 22 12 22C9.283 22 8.944 21.99 7.878 21.94C6.813 21.89 6.088 21.722 5.45 21.475C4.78233 21.2245 4.17753 20.8309 3.678 20.322C3.16941 19.8222 2.77593 19.2175 2.525 18.55C2.277 17.913 2.11 17.187 2.06 16.122C2.013 15.056 2 14.717 2 12C2 9.283 2.01 8.944 2.06 7.878C2.11 6.812 2.277 6.088 2.525 5.45C2.77524 4.78218 3.1688 4.17732 3.678 3.678C4.17767 3.16923 4.78243 2.77573 5.45 2.525C6.088 2.277 6.812 2.11 7.878 2.06C8.944 2.013 9.283 2 12 2ZM12 7C10.6739 7 9.40215 7.52678 8.46447 8.46447C7.52678 9.40215 7 10.6739 7 12C7 13.3261 7.52678 14.5979 8.46447 15.5355C9.40215 16.4732 10.6739 17 12 17C13.3261 17 14.5979 16.4732 15.5355 15.5355C16.4732 14.5979 17 13.3261 17 12C17 10.6739 16.4732 9.40215 15.5355 8.46447C14.5979 7.52678 13.3261 7 12 7V7ZM18.5 6.75C18.5 6.41848 18.3683 6.10054 18.1339 5.86612C17.8995 5.6317 17.5815 5.5 17.25 5.5C16.9185 5.5 16.6005 5.6317 16.3661 5.86612C16.1317 6.10054 16 6.41848 16 6.75C16 7.08152 16.1317 7.39946 16.3661 7.63388C16.6005 7.8683 16.9185 8 17.25 8C17.5815 8 17.8995 7.8683 18.1339 7.63388C18.3683 7.39946 18.5 7.08152 18.5 6.75ZM12 9C12.7956 9 13.5587 9.31607 14.1213 9.87868C14.6839 10.4413 15 11.2044 15 12C15 12.7956 14.6839 13.5587 14.1213 14.1213C13.5587 14.6839 12.7956 15 12 15C11.2044 15 10.4413 14.6839 9.87868 14.1213C9.31607 13.5587 9 12.7956 9 12C9 11.2044 9.31607 10.4413 9.87868 9.87868C10.4413 9.31607 11.2044 9 12 9Z" /></svg>';
            break;
            
        case 'chevron-down':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . esc_attr( $args['width'] ) . '" height="' . esc_attr( $args['height'] ) . '" viewBox="0 0 24 24" fill="none" stroke="' . esc_attr( $args['fill'] ) . '" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="' . esc_attr( $class ) . '"><polyline points="6 9 12 15 18 9"></polyline></svg>';
            break;
            
        default:
            $svg = '';
            break;
    }
    
    return $svg;
}

/**
 * Generate color classes for theme cards
 *
 * @param string $color Color name
 * @return string Color class
 */
function sasexpliq_get_theme_color_class( $color ) {
    $colors = array(
        'sexualite' => 'purple',
        'relations' => 'orange',
        'corps' => 'blue',
        'etre-soi' => 'yellow',
        'droits-sexuels' => 'pink',
        'divers' => 'green',
    );
    
    return isset( $colors[$color] ) ? $colors[$color] : 'purple';
}

/**
 * Get theme items for the grid display
 * 
 * @param int $count Number of items to display
 * @return array Array of theme items
 */
function sasexpliq_get_theme_items( $count = 6 ) {
    $args = array(
        'post_type'      => 'theme',
        'posts_per_page' => $count,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );
    
    $themes = get_posts( $args );
    
    if ( empty( $themes ) ) {
        // Return default themes if no custom themes are created yet
        return array(
            array(
                'title' => 'La sexualité',
                'color' => 'purple',
                'slug'  => 'la-sexualite',
                'url'   => home_url( '/themes/la-sexualite/' ),
            ),
            array(
                'title' => 'Les relations',
                'color' => 'orange',
                'slug'  => 'les-relations',
                'url'   => home_url( '/themes/les-relations/' ),
            ),
            array(
                'title' => 'Le corps',
                'color' => 'blue',
                'slug'  => 'le-corps',
                'url'   => home_url( '/themes/le-corps/' ),
            ),
            array(
                'title' => 'Être soi',
                'color' => 'yellow',
                'slug'  => 'etre-soi',
                'url'   => home_url( '/themes/etre-soi/' ),
            ),
            array(
                'title' => 'Les droits sexuels',
                'color' => 'pink',
                'slug'  => 'les-droits-sexuels',
                'url'   => home_url( '/themes/les-droits-sexuels/' ),
            ),
            array(
                'title' => 'Divers',
                'color' => 'green',
                'slug'  => 'divers',
                'url'   => home_url( '/themes/divers/' ),
            ),
        );
    }
    
    $items = array();
    
    foreach ( $themes as $theme ) {
        $terms = get_the_terms( $theme->ID, 'theme_color' );
        $color = ! empty( $terms ) ? sasexpliq_get_theme_color_class( $terms[0]->slug ) : 'purple';
        
        $items[] = array(
            'title' => $theme->post_title,
            'color' => $color,
            'slug'  => $theme->post_name,
            'url'   => get_permalink( $theme->ID ),
        );
    }
    
    return $items;
}

/**
 * Add logo SVG to theme
 */
function sasexpliq_add_theme_logo() {
    // Create the uploads directory if it doesn't exist
    $upload_dir = wp_upload_dir();
    $logo_dir = $upload_dir['basedir'] . '/sasexpliq';
    
    if ( ! file_exists( $logo_dir ) ) {
        wp_mkdir_p( $logo_dir );
    }
    
    // Create the logo SVG file if it doesn't exist
    $logo_file = $logo_dir . '/logo-site.svg';
    
    if ( ! file_exists( $logo_file ) ) {
        $logo_svg = '<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="50" height="50" rx="5" fill="#000000"/>
            <path d="M25 15C29.1421 15 32.5 18.3579 32.5 22.5C32.5 24.0235 32.0308 25.5 31.0957 26.6667H33.75C36.8566 26.6667 39.375 29.1851 39.375 32.2917C39.375 35.3983 36.8566 37.9167 33.75 37.9167H16.25C13.1434 37.9167 10.625 35.3983 10.625 32.2917C10.625 29.1851 13.1434 26.6667 16.25 26.6667H18.9043C17.9692 25.4456 17.5 24.0235 17.5 22.5C17.5 18.3579 20.8579 15 25 15ZM26.5625 20.9375C25.699 20.9375 25 21.6365 25 22.5C25 23.3635 25.699 24.0625 26.5625 24.0625C27.426 24.0625 28.125 23.3635 28.125 22.5C28.125 21.6365 27.426 20.9375 26.5625 20.9375ZM23.4375 20.9375C22.574 20.9375 21.875 21.6365 21.875 22.5C21.875 23.3635 22.574 24.0625 23.4375 24.0625C24.301 24.0625 25 23.3635 25 22.5C25 21.6365 24.301 20.9375 23.4375 20.9375Z" fill="white"/>
        </svg>';
        
        file_put_contents( $logo_file, $logo_svg );
    }
    
    // Check if theme directory exists, if not create it
    $theme_dir = get_template_directory() . '/assets/images';
    
    if ( ! file_exists( $theme_dir ) ) {
        wp_mkdir_p( $theme_dir );
    }
    
    // Copy logo to theme directory
    $theme_logo_file = $theme_dir . '/logo-site.svg';
    
    if ( ! file_exists( $theme_logo_file ) ) {
        copy( $logo_file, $theme_logo_file );
    }
    
    // Create hero image SVG
    $hero_file = $theme_dir . '/hero-couple.png';
    
    if ( ! file_exists( $hero_file ) ) {
        $hero_svg = '<svg width="300" height="400" viewBox="0 0 300 400" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M150 100C138.954 100 130 108.954 130 120C130 131.046 138.954 140 150 140C161.046 140 170 131.046 170 120C170 108.954 161.046 100 150 100Z" fill="#7A1EA1"/>
            <path d="M150 150C134.144 150 120.591 158.062 113.739 170H120C126.627 170 132 175.373 132 182V250C132 256.627 126.627 262 120 262H80C73.3726 262 68 256.627 68 250V200C68 176.804 86.804 158 110 158C116.627 158 122 152.627 122 146C122 139.373 116.627 134 110 134C73.6081 134 44 163.608 44 200V262C44 275.255 54.7452 286 68 286H132C145.255 286 156 275.255 156 262V220H168V262C168 275.255 178.745 286 192 286H256C269.255 286 280 275.255 280 262V200C280 163.608 250.392 134 214 134C207.373 134 202 139.373 202 146C202 152.627 207.373 158 214 158C237.196 158 256 176.804 256 200V250C256 256.627 250.627 262 244 262H204C197.373 262 192 256.627 192 250V182C192 175.373 197.373 170 204 170H210.261C203.409 158.062 189.856 150 174 150H150Z" fill="#7A1EA1"/>
            <path d="M204 350L204 286" stroke="#7A1EA1" stroke-width="2"/>
            <path d="M220 350L220 286" stroke="#7A1EA1" stroke-width="2"/>
            <path d="M80 350L80 286" stroke="#7A1EA1" stroke-width="2"/>
            <path d="M96 350L96 286" stroke="#7A1EA1" stroke-width="2"/>
            <rect x="204" y="350" width="16" height="30" rx="8" fill="#FF5722"/>
            <rect x="80" y="350" width="16" height="30" rx="8" fill="#FF5722"/>
        </svg>';
        
        file_put_contents( $hero_file, $hero_svg );
    }
}
add_action( 'after_setup_theme', 'sasexpliq_add_theme_logo' );


/**
 * Create placeholder images for the theme
 */
function sasexpliq_add_placeholder_images() {
    // Check if theme directory exists, if not create it
    $theme_dir = get_template_directory() . '/assets/images';
    
    if ( ! file_exists( $theme_dir ) ) {
        wp_mkdir_p( $theme_dir );
    }
    
    // Create placeholder image for team members
    $placeholder_file = $theme_dir . '/placeholder-team.jpg';
    
    if ( ! file_exists( $placeholder_file ) ) {
        // Get placeholder from WordPress or from a remote source
        $placeholder_url = 'https://via.placeholder.com/600x600/E6D1F2/7A1EA1?text=Team+Member';
        $placeholder_image = wp_remote_get( $placeholder_url );
        
        if ( ! is_wp_error( $placeholder_image ) && 200 === wp_remote_retrieve_response_code( $placeholder_image ) ) {
            $image_contents = wp_remote_retrieve_body( $placeholder_image );
            file_put_contents( $placeholder_file, $image_contents );
        }
    }
}
add_action( 'after_setup_theme', 'sasexpliq_add_placeholder_images' );