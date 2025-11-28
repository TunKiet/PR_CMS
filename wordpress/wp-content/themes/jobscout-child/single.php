<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package JobScout
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', 'single' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
        
        <?php
        /**
         * @hooked jobscout_navigation    - 10 
         * @hooked jobscout_author        - 20
         * @hooked jobscout_comment       - 30
        */
        do_action( 'jobscout_after_post_content' );
        ?>
        <div class="jobscout-related-posts-section">
            <h2 class="section-title">NEWEST BLOG ENTRIES</h2>
            <?php
            // Thiết lập tham số truy vấn: Lấy 3 bài viết mới nhất và loại trừ bài viết hiện tại
            $recent_posts_args = array(
                'posts_per_page' => 3, // Số lượng bài viết muốn hiển thị
                'post__not_in'   => array( get_the_ID() ), // Loại trừ bài viết đang xem
                'category__in'   => wp_get_post_categories( get_the_ID() ) // Lấy bài viết cùng chuyên mục (Giống Related Posts)
            );

            $recent_posts_query = new WP_Query( $recent_posts_args );

            if ( $recent_posts_query->have_posts() ) :
                echo '<div class="related-posts-wrapper grid-layout">';
                while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();
                    ?>
                    <article class="related-post-item">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <figure class="post-thumbnail">
                                    <?php the_post_thumbnail( 'jobscout-thumbnail-size' ); // Thay bằng kích thước ảnh phù hợp ?>
                                </figure>
                            <?php endif; ?>
                            <h3 class="post-title"><?php the_title(); ?></h3>
                        </a>
                        <div class="post-meta">
                            <span class="posted-on"><?php echo get_the_date(); ?></span>
                        </div>
                    </article>
                    <?php
                endwhile;
                echo '</div>';
                wp_reset_postdata(); // Rất quan trọng: Đặt lại dữ liệu truy vấn
            endif;
            ?>
        </div>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
