<?php
/**
 * The template for displaying theme archives
 */

get_header();

// Get the current theme color if we're on a taxonomy page
$color_class = '';
if ( is_tax( 'theme_color' ) ) {
    $term = get_queried_object();
    $color_class = sasexpliq_get_theme_color_class( $term->slug );
}
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header <?php echo esc_attr( 'theme-' . $color_class ); ?>">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <?php if ( have_posts() ) : ?>
            <div class="themes-grid archive-grid">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    // Get theme color
                    $terms = get_the_terms( get_the_ID(), 'theme_color' );
                    $post_color = ! empty( $terms ) ? sasexpliq_get_theme_color_class( $terms[0]->slug ) : $color_class;
                    ?>
                    <div class="theme-card theme-card-<?php echo esc_attr( $post_color ); ?>">
                        <a href="<?php the_permalink(); ?>" class="theme-card-link">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="theme-card-thumbnail">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </div>
                            <?php else : ?>
                                <div class="theme-card-icon">
                                    <!-- Icon is created with CSS based on the theme color -->
                                </div>
                            <?php endif; ?>
                            <h2 class="theme-card-title"><?php the_title(); ?></h2>
                            <div class="theme-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </a>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>

            <?php
            the_posts_navigation(
                array(
                    'prev_text' => '&larr; ' . esc_html__( 'Thèmes précédents', 'sasexpliq' ),
                    'next_text' => esc_html__( 'Thèmes suivants', 'sasexpliq' ) . ' &rarr;',
                )
            );

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();