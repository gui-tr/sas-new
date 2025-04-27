<?php
/**
 * Template part for displaying a message that posts cannot be found
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Rien trouvé', 'sasexpliq' ); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if ( is_search() ) :
            ?>
            <p><?php esc_html_e( 'Désolé, mais rien ne correspond à vos critères de recherche. Veuillez réessayer avec d\'autres mots-clés.', 'sasexpliq' ); ?></p>
            <?php
            get_search_form();
        else :
            ?>
            <p><?php esc_html_e( 'Il semble que nous ne puissions pas trouver ce que vous cherchez. Peut-être qu\'une recherche peut aider.', 'sasexpliq' ); ?></p>
            <?php
            get_search_form();
        endif;
        ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->