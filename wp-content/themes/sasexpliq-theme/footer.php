<?php
/**
 * The template for displaying the footer
 */
?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-left">
                    <p>Avec le soutien de</p>
                    <div class="support-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/etat-geneve.jpg" alt="République et Canton de Genève" style="max-width:100px; height:auto;" />
                    </div>
                </div>
                <div class="footer-right">
                    <!-- <p class="association-name">Association Sasexpliq</p> -->
                    <p class="association-email"><a href="mailto:info@sasexpliq.com">info@sasexpliq.com</a></p>
                    <a href="https://www.instagram.com/sasexpliq" target="_blank" rel="noopener noreferrer" class="social-link instagram">
                        <span class="screen-reader-text">Instagram</span>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ig-icon.png" alt="Instagram" width="32" height="32" />
                    </a>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>