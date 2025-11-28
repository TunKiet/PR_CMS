<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('news-item'); ?>>
    <div class="news-thumb">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium'); ?>
        </a>
    </div>

    <div class="news-content">
        <h2 class="news-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <p class="news-excerpt"><?php the_excerpt(); ?></p>
    </div>
</article>
<!-- #post-<?php the_ID(); ?> -->