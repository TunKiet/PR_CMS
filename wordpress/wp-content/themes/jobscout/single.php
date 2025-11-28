<?php
/**
 * The template for displaying all single posts - News Detail
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package JobScout
 */

get_header(); ?>

<div class="single-post-wrapper">
    <div class="container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', 'single' );
                endwhile;
                ?>
            </main>
        </div><!-- #primary -->
    </div><!-- .container -->
</div><!-- .single-post-wrapper -->

<?php get_footer(); ?>
