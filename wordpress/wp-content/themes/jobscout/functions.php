<?php
// Chỉ load CSS custom cho trang Jobs (page_id=10)
add_action('wp_enqueue_scripts', function() {
	if (is_page(10)) {
		wp_enqueue_style('jobs-page-10', get_template_directory_uri() . '/css/jobs-page-10.css', [], null);
	}
});
require get_template_directory() . '/inc/custom-jobs-banner.php';
/**
 * JobScout functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package JobScout
 */

$jobscout_theme_data = wp_get_theme();
if( ! defined( 'JOBSCOUT_THEME_VERSION' ) ) define ( 'JOBSCOUT_THEME_VERSION', $jobscout_theme_data->get( 'Version' ) );
if( ! defined( 'JOBSCOUT_THEME_NAME' ) ) define( 'JOBSCOUT_THEME_NAME', $jobscout_theme_data->get( 'Name' ) );

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';

/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Standalone Functions.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/partials.php';

if( jobscout_is_rara_theme_companion_activated() ) :
	/**
	 * Modify filter hooks of RTC plugin.
	 */
	require get_template_directory() . '/inc/rtc-filters.php';
endif;

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * About Page Metabox
 */
require get_template_directory() . '/inc/about-page-metabox.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/dashboard/dashboard.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Add theme compatibility function for woocommerce if active
*/
if( jobscout_is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}

/**
 * Modify filter hooks of WP Job Manager plugin.
 */
if( jobscout_is_wp_job_manager_activated() ) :
	require get_template_directory() . '/inc/wp-job-manager-filters.php';
endif;
// Thêm cài đặt vào Customizer (Giao diện > Tùy biến)
// Lấy danh sách địa điểm từ Job Listings trong database
function jobscout_get_all_job_locations() {
	global $wpdb;

	$locations = $wpdb->get_col( $wpdb->prepare(
		"
		SELECT DISTINCT pm.meta_value
		FROM {$wpdb->postmeta} pm
		INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
		WHERE pm.meta_key = %s
		  AND pm.meta_value <> ''
		  AND p.post_type = %s
		  AND p.post_status = 'publish'
		",
		'_job_location',
		'job_listing'
	) );

	return $locations;
}

function jobscout_custom_search_settings($wp_customize) {
	// 1. Tạo section mới tên "Cấu hình Tìm kiếm"
	$wp_customize->add_section('jobscout_search_config', array(
		'title'    => __('Cấu hình Tìm kiếm Việc làm', 'jobscout'),
		'priority' => 30,
	));

	// Lấy danh sách địa điểm từ Job Listings
	$locations = jobscout_get_all_job_locations();
	$choices   = array();
	if ( ! empty( $locations ) ) {
		foreach ( $locations as $loc ) {
			$choices[ $loc ] = $loc;
		}
	}

	// 2. Tạo setting lưu dữ liệu
	$wp_customize->add_setting('jobscout_hidden_locations', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	// 3. Tạo ô chọn (select) lấy dữ liệu từ Job Listings
	$wp_customize->add_control('jobscout_hidden_locations', array(
		'label'       => __('Các địa điểm cần ẩn', 'jobscout'),
		'description' => __('Chọn địa điểm cần ẩn khỏi kết quả tìm kiếm. Danh sách lấy từ Job Listings.', 'jobscout'),
		'section'     => 'jobscout_search_config',
		'type'        => 'select',
		'choices'     => $choices,
	));
}
add_action('customize_register', 'jobscout_custom_search_settings');

// Chặn sử dụng location chứa "USA" trong tìm kiếm Job Manager
function jobscout_block_usa_in_job_search_args( $args ) {
	if ( ! empty( $args['search_location'] ) && stripos( $args['search_location'], 'usa' ) !== false ) {
		// Nếu location có chứa "usa" thì bỏ điều kiện location
		$args['search_location'] = '';
	}

	return $args;
}
add_filter( 'job_manager_get_listings_args', 'jobscout_block_usa_in_job_search_args' );

// Chặn lưu location chứa "USA" khi tạo/cập nhật Job Listing trong admin
function jobscout_block_usa_in_job_location_save( $post_id, $post, $update ) {
	// Đảm bảo đúng post type
	if ( $post->post_type !== 'job_listing' ) {
		return;
	}

	if ( isset( $_POST['_job_location'] ) ) {
		$location = wp_unslash( $_POST['_job_location'] );
		if ( stripos( $location, 'usa' ) !== false ) {
			// Không lưu location chứa "usa"
			update_post_meta( $post_id, '_job_location', '' );
		}
	}
}
add_action( 'save_post', 'jobscout_block_usa_in_job_location_save', 10, 3 );