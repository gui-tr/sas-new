<?php
/**
 * Template part for displaying theme posts
 */

// Get theme color
$terms = get_the_terms( get_the_ID(), 'theme_color' );
$color_class = '';

if ( ! empty( $terms ) ) {
    $color_class = 'theme-' . sasexpliq_get_theme_color_class( $terms[0]->slug );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $color_class ); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="entry-thumbnail">
        <?php the_post_thumbnail( 'large' ); ?>
    </div><!-- .entry-thumbnail -->
    <?php endif; ?>

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sasexpliq' ),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
        // Display related themes if any
        $related_themes = get_posts(
            array(
                'post_type' => 'theme',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'theme_color',
                        'field'    => 'term_id',
                        'terms'    => wp_list_pluck( $terms, 'term_id' ),
                    ),
                ),
                'post__not_in' => array( get_the_ID() ),
                'posts_per_page' => 3,
            )
        );

        if ( ! empty( $related_themes ) ) :
        ?>
        <div class="related-themes">
            <h2><?php esc_html_e( 'Thèmes liés', 'sasexpliq' ); ?></h2>
            <div class="themes-grid">
                <?php foreach ( $related_themes as $theme_post ) : ?>
                <div class="theme-card theme-card-<?php echo esc_attr( $color_class ); ?>">
                    <a href="<?php echo esc_url( get_permalink( $theme_post->ID ) ); ?>" class="theme-card-link">
                        <div class="theme-card-icon">
                            <!-- Icon is created with CSS based on the theme color -->
                        </div>
                        <h3 class="theme-card-title"><?php echo esc_html( $theme_post->post_title ); ?></h3>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->