<?php
/**
 * Template part for displaying News blog entries grid
 *
 * @package JobScout
 */

// Get number of posts to display from metabox or use default
$posts_per_page = get_post_meta( get_the_ID(), '_news_posts_count', true );
if ( ! $posts_per_page || $posts_per_page < 1 ) {
    $posts_per_page = 8;
}
// Force to integer
$posts_per_page = absint( $posts_per_page );

// Get section title from metabox or use default
$section_title = get_post_meta( get_the_ID(), '_news_section_title', true );
if ( ! $section_title ) {
    $section_title = __( 'NEWEST BLOG ENTRIES', 'jobscout' );
}

$news_query = new WP_Query( array(
    'post_type'           => 'post',
    'posts_per_page'      => intval( $posts_per_page ),
    'ignore_sticky_posts' => true,
    'post_status'         => 'publish',
    'no_found_rows'       => false,
    'nopaging'            => false,
) );

// Debug output (remove after testing)
echo '<!-- Debug: Posts per page = ' . $posts_per_page . ' -->';
echo '<!-- Debug: Found posts = ' . $news_query->found_posts . ' -->';
echo '<!-- Debug: Post count = ' . $news_query->post_count . ' -->';
echo '<!-- Debug: Max num pages = ' . $news_query->max_num_pages . ' -->';

if ( $news_query->have_posts() ) : 
    // Store current post to restore later
    global $post;
    $original_post = $post;
    ?>
    <section class="news-blog-section">
        <div class="container">
            <h2 class="news-section-title"><?php echo esc_html( $section_title ); ?></h2>
            <div class="news-blog-grid">
                <?php 
                $loop_counter = 0;
                foreach ( $news_query->posts as $post ) : 
                    setup_postdata( $post );
                    $loop_counter++;
                    echo '<!-- Loop iteration: ' . $loop_counter . ' -->';
                ?>
                    <article <?php post_class( 'news-blog-card' ); ?>>
                        <a href="<?php the_permalink(); ?>" class="news-blog-thumb">
                            <?php 
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'jobscout-blog' );
                            } else {
                                jobscout_fallback_svg_image( 'jobscout-blog' );
                            } 
                            ?>
                        </a>
                        <div class="news-blog-content">
                            <?php 
                            // Get custom title from metabox or use post title
                            $custom_title = get_post_meta( get_the_ID(), '_news_card_title', true );
                            $display_title = $custom_title ? $custom_title : get_the_title();
                            ?>
                            <h3 class="news-blog-entry-title">
                                <a href="<?php the_permalink(); ?>"><?php echo esc_html( $display_title ); ?></a>
                            </h3>
                            
                            <?php 
                            // Get custom excerpt from metabox or use post excerpt
                            $custom_excerpt = get_post_meta( get_the_ID(), '_news_card_excerpt', true );
                            if ( $custom_excerpt ) {
                                echo '<div class="news-blog-excerpt">' . wp_kses_post( $custom_excerpt ) . '</div>';
                            } else {
                                echo '<div class="news-blog-excerpt">' . wp_kses_post( wp_trim_words( get_the_excerpt(), 18, '...' ) ) . '</div>';
                            }
                            
                            // Get custom read more text from metabox or use default
                            $read_more_text = get_post_meta( get_the_ID(), '_news_card_readmore', true );
                            if ( ! $read_more_text ) {
                                $read_more_text = __( 'Read More', 'jobscout' );
                            }
                            ?>
                            <a class="news-blog-readmore" href="<?php the_permalink(); ?>"><?php echo esc_html( $read_more_text ); ?></a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php
    // Restore original post
    $post = $original_post;
    wp_reset_postdata();
endif;
