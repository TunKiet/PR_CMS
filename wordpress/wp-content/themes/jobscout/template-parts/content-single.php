<?php
/**
 * Template part for displaying single posts - News Detail Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout
 */

// Store current post ID before any queries
$current_post_id = get_the_ID();
$categories = get_the_category();
?>

<!-- Breadcrumb -->
<div class="news-detail-breadcrumb">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'jobscout' ); ?></a>
    <span class="sep">/</span>
    <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>"><?php esc_html_e( 'All News', 'jobscout' ); ?></a>
    <span class="sep">/</span>
    <span class="current"><?php esc_html_e( 'News Detail', 'jobscout' ); ?></span>
</div>

<!-- Post Header with Title and Share Button -->
<header class="single-post-header">
    <div class="header-left">
        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="header-thumb">
                <?php the_post_thumbnail( 'thumbnail' ); ?>
            </figure>
        <?php endif; ?>
        <div class="header-info">
            <h1 class="single-post-title"><?php the_title(); ?></h1>
            <div class="post-meta">
                <span class="meta-date"><?php echo get_the_date( 'F j, Y' ); ?></span>
                <?php if ( ! empty( $categories ) ) : ?>
                    <span class="meta-cat"><?php echo esc_html( $categories[0]->name ); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <a href="#" class="share-btn" onclick="navigator.share ? navigator.share({title: '<?php echo esc_js( get_the_title() ); ?>', url: '<?php echo esc_js( get_permalink() ); ?>'}) : window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>', '_blank'); return false;">
        <?php esc_html_e( 'SHARE', 'jobscout' ); ?>
    </a>
</header>

<!-- Post Content -->
<div class="single-post-content">
    <?php the_content(); ?>
</div>

<!-- NEWEST BLOG ENTRIES Section -->
<section class="related-posts-section">
    <h2 class="related-title"><?php esc_html_e( 'NEWEST BLOG ENTRIES', 'jobscout' ); ?></h2>
    
    <div class="related-posts-grid">
        <?php
        // Query for related posts (excluding current post)
        $related_args = array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => 8,
            'post__not_in'        => array( $current_post_id ),
            'orderby'             => 'date',
            'order'               => 'DESC',
            'ignore_sticky_posts' => true
        );
        $related_query = new WP_Query( $related_args );

        if ( $related_query->have_posts() ) :
            while ( $related_query->have_posts() ) : $related_query->the_post(); 
        ?>
            <article class="related-post-card">
                <figure class="card-thumb">
                    <a href="<?php the_permalink(); ?>">
                        <?php 
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'medium' );
                        } else {
                            jobscout_fallback_svg_image( 'medium' );
                        }
                        ?>
                    </a>
                </figure>
                <div class="card-content">
                    <h3 class="card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="card-excerpt">
                        <?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 15, '...' ) ); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="card-readmore"><?php esc_html_e( 'Read More', 'jobscout' ); ?></a>
                </div>
            </article>
        <?php 
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>

