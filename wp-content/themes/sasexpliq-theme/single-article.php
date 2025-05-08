<?php
/**
 * The template for displaying single articles
 */

get_header();

// Get the article's theme
$article_id = get_the_ID();
$theme_terms = get_the_terms($article_id, 'theme_color');
$theme_color = !empty($theme_terms) ? $theme_terms[0]->slug : 'yellow';
$color_class = sasexpliq_get_theme_color_class($theme_color);

// Get the theme object to link back to
$theme_obj = null;
if (!empty($theme_terms)) {
    $args = array(
        'post_type' => 'theme',
        'posts_per_page' => 1, 
        'tax_query' => array(
            array(
                'taxonomy' => 'theme_color',
                'field' => 'slug',
                'terms' => $theme_color,
            ),
        ),
    );
    $theme_query = new WP_Query($args);
    if ($theme_query->have_posts()) {
        $theme_query->the_post();
        $theme_obj = array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'url' => get_permalink(),
        );
        wp_reset_postdata();
    }
}
?>

<main id="primary" class="site-main article-page theme-<?php echo esc_attr($color_class); ?>">
    
    <!-- Article Header -->
    <div class="article-header" style="background-color: var(--color-<?php echo esc_attr($color_class); ?>);">
        <div class="container">
            <?php if ($theme_obj) : ?>
            <div class="article-breadcrumb">
                <a href="<?php echo esc_url($theme_obj['url']); ?>" class="breadcrumb-link" aria-label="Retour">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" style="vertical-align: middle;">
                        <line x1="20" y1="12" x2="4" y2="12" stroke="currentColor" stroke-width="2" />
                        <polyline points="10 6 4 12 10 18" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <?php endif; ?>
            <div class="tts-readable">
                <h1 class="article-title"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>


    <div class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class('article-content'); ?>>
            <?php if (has_post_thumbnail()) : ?>
            <div class="article-featured-image">
                <?php the_post_thumbnail('large'); ?>
            </div>
            <?php endif; ?>
            <div class="tts-readable">
                <div class="article-entry">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>

        <!-- Related Articles -->
        <?php
        // Get related articles from the same theme
        $args = array(
            'post_type' => 'article',
            'posts_per_page' => 3,
            'post__not_in' => array($article_id),
            'tax_query' => array(
                array(
                    'taxonomy' => 'theme_color',
                    'field' => 'slug',
                    'terms' => $theme_color,
                ),
            ),
        );
        
        $related_articles = new WP_Query($args);
        
        if ($related_articles->have_posts()) :
        ?>
        <div class="related-articles">
            <h2 class="related-title"><?php _e('Articles similaires', 'sasexpliq'); ?></h2>
            
            <div class="articles-grid">
                <?php while ($related_articles->have_posts()) : $related_articles->the_post(); ?>
                <div class="article-card">
                    <div class="article-card-inner">
                        <div class="tts-readable">
                            <h3 class="article-title"><?php the_title(); ?></h3>
                        </div>
                        <div class="article-excerpt">
                            <?php the_excerpt(); ?>
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
                <?php endwhile; ?>
            </div>
            
            <?php wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>

        <!-- Back to Theme -->
        <?php if ($theme_obj) : ?>
            <div class="theme-actions">
                <a href="<?php echo esc_url($theme_obj['url']); ?>" class="btn-back-to-theme">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" style="vertical-align: middle;">
                  <line x1="20" y1="12" x2="4" y2="12" stroke="currentColor" stroke-width="2" />
                  <polyline points="10 6 4 12 10 18" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                    <?php _e('Retour à ', 'sasexpliq'); ?> <?php echo esc_html($theme_obj['title']); ?>
                </a>
            </div>

        <?php endif; ?>
    </div>
</main>

<?php
get_footer();