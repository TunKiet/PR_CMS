<?php
/**
 * Template part for displaying News page banner
 *
 * @package JobScout
 */

// Get custom banner image from metabox or use default
$banner_image = get_post_meta( get_the_ID(), '_news_banner_image', true );
if ( ! $banner_image ) {
    $banner_image = get_header_image();
}

// Get custom banner title from metabox or use page title
$banner_title = get_post_meta( get_the_ID(), '_news_banner_title', true );
if ( ! $banner_title ) {
    $banner_title = get_the_title();
}
?>

<div class="news-page-banner" style="background-image: url(<?php echo esc_url( $banner_image ); ?>);">
    <div class="news-banner-overlay">
        <div class="container">
            <h1 class="news-banner-title"><?php echo esc_html( $banner_title ); ?></h1>
        </div>
    </div>
</div>
