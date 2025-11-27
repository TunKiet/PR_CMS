<?php
/**
 * Custom Header for About Page
 *
 * @package JobScout
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/about-page.css">
    <?php wp_head(); ?>
    <style>
        /* Reset default theme styles for about page */
        body.page-template-page-about {
            margin: 0;
            padding: 0;
            font-family: "Nunito Sans", sans-serif;
        }
        
        /* Custom Header Styles */
        .about-custom-header {
            background: #ffffff;
            padding: 25px 0;
            position: relative;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .about-header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .about-logo {
            flex: 0 0 auto;
        }
        
        .about-logo a {
            color: #000000;
            text-decoration: none;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
            font-family: "Nunito Sans", sans-serif;
        }
        
        .about-navigation {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            margin-right: 50px;
        }
        
        .about-nav-menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 45px;
            align-items: center;
        }
        
        .about-nav-menu li {
            margin: 0;
            position: relative;
        }
        
        .about-nav-menu a {
            color: #000000;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            padding-bottom: 8px;
            display: inline-block;
            font-family: "Nunito Sans", sans-serif;
        }
        
        .about-nav-menu a:hover {
            color: #ff6b35;
        }
        
        .about-nav-menu a.active,
        .about-nav-menu .current-menu-item > a,
        .about-nav-menu .current_page_item > a,
        .about-nav-menu .current-page-ancestor > a {
            border-bottom: 5px solid #ff6b35 !important;
        }
        
        .about-submit-job {
            flex: 0 0 auto;
        }
        
        .about-submit-job a {
            background: #ff6b35;
            color: #ffffff;
            padding: 12px 30px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 4px;
            transition: all 0.3s;
            letter-spacing: 0.5px;
            font-family: "Nunito Sans", sans-serif;
        }
        
        .about-submit-job a:hover {
            background: #ff8c42;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 107, 53, 0.3);
        }
        
        /* Mobile Menu Toggle */
        .about-mobile-toggle {
            display: none;
            background: transparent;
            border: none;
            color: #000000;
            font-size: 24px;
            cursor: pointer;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .about-header-container {
                flex-wrap: wrap;
            }
            
            .about-mobile-toggle {
                display: block;
                order: 3;
            }
            
            .about-navigation {
                order: 4;
                width: 100%;
                display: none;
                margin-top: 20px;
            }
            
            .about-navigation.active {
                display: block;
            }
            
            .about-nav-menu {
                flex-direction: column;
                gap: 15px;
            }
            
            .about-submit-job {
                order: 2;
            }
        }
        
        /* Hide default theme header */
        body.page-template-page-about .site-header,
        body.page-template-page-about #masthead,
        body.page-template-page-about .breadcrumb-wrapper {
            display: none !important;
        }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="about-custom-header">
    <div class="about-header-container">
        <div class="about-logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php 
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    bloginfo( 'name' ); 
                }
                ?>
            </a>
        </div>
        
        <nav class="about-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'about-nav-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>
        
        <div class="about-submit-job">
            <a href="<?php echo esc_url( home_url( '/submit-job' ) ); ?>">SUBMIT JOB</a>
        </div>
        
        <button class="about-mobile-toggle" onclick="this.nextElementSibling.classList.toggle('active')">☰</button>
    </div>
</header>
