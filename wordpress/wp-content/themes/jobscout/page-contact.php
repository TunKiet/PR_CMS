<?php
/**
 * Template Name: Contact Page
 * The template for displaying the contact page
 *
 * @package JobScout
 */
get_header();

$contact_page_id = get_queried_object_id();

// Allow overriding the banner title via a custom field, else use the page title.
$contact_banner_title = get_post_meta( $contact_page_id, 'contact_banner_title', true );
if ( empty( $contact_banner_title ) ) {
	$contact_banner_title = get_the_title( $contact_page_id );
}
if ( empty( $contact_banner_title ) ) {
	$contact_banner_title = __( 'Contact Us', 'jobscout' );
}

// Let editors pick a custom banner image via a custom field or the Featured Image.
$contact_banner_image = get_post_meta( $contact_page_id, 'contact_banner_image', true );
if ( $contact_banner_image && is_numeric( $contact_banner_image ) ) {
	$contact_banner_image = wp_get_attachment_image_url( absint( $contact_banner_image ), 'full' );
}

if ( empty( $contact_banner_image ) && has_post_thumbnail( $contact_page_id ) ) {
	$contact_banner_image = get_the_post_thumbnail_url( $contact_page_id, 'full' );
}

if ( empty( $contact_banner_image ) ) {
	$contact_banner_image = get_template_directory_uri() . '/images/banner-image.jpg';
}
?>

    <!-- Contact Hero Banner -->
    <div class="contact-hero-banner" style="background-image: url('<?php echo esc_url( $contact_banner_image ); ?>');">
        <div class="contact-hero-overlay"></div>
        <div class="contact-hero-content">
            <h1 class="contact-hero-title"><?php echo esc_html( $contact_banner_title ); ?></h1>
        </div>
    </div>

<div id="primary" class="content-area contact-page-wrapper">
    <main id="main" class="site-main">
        <!-- Contact Page Content - Main Content Area with grey background -->
        <div class="contact-main-content">
            <div class="contact-main-inner">
                <!-- Headquarters Address -->
                <div class="contact-headquarters">
                    <h2 class="contact-section-title">Our Headquarters Address</h2>
                    <p class="contact-address">60 Nguyen Van Thu, Ward Đa Kao, District 1, Ho Chi Minh City, Viet Nam</p>
                </div>

                <!-- Contact Information Columns -->
                <div class="contact-info-columns">
                    <div class="contact-info-inner">
                        <!-- For Employers -->
                        <div class="contact-column contact-employers">
                            <h3 class="contact-column-title">For Employers</h3>
                            <p class="contact-subtitle">Call our Sales Hotline</p>
                            <div class="contact-phone-item">
                                <strong>Ho Chi Minh</strong>
                                <span class="contact-phone">+84 977 460 519</span>
                            </div>
                            <div class="contact-phone-item">
                                <strong>Ha Noi</strong>
                                <span class="contact-phone">+84 983 131 351</span>
                            </div>
                            <p class="contact-description">Request a call from one of our Customer Love Account Managers We're ready to help you grow!</p>
                        </div>

                        <!-- For Jobseekers -->
                        <div class="contact-column contact-jobseekers">
                            <h3 class="contact-column-title">For Jobseekers</h3>
                            <p class="contact-subtitle">Ask a question on our <a href="#" class="contact-link">Facebook</a> page</p>
                            <p class="contact-subtitle">Read our <a href="#" class="contact-link">blog posts</a> on interview and CV tips</p>
                            <p class="contact-subtitle">Call us at <span class="contact-phone">+84 28 6681 1397</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
// Hide sidebar on contact page - don't call get_sidebar(). Use global footer from footer.php.
get_footer();
