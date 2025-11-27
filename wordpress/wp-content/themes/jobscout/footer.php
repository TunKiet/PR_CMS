<?php
/**
 * Custom footer layout for JobScout.
 * Newsletter bar + simple footer as per design.
 *
 * @package JobScout
 */

    /**
     * After Content
     * 
     * @hooked jobscout_content_end - 20
    */
    do_action( 'jobscout_before_footer' );
    
    /**
     * Footer
     * 
     * @hooked jobscout_footer_start  - 20
     * @hooked jobscout_footer_top    - 30
     * @hooked jobscout_footer_bottom - 40
     * @hooked jobscout_footer_end    - 50
    */
    do_action( 'jobscout_footer' );
    
    /**
     * After Footer
     * 
     * @hooked jobscout_page_end    - 20
    */
    do_action( 'jobscout_after_footer' );

    // Global newsletter bar (orange strip above footer)
    ?>
    <div class="contact-newsletter global-newsletter">
        <div class="newsletter-content">
            <h3 class="newsletter-title"><?php esc_html_e( 'Subscribe To Our Newsletter', 'jobscout' ); ?></h3>
            <form class="newsletter-form" action="#" method="post">
                <div class="newsletter-input-wrapper">
                    <input type="email" class="newsletter-input" placeholder="<?php esc_attr_e( 'Input your email address', 'jobscout' ); ?>" required>
                    <span class="newsletter-icon">&#9993;</span>
                </div>
                <button type="submit" class="newsletter-submit"><?php esc_html_e( 'Subscribe', 'jobscout' ); ?></button>
            </form>
        </div>
    </div>

    <footer class="contact-page-footer global-footer">
        <div class="contact-footer-inner">
            <nav class="contact-footer-nav">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Jobs', 'jobscout' ); ?></a>
                <a href="#"><?php esc_html_e( 'Companies', 'jobscout' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'jobscout' ); ?></a>
                <a href="#"><?php esc_html_e( 'About', 'jobscout' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'jobscout' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/?s=' ) ); ?>"><?php esc_html_e( 'Search', 'jobscout' ); ?></a>
            </nav>

            <div class="contact-footer-social">
                <a href="#" class="social-icon facebook" aria-label="Facebook">f</a>
                <a href="#" class="social-icon google" aria-label="Google">G</a>
                <a href="#" class="social-icon line" aria-label="Line">L</a>
                <a href="#" class="social-icon twitter" aria-label="Twitter">t</a>
            </div>
        </div>
    </footer>
    <?php

    wp_footer();
?>

</body>
</html>
