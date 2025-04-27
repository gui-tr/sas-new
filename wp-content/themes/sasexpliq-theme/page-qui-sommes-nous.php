<?php
/**
 * Template Name: Page Qui sommes-nous
 * Template for displaying the Who We Are page
 */

get_header();
?>

<main id="primary" class="site-main qui-sommes-nous-page">
    <div class="page-header">
        <div class="container">
            <div class="tts-readable">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="about-content">
            <section class="association-section">
                <div class="section-text">
                    <div class="tts-readable">
                        <h2 class="section-title">L'association Sasexpliq</h2>
                    </div>
                    <div class="section-body">
                        <p>Une association c'est un ensemble de personnes.</p>
                        <p>Ces personnes veulent donner du temps pour un projet qui est important pour elles.</p>
                        <p>L'association SASEXPLIQ veut rendre accessible les informations:</p>
                        
                        <ul class="association-list">
                            <li>– sur la santé sexuelle</li>
                            <li>– sur la vie intime</li>
                            <li>– sur les droits sexuels</li>
                        </ul>
                        
                        <p>L'association SASEXPLIQ veut donner des informations gratuitement aux personnes avec des difficultés de compréhension.</p>
                    </div>
                </div>
            </section>

            <section class="team-section">
                <div class="section-text">
                    <div class="section-body">
                        <div class="team-members">
                            <!-- Team Member 1 -->
                            <div class="team-member">
                                <div class="team-member-image">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/nicole.webp' ); ?>" alt="Nicole Bregy">
                                </div>
                                <div class="team-member-info">
                                    <h3 class="team-member-name">Nicole Bregy</h3>
                                    <p class="team-member-role">Présidente</p>
                                    <div class="team-member-details">
                                        <p>Éducatrice sociale ES</p>
                                        <p>Sexologue clinicienne</p>
                                    </div>
                                    <div class="team-member-social">
                                        <a href="#" class="social-link linkedin">
                                            <span class="screen-reader-text">LinkedIn</span>
                                            <svg viewBox="0 0 24 24" width="24" height="24">
                                                <path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Team Member 2 -->
                            <div class="team-member">
                                <div class="team-member-image">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Heba.webp' ); ?>" alt="Heba Ezz El-Din">
                                </div>
                                <div class="team-member-info">
                                    <h3 class="team-member-name">Heba Ezz El-Din</h3>
                                    <p class="team-member-role">Vice-Présidente</p>
                                    <div class="team-member-details">
                                        <p>Psychologue</p>
                                        <p>Sexologue clinicienne</p>
                                    </div>
                                    <div class="team-member-social">
                                        <a href="#" class="social-link linkedin">
                                            <span class="screen-reader-text">LinkedIn</span>
                                            <svg viewBox="0 0 24 24" width="24" height="24">
                                                <path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Team Member 3 -->
                            <div class="team-member">
                                <div class="team-member-image">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/mylene.webp' ); ?>" alt="Mylène Bolmont">
                                </div>
                                <div class="team-member-info">
                                    <h3 class="team-member-name">Mylène Bolmont</h3>
                                    <p class="team-member-role">Membre du comité</p>
                                    <div class="team-member-details">
                                        <p>Chargée de cours à l'UNIGE</p>
                                        <p>Psychologue FSP</p>
                                        <p>Sexologue SSS</p>
                                    </div>
                                    <div class="team-member-social">
                                        <a href="#" class="social-link linkedin">
                                            <span class="screen-reader-text">LinkedIn</span>
                                            <svg viewBox="0 0 24 24" width="24" height="24">
                                                <path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Team Member 4 -->
                            <div class="team-member">
                                <div class="team-member-image">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/nadia.webp' ); ?>" alt="Nadia Morand">
                                </div>
                                <div class="team-member-info">
                                    <h3 class="team-member-name">Nadia Morand</h3>
                                    <p class="team-member-role">Membre du comité</p>
                                    <div class="team-member-details">
                                        <p>Sexologue clinicienne</p>
                                        <p>Formatrice superviseuse</p>
                                    </div>
                                    <div class="team-member-social">
                                        <a href="#" class="social-link linkedin">
                                            <span class="screen-reader-text">LinkedIn</span>
                                            <svg viewBox="0 0 24 24" width="24" height="24">
                                                <path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Team Member 5 -->
                            <div class="team-member">
                                <div class="team-member-image">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/stephane.webp' ); ?>" alt="Stéphane With">
                                </div>
                                <div class="team-member-info">
                                    <h3 class="team-member-name">Stéphane With</h3>
                                    <p class="team-member-role">Membre du comité</p>
                                    <div class="team-member-details">
                                        <p>Psychologue</p>
                                        <p>Psychothérapeute FSP</p>
                                        <p>Chargé de cours santé sexuelle</p>
                                    </div>
                                    <div class="team-member-social">
                                        <a href="#" class="social-link linkedin">
                                            <span class="screen-reader-text">LinkedIn</span>
                                            <svg viewBox="0 0 24 24" width="24" height="24">
                                                <path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Team Member 6 -->
                            <div class="team-member">
                                <div class="team-member-image">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Malek.webp' ); ?>" alt="Malek Azzouz">
                                </div>
                                <div class="team-member-info">
                                    <h3 class="team-member-name">Malek Azzouz</h3>
                                    <p class="team-member-role">Membre du comité</p>
                                    <div class="team-member-details">
                                        <p>Consultant au sein d'un cabinet d'experts</p>
                                        <p>fédéraux en prévoyance</p>
                                    </div>
                                    <div class="team-member-social">
                                        <a href="#" class="social-link linkedin">
                                            <span class="screen-reader-text">LinkedIn</span>
                                            <svg viewBox="0 0 24 24" width="24" height="24">
                                                <path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- .about-content -->
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();