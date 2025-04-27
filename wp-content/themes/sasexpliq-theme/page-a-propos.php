<?php
/**
 * Template Name: Page À propos
 * Template for displaying the About page
 */

get_header();
?>

<main id="primary" class="site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="container">
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail( 'full', array( 'class' => 'about-featured-image' ) ); ?>
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

            <?php if ( get_field( 'team_members' ) ) : // Requires ACF plugin ?>
            <div class="team-section">
                <h2 class="section-title"><?php esc_html_e( 'Notre équipe', 'sasexpliq' ); ?></h2>
                
                <div class="team-grid">
                    <?php
                    $team_members = get_field( 'team_members' );
                    
                    foreach ( $team_members as $member ) :
                        $name = isset( $member['name'] ) ? $member['name'] : '';
                        $role = isset( $member['role'] ) ? $member['role'] : '';
                        $bio = isset( $member['bio'] ) ? $member['bio'] : '';
                        $photo = isset( $member['photo'] ) ? $member['photo'] : 0;
                    ?>
                    <div class="team-member">
                        <?php if ( $photo ) : ?>
                        <div class="team-member-photo">
                            <?php echo wp_get_attachment_image( $photo, 'medium' ); ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="team-member-info">
                            <h3 class="team-member-name"><?php echo esc_html( $name ); ?></h3>
                            <?php if ( $role ) : ?>
                            <p class="team-member-role"><?php echo esc_html( $role ); ?></p>
                            <?php endif; ?>
                            <?php if ( $bio ) : ?>
                            <div class="team-member-bio"><?php echo wp_kses_post( $bio ); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>
        </div><!-- .container -->
    </article><!-- #post-<?php the_ID(); ?> -->
</main><!-- #main -->

<?php
get_footer();