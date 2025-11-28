<?php
/**
 * Template Name: About Page Template
 * 
 * Custom template for About page
 *
 * @package JobScout
 */

get_header('about'); ?>

<style>
/* Reset default theme styles */
body.page-template-page-about #primary,
body.page-template-page-about .content-area {
    margin: 0;
    padding: 0;
    max-width: 100%;
    width: 100%;
}

body.page-template-page-about #content {
    padding: 0;
    margin: 0;
}

body.page-template-page-about .site-main {
    margin: 0;
    padding: 0;
}

/* Hide sidebar on about page */
body.page-template-page-about #secondary,
body.page-template-page-about .widget-area {
    display: none !important;
}

/* About Page Custom Styles */
.about-page-wrapper {
    width: 100%;
    margin: 0;
    padding: 0;
}

/* Hero Section */
.about-hero {
    position: relative;
    height: 400px;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
}

.about-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
}

.about-hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    padding: 0 20px;
}

.about-hero h1 {
    font-size: 48px;
    font-weight: 700;
    margin: 0;
    line-height: 1.3;
    color: white;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

/* About Us Section */
.about-us-section {
    background: #f5f5f5;
    padding: 80px 0;
}

.about-us-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.about-us-title {
    text-align: center;
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 60px;
    color: #333;
    letter-spacing: 2px;
}

.about-us-content {
    display: flex;
    gap: 60px;
    align-items: flex-start;
}

.about-us-image {
    flex: 0 0 400px;
}

.about-us-image img {
    width: 100%;
    height: auto;
    display: block;
}

.about-us-text {
    flex: 1;
}

.about-item {
    margin-bottom: 30px;
}

.about-item h3 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #333;
}

.about-item p {
    font-size: 14px;
    line-height: 1.8;
    color: #666;
    margin: 0;
}

/* Services Section */
.services-section {
    background: white;
    padding: 60px 0;
    text-align: center;
}

.services-title {
    font-size: 24px;
    color: #ff8c42;
    margin-bottom: 30px;
    font-weight: 400;
}

.services-description {
    max-width: 900px;
    margin: 0 auto;
    font-size: 14px;
    line-height: 1.8;
    color: #666;
    padding: 0 20px;
}

/* Company Info Section */
.company-info-section {
    background: #f5f5f5;
    padding: 80px 0;
}

.company-info-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    gap: 60px;
    align-items: center;
}

.company-info-text {
    flex: 1;
}

.company-info-item {
    margin-bottom: 25px;
    text-align: center;
}

.company-info-label {
    font-size: 14px;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
}

.company-info-value {
    font-size: 14px;
    color: #666;
}

.company-info-image {
    flex: 0 0 400px;
}

.company-info-image img {
    width: 100%;
    height: auto;
    display: block;
}

/* Newsletter Section */
.newsletter-section {
    background: #ff8c42;
    padding: 40px 0;
}

.newsletter-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    align-items: center;
    gap: 40px;
}

.newsletter-title-wrapper {
    flex: 0 0 200px;
}

.newsletter-title {
    font-size: 24px;
    color: white;
    margin: 0;
    line-height: 1.3;
}

.newsletter-form {
    flex: 1;
    display: flex;
    gap: 15px;
    align-items: center;
}

.newsletter-input {
    flex: 1;
    padding: 12px 20px;
    border: none;
    font-size: 14px;
}

.newsletter-button {
    padding: 12px 40px;
    background: transparent;
    border: 2px solid white;
    color: white;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    text-transform: uppercase;
}

.newsletter-button:hover {
    background: white;
    color: #ff8c42;
}

/* Responsive */
@media (max-width: 768px) {
    .about-hero h1 {
        font-size: 32px;
    }
    
    .about-us-content,
    .company-info-container {
        flex-direction: column;
    }
    
    .about-us-image,
    .company-info-image {
        flex: 1;
        max-width: 100%;
    }
    
    .newsletter-container {
        flex-direction: column;
        text-align: center;
    }
    
    .newsletter-form {
        flex-direction: column;
        width: 100%;
    }
    
    .newsletter-input,
    .newsletter-button {
        width: 100%;
    }
}
</style>

<div class="about-page-wrapper">
    <?php while ( have_posts() ) : the_post(); ?>
        
        <?php
        // Get custom fields
        $hero_image = get_post_meta(get_the_ID(), 'hero_image', true);
        $hero_title = get_post_meta(get_the_ID(), 'hero_title', true);
        $about_image = get_post_meta(get_the_ID(), 'about_image', true);
        $vision_text = get_post_meta(get_the_ID(), 'vision_text', true);
        $mission_title = get_post_meta(get_the_ID(), 'mission_title', true);
        $mission_text = get_post_meta(get_the_ID(), 'mission_text', true);
        $core_value_text = get_post_meta(get_the_ID(), 'core_value_text', true);
        $services_title = get_post_meta(get_the_ID(), 'services_title', true);
        $services_description = get_post_meta(get_the_ID(), 'services_description', true);
        $established_year = get_post_meta(get_the_ID(), 'established_year', true);
        $head_office = get_post_meta(get_the_ID(), 'head_office', true);
        $capital = get_post_meta(get_the_ID(), 'capital', true);
        $ceo = get_post_meta(get_the_ID(), 'ceo', true);
        $employees = get_post_meta(get_the_ID(), 'employees', true);
        $company_image = get_post_meta(get_the_ID(), 'company_image', true);
        $newsletter_title = get_post_meta(get_the_ID(), 'newsletter_title', true);
        $newsletter_placeholder = get_post_meta(get_the_ID(), 'newsletter_placeholder', true);
        $newsletter_button = get_post_meta(get_the_ID(), 'newsletter_button', true);
        ?>
        
        <!-- Hero Section -->
        <section class="about-hero" style="background-image: url('<?php echo esc_url($hero_image ? $hero_image : get_template_directory_uri() . '/images/default-hero.jpg'); ?>');">
            <div class="about-hero-content">
                <h1><?php echo esc_html($hero_title ? $hero_title : 'SHARE "OMOTENASHI" WITH THE WORLD'); ?></h1>
            </div>
        </section>

        <!-- About Us Section -->
        <section class="about-us-section">
            <div class="about-us-container">
                <h2 class="about-us-title">ABOUT US</h2>
                <div class="about-us-content">
                    <div class="about-us-image">
                        <img src="<?php echo esc_url($about_image ? $about_image : get_template_directory_uri() . '/images/default-about.jpg'); ?>" alt="About Us">
                    </div>
                    <div class="about-us-text">
                        <div class="about-item">
                            <h3>Our Vision</h3>
                            <p><?php echo esc_html($vision_text ? $vision_text : 'Create hotels and restaurants around the world that offer memorable experiences while building a lasting, positive relationship together with our guests, partners, team members and communities.'); ?></p>
                        </div>
                        <div class="about-item">
                            <h3><?php echo esc_html($mission_title ? $mission_title : 'Our Mission'); ?></h3>
                            <p><?php echo esc_html($mission_text ? $mission_text : 'Share "Omotenashi" with the world'); ?></p>
                        </div>
                        <div class="about-item">
                            <h3>Our Core Value</h3>
                            <p><?php echo esc_html($core_value_text ? $core_value_text : '"If I were the guest..."'); ?><br>
                            <?php echo esc_html('To provide guests with the hospitality you would want to receive as a guest.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="services-section">
            <div class="services-container">
                <h2 class="services-title"><?php echo esc_html($services_title ? $services_title : 'Hotels, restaurants, banquets/ weddings management'); ?></h2>
                <div class="services-description">
                    <p><?php echo esc_html($services_description ? $services_description : 'Plan Do See developed and operates 17 properties worldwide including hotels in Japan, 17 restaurants of diverse cuisines in cities including New York, Miami and Los Angeles, and other countries including Japan, Indonesia, Malaysia and Bali.'); ?></p>
                    <p><?php echo esc_html('Each venue carries its own concept and design. Many of them are originally historical landmarks that were loved by the local people.'); ?></p>
                </div>
            </div>
        </section>

        <!-- Company Info Section -->
        <section class="company-info-section">
            <div class="company-info-container">
                <div class="company-info-text">
                    <div class="company-info-item">
                        <div class="company-info-label">Established since</div>
                        <div class="company-info-value"><?php echo esc_html($established_year ? $established_year : 'April 1993'); ?></div>
                    </div>
                    <div class="company-info-item">
                        <div class="company-info-label">Head Office</div>
                        <div class="company-info-value"><?php echo esc_html($head_office ? $head_office : 'Marunouchi 2-1-1, Chiyoda, Tokyo'); ?></div>
                    </div>
                    <div class="company-info-item">
                        <div class="company-info-label">Capital</div>
                        <div class="company-info-value"><?php echo esc_html($capital ? $capital : '100,000,000 JPY'); ?></div>
                    </div>
                    <div class="company-info-item">
                        <div class="company-info-label">CEO</div>
                        <div class="company-info-value"><?php echo esc_html($ceo ? $ceo : 'Yutaka Noda'); ?></div>
                    </div>
                    <div class="company-info-item">
                        <div class="company-info-label">Number of Employees</div>
                        <div class="company-info-value"><?php echo esc_html($employees ? $employees : 'Full time: 890 / Temp: 1,600'); ?></div>
                    </div>
                </div>
                <div class="company-info-image">
                    <img src="<?php echo esc_url($company_image ? $company_image : get_template_directory_uri() . '/images/default-company.jpg'); ?>" alt="Company">
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="newsletter-section">
            <div class="newsletter-container">
                <div class="newsletter-title-wrapper">
                    <h3 class="newsletter-title"><?php echo wp_kses_post($newsletter_title ? nl2br($newsletter_title) : 'Subscribe To<br>Our Newsletter'); ?></h3>
                </div>
                <form class="newsletter-form" action="#" method="post">
                    <input type="email" class="newsletter-input" placeholder="<?php echo esc_attr($newsletter_placeholder ? $newsletter_placeholder : 'Enter your email address'); ?>" required>
                    <button type="submit" class="newsletter-button"><?php echo esc_html($newsletter_button ? $newsletter_button : 'SUBSCRIBE'); ?></button>
                </form>
            </div>
        </section>

    <?php endwhile; ?>
</div>

<?php get_footer('about'); ?>
