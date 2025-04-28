<?php
/**
 * The header for our theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo esc_url( SASEXPLIQ_THEME_URI . '/assets/images/Favicon.png' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sasexpliq' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="site-branding">
                <?php
                if ( has_custom_logo() ) :
                    the_custom_logo();
                else :
                ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                        <img src="<?php echo esc_url( SASEXPLIQ_THEME_URI . '/assets/images/logo-site.svg' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="custom-logo">
                    </a>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'nav-menu',
                    )
                );
                ?>
                <button id="dark-mode-toggle" class="dark-mode-toggle" aria-label="Toggle dark mode">
                    <svg class="sun-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                    <svg class="moon-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                </button>
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </nav><!-- #site-navigation -->
        </div><!-- .container -->
    </header><!-- #masthead -->