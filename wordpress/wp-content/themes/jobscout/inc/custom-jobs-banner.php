<?php
// Customizer section for Jobs page banner
add_action('customize_register', function($wp_customize) {
    $wp_customize->add_section('jobs_banner_section', array(
        'title'    => __('Jobs Page Banner', 'jobscout'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('jobs_banner_image', array(
        'default'   => '',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'jobs_banner_image', array(
        'label'    => __('Banner Image', 'jobscout'),
        'section'  => 'jobs_banner_section',
        'settings' => 'jobs_banner_image',
    )));
});

function get_jobs_banner_url() {
    $url = get_theme_mod('jobs_banner_image');
    if ($url) return esc_url($url);
    return 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=1500&q=80';
}
