<?php
/**
 * JobScout child theme functions and definitions
 *
 * @package JobScout
 */

function jobscout_child_enqueue_styles() {
    // 1. Gọi CSS của Theme Cha (JobScout)
    wp_enqueue_style( 'jobscout-style', get_template_directory_uri() . '/style.css' );

    // 2. Gọi CSS của Theme Con (jobscout-child)
    wp_enqueue_style( 'jobscout-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'jobscout-style' ), // Đảm bảo theme con load sau theme cha
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'jobscout_child_enqueue_styles' );
?>