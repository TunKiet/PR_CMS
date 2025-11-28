<?php
/**
 * Template Name: News Page
 * Description: Custom template for News page with blog entries grid
 *
 * @package JobScout
 */

get_header(); ?>

<div id="primary" class="content-area">
    
    <?php 
    /**
     * Before Posts hook
    */
    do_action( 'jobscout_before_posts_content' );
    ?>
    
    <main id="main" class="site-main news-page-main">

        <?php
        // Display page banner with title
        if ( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/news', 'banner' );
            rewind_posts();
        }
        
        // Display news grid
        get_template_part( 'template-parts/news', 'grid' );
        ?>

    </main><!-- #main -->
    
</div><!-- #primary -->

<?php
get_footer();
