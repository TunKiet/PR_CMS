<?php
/**
 * Custom Footer for About Page
 *
 * @package JobScout
 */
?>

<style>
/* Custom Footer Styles */
body.page-template-page-about {
    margin: 0 !important;
    padding: 0 !important;
}

.about-custom-footer {
    background: #f5f5f5;
    color: #000000;
    padding: 80px 0 0;
    margin: 0;
}

.about-footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.about-footer-logo {
    text-align: center;
    margin-bottom: 50px;
}

.about-footer-logo a {
    color: #000000;
    text-decoration: none;
    font-size: 36px;
    font-weight: 700;
    letter-spacing: 4px;
    font-family: "Nunito Sans", sans-serif;
}

.about-footer-nav {
    text-align: center;
    margin-bottom: 50px;
}

.about-footer-menu {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 60px;
    flex-wrap: wrap;
}

.about-footer-menu li {
    margin: 0;
}

.about-footer-menu a {
    color: #000000;
    text-decoration: none;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    transition: color 0.3s;
    font-weight: 700;
    font-family: "Nunito Sans", sans-serif;
}

.about-footer-menu a:hover {
    color: #ff6b35;
}

.about-footer-social {
    text-align: center;
    margin-bottom: 50px;
}

.about-social-icons {
    display: flex;
    justify-content: center;
    gap: 30px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.about-social-icons li {
    margin: 0;
}

.about-social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: #1877f2;
    color: #ffffff;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s;
    font-size: 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.about-social-icons a svg {
    fill: #ffffff;
}

/* Facebook - Blue */
.about-social-icons li:nth-child(1) a {
    background: #1877f2;
}

/* Google - Red/Multi-color */
.about-social-icons li:nth-child(2) a {
    background: #ea4335;
}

/* Line - Green */
.about-social-icons li:nth-child(3) a {
    background: #00b900;
}

/* Twitter - Blue */
.about-social-icons li:nth-child(4) a {
    background: #1da1f2;
}

.about-social-icons a:hover {
    transform: translateY(-4px) scale(1.1);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
    opacity: 0.9;
}

.about-footer-copyright {
    text-align: center;
    padding: 25px 0;
    background: #2c2c2c;
    font-size: 13px;
    color: #ffffff;
    margin: 40px 0 0 0;
    width: 100%;
    font-family: "Nunito Sans", sans-serif;
}

.about-footer-copyright p {
    margin: 0;
    color: #ffffff;
}

/* Social Icons SVG/Font Awesome fallback */
.social-icon-facebook::before { content: 'f'; font-family: Arial; }
.social-icon-google::before { content: 'G'; font-family: Arial; }
.social-icon-line::before { content: 'L'; font-family: Arial; }
.social-icon-twitter::before { content: 't'; font-family: Arial; }

/* Hide default theme footer */
body.page-template-page-about .site-footer,
body.page-template-page-about #colophon {
    display: none !important;
}

/* Responsive */
@media (max-width: 768px) {
    .about-footer-menu {
        flex-direction: column;
        gap: 15px;
    }
    
    .about-social-icons {
        gap: 15px;
    }
}
</style>

<footer class="about-custom-footer">
    <div class="about-footer-container">
        <div class="about-footer-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php 
                if ( has_custom_logo() ) {
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    if ( has_custom_logo() ) {
                        echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                    } else {
                        bloginfo( 'name' );
                    }
                } else {
                    bloginfo( 'name' ); 
                }
                ?>
            </a>
        </div>
        
        <nav class="about-footer-nav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'secondary',
                'menu_class'     => 'about-footer-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>
        
        <div class="about-footer-social">
            <ul class="about-social-icons">
                <li>
                    <a href="https://facebook.com" target="_blank" rel="noopener" title="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://google.com" target="_blank" rel="noopener" title="Google">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://line.me" target="_blank" rel="noopener" title="Line">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com" target="_blank" rel="noopener" title="Twitter">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="about-footer-copyright">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
