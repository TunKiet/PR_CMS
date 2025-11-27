<?php
/**
 * Template Name: Contact Page
 * The template for displaying the contact page
 *
 * @package JobScout
 */
get_header(); ?>

    <!-- Contact Hero Banner -->
    <div class="contact-hero-banner">
        <div class="contact-hero-overlay"></div>
        <div class="contact-hero-content">
            <h1 class="contact-hero-title">CONTACT US</h1>
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

<!-- Newsletter Subscription - Below contact info, before footer, full width -->
<div class="contact-newsletter">
    <div class="newsletter-content">
        <h3 class="newsletter-title">Subscribe To Our Newsletter</h3>
        <form class="newsletter-form">
            <div class="newsletter-input-wrapper">
                <input type="email" class="newsletter-input" placeholder="Input your email address" required>
                <span class="newsletter-icon">✉</span>
            </div>
            <button type="submit" class="newsletter-submit">SUBSCRIBE</button>
        </form>
    </div>
</div>

<!-- Simple Footer for Contact Page -->
<footer class="contact-page-footer">
    <div class="contact-footer-inner">
        <!-- Navigation Links -->
        <nav class="contact-footer-nav">
            <a href="#">JOBS</a>
            <a href="#">COMPANIES</a>
            <a href="#">BLOG</a>
            <a href="#">ABOUT</a>
            <a href="#">CONTACT</a>
        </nav>
        
        <!-- Social Media Icons -->
        <div class="contact-footer-social">
            <a href="#" class="social-icon facebook" aria-label="Facebook">f</a>
            <a href="#" class="social-icon google" aria-label="Google">G</a>
            <a href="#" class="social-icon line" aria-label="Line">L</a>
            <a href="#" class="social-icon twitter" aria-label="Twitter">t</a>
        </div>
    </div>
</footer>

<?php
// Hide sidebar on contact page - don't call get_sidebar()
wp_footer(); ?>
</body>
</html>
