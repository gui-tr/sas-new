<?php
/**
 * The template for displaying the front page
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title tts-readable">L'éducation sexuelle facile <br>à comprendre</h1>
                </div>
                <div class="hero-image">
                    <img src="<?php echo esc_url( SASEXPLIQ_THEME_URI . '/assets/images/hero-couple.png' ); ?>" alt="Couple illustration">
                </div>
            </div>
        </div>
    </section>

    <section id="themes" class="themes-section">
        <div class="container">
            <h2 class="section-title tts-readable">Thèmes</h2>
            
            <div class="themes-grid">
                <?php
                $themes = array(
                    array(
                        'title' => 'La sexualité',
                        'color' => 'purple',
                        'slug' => 'la-sexualite'
                    ),
                    array(
                        'title' => 'Les relations',
                        'color' => 'orange',
                        'slug' => 'les-relations'
                    ),
                    array(
                        'title' => 'Le corps',
                        'color' => 'blue',
                        'slug' => 'le-corps'
                    ),
                    array(
                        'title' => 'Être soi',
                        'color' => 'yellow',
                        'slug' => 'etre-soi'
                    ),
                    array(
                        'title' => 'Les droits sexuels',
                        'color' => 'pink',
                        'slug' => 'les-droits-sexuels'
                    ),
                    array(
                        'title' => 'Divers',
                        'color' => 'green',
                        'slug' => 'divers'
                    ),
                );

                foreach ( $themes as $theme ) :
                    // Get the theme page URL based on the slug
                    $theme_page = get_page_by_path($theme['slug'], OBJECT, 'theme');
                    $theme_url = $theme_page ? get_permalink($theme_page->ID) : '#';
                ?>
                <div class="theme-card theme-card-<?php echo esc_attr( $theme['color'] ); ?>">
                    <a href="<?php echo esc_url( $theme_url ); ?>" class="theme-card-link">
                        <div class="theme-card-icon">
                            <?php 
                            // Map the theme slug to the correct SVG filename
                            $svg_filename = '';
                            switch ($theme['slug']) {
                                case 'la-sexualite':
                                    $svg_filename = 'sexualite.svg';
                                    break;
                                case 'les-relations':
                                    $svg_filename = 'relations.svg';
                                    break;
                                case 'le-corps':
                                    $svg_filename = 'corps.svg';
                                    break;
                                case 'etre-soi':
                                    $svg_filename = 'etre-soi.svg';
                                    break;
                                case 'les-droits-sexuels':
                                    $svg_filename = 'droits.svg';
                                    break;
                                case 'divers':
                                    $svg_filename = 'divers.svg';
                                    break;
                                default:
                                    $svg_filename = 'sexualite.svg';
                            }
                            ?>
                            <img src="<?php echo esc_url( SASEXPLIQ_THEME_URI . '/assets/images/themes/' . $svg_filename ); ?>" alt="<?php echo esc_attr( $theme['title'] ); ?> icon">
                        </div>
                    </a>
                    <h3 class="theme-card-title tts-readable"><?php echo esc_html( $theme['title'] ); ?></h3>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div style="text-align: center; margin-bottom: 30px;">
                <div class="tts-readable">
                    <h2 class="section-title">Tu veux nous écrire?</h2>
                </div>
            </div>
            
            <div class="contact-form-container">
                <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="contact-form">
                    <?php wp_nonce_field( 'sasexpliq_contact_form', 'sasexpliq_contact_nonce' ); ?>
                    <input type="hidden" name="action" value="sasexpliq_contact_form">
                    
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="Nom" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Email" required>
                    </div>
                    
                    <div class="form-group">
                        <textarea name="message" id="message" placeholder="Message" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                    
                    <?php if ( isset( $_GET['contact'] ) ) : ?>
                        <div class="form-message <?php echo esc_attr( $_GET['contact'] ); ?>">
                            <?php if ( $_GET['contact'] === 'success' ) : ?>
                                <p>Merci pour votre message! Nous vous répondrons bientôt.</p>
                            <?php else : ?>
                                <p>Une erreur s'est produite. Veuillez réessayer plus tard.</p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();