<?php
/**
 * Template Name: Page À propos
 * Template for displaying the About page
 */

get_header();
?>

<main id="primary" class="site-main a-propos-page">
    <div class="page-header">
        <div class="container">
            <div class="tts-readable">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="about-content">
            
            <!-- Section: C'est quoi -->
            <section class="about-section">
                <div class="section-content">
                    <div class="section-text">
                        <div class="tts-readable">
                            <h2 class="section-title">C'est quoi</h2>
                        </div>
                        <div class="section-body">
                            <p>Tu trouveras des informations:</p>
                            <ul class="bullet-list">
                                <li>– sur la santé sexuelle</li>
                                <li>– sur le corps</li>
                                <li>– sur les relations</li>
                                <li>– sur les droits sexuels</li>
                                <li>– et encore plein d'autres thèmes</li>
                            </ul>
                        </div>
                    </div>
                    <div class="section-image">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/a-propos/cest-quoi.png' ); ?>" alt="Bulle de dialogue">
                    </div>
                </div>
            </section>
            
            <!-- Section: Pour qui? -->
            <section class="about-section">
                <div class="section-content">
                    <div class="section-text">
                        <div class="tts-readable">
                            <h2 class="section-title">Pour qui?</h2>
                        </div>
                        <div class="section-body">
                            <p>Le site sasexpliq.com est pour les personnes:</p>
                            <ul class="bullet-list">
                                <li>– qui veulent avoir des informations sur la vie sexuelle, intime et affective</li>
                                <li>– qui ont des difficultés avec les textes difficiles</li>
                                <li>– qui ont des difficultés pour lire</li>
                            </ul>
                        </div>
                    </div>
                    <div class="section-image">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/a-propos/pour-qui.png' ); ?>" alt="Personnes">
                    </div>
                </div>
            </section>
            
            <!-- Section: Pour quoi? -->
            <section class="about-section">
                <div class="section-content">
                    <div class="section-text">
                        <div class="tts-readable">
                            <h2 class="section-title">Pour quoi?</h2>
                        </div>
                        <div class="section-body">
                            <p>La santé sexuelle c'est très important dans la vie d'une personne</p>
                            <ul class="bullet-list">
                                <li>– C'est difficile de trouver des informations faciles à comprendre</li>
                                <li>– Les personnes doivent avoir l'information facilement</li>
                                <li>– Le droit à l'information doit être gratuit</li>
                            </ul>
                        </div>
                    </div>
                    <div class="section-image">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/a-propos/pour-quoi.png' ); ?>" alt="Livre">
                    </div>
                </div>
            </section>
            
            <?php
            // If there's additional content from the WordPress editor
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
            endif;
            ?>
            
        </div><!-- .about-content -->
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();