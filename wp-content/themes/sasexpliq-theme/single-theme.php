<?php
/**
 * The template for displaying single theme posts
 */

get_header();

// Get current theme and its color
$theme_id = get_the_ID();
$theme_title = get_the_title();
$theme_content = get_the_content();
$theme_terms = get_the_terms($theme_id, 'theme_color');
$theme_color = !empty($theme_terms) ? $theme_terms[0]->slug : 'yellow';

// Get color class
$color_class = sasexpliq_get_theme_color_class($theme_color);

// Get the featured image
$featured_image = get_the_post_thumbnail_url($theme_id, 'full');
?>

<main id="primary" class="site-main theme-page theme-<?php echo esc_attr($color_class); ?>">
    
    <!-- Theme Banner -->
    <div class="theme-banner" style="background-color: var(--color-<?php echo esc_attr($color_class); ?>);">
        <div class="container">
            <div class="theme-banner-content">
                <div class="tts-readable">
                    <h1 class="theme-title"><?php echo esc_html($theme_title); ?></h1>
                </div>
                
                <?php if ($featured_image) : ?>
                <div class="theme-banner-image">
                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($theme_title); ?>">
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <?php if (!empty($theme_content)) : ?>
        <div class="theme-content">
            <?php echo apply_filters('the_content', $theme_content); ?>
        </div>
        <?php endif; ?>

        <!-- Top Back Button -->
        <div class="theme-actions">
            <a href="<?php echo esc_url(home_url('/#themes')); ?>" class="btn-choose-theme">
                <?php _e('Choisir un autre thème', 'sasexpliq'); ?>
            </a>
        </div>

        <!-- Articles Section -->
        <div class="theme-articles">
            <?php
            // Get articles for this theme
            $args = array(
                'post_type' => 'article',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'theme_color',
                        'field' => 'slug',
                        'terms' => $theme_color,
                    ),
                ),
            );
            
            $articles = new WP_Query($args);
            
            if ($articles->have_posts()) :
                echo '<div class="articles-grid">';
                
                while ($articles->have_posts()) : $articles->the_post();
                    // Get the article title and excerpt
                    $article_title = get_the_title();
                    $article_excerpt = get_the_excerpt();
                    ?>
                    <div class="article-card">
                        <div class="article-card-inner">
                            <div class="tts-readable">
                                <h3 class="article-title"><?php echo esc_html($article_title); ?></h3>
                            </div>
                            <div class="article-excerpt">
                                <?php echo wpautop(esc_html($article_excerpt)); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="article-read-more" aria-label="<?php _e('Lire l\'article', 'sasexpliq'); ?>">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" style="vertical-align: middle;">
                                    <line x1="4" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="2" />
                                    <polyline points="14 6 20 12 14 18" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <?php
                endwhile;
                
                echo '</div>';
                
                // Reset post data
                wp_reset_postdata();
            else :
                ?>
                <div class="no-articles">
                    <p><?php _e('Aucun article pour ce thème.', 'sasexpliq'); ?></p>
                </div>
                <?php
            endif;
            ?>
        </div>

        <!-- Back Button -->
        <div class="theme-actions">
            <a href="<?php echo esc_url(home_url('/#themes')); ?>" class="btn-choose-theme">
                <?php _e('Choisir un autre thème', 'sasexpliq'); ?>
            </a>
        </div>
    </div>
</main>

<?php
get_footer();