<?php
/**
 * News Page Customizer Settings
 *
 * @package JobScout
 */

if ( ! function_exists( 'jobscout_customize_register_news_page' ) ) :

function jobscout_customize_register_news_page( $wp_customize ) {

    /** News Page Section */
    $wp_customize->add_section(
        'news_page_settings',
        array(
            'title'    => __( 'News Page Settings', 'jobscout' ),
            'priority' => 40,
            'panel'    => 'frontpage_settings',
        )
    );

    /** News Hero Title */
    $wp_customize->add_setting(
        'news_hero_title',
        array(
            'default'           => __( 'PDS NEWS', 'jobscout' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'news_hero_title',
        array(
            'section' => 'news_page_settings',
            'label'   => __( 'Hero Banner Title', 'jobscout' ),
            'type'    => 'text',
        )
    );

    /** News Section Title */
    $wp_customize->add_setting(
        'news_section_title',
        array(
            'default'           => __( 'NEWEST BLOG ENTRIES', 'jobscout' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'news_section_title',
        array(
            'section' => 'news_page_settings',
            'label'   => __( 'Blog Section Title', 'jobscout' ),
            'type'    => 'text',
        )
    );

}
endif;
add_action( 'customize_register', 'jobscout_customize_register_news_page' );
