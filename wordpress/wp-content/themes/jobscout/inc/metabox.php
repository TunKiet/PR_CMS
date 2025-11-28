<?php 
/**
* JobScout Metabox for Sidebar Layout
*
* @package JobScout
*
*/ 

function jobscout_add_sidebar_layout_box(){
    $post_id   = isset( $_GET['post'] ) ? $_GET['post'] : '';
    $shop_id   = get_option( 'woocommerce_shop_page_id' );
    $template  = get_post_meta( $post_id, '_wp_page_template', true );
    $templates = array( 'templates/portfolio.php' );
    
    /**
     * Remove sidebar metabox in specific page template.
    */
    if( ! in_array( $template, $templates ) && ( $shop_id != $post_id ) ){
        add_meta_box( 
            'jobscout_sidebar_layout',
            __( 'Sidebar Layout', 'jobscout' ),
            'jobscout_sidebar_layout_callback', 
            'page',
            'normal',
            'high'
        );
    }

    //for post
    add_meta_box( 
        'jobscout_sidebar_layout',
        __( 'Sidebar Layout', 'jobscout' ),
        'jobscout_sidebar_layout_callback', 
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jobscout_add_sidebar_layout_box' );

$jobscout_sidebar_layout = array(    
    'default-sidebar'=> array(
         'value'     => 'default-sidebar',
         'label'     => __( 'Default Sidebar', 'jobscout' ),
         'thumbnail' => get_template_directory_uri() . '/images/default-sidebar.png'
    ),
    'no-sidebar'     => array(
         'value'     => 'no-sidebar',
         'label'     => __( 'Full Width', 'jobscout' ),
         'thumbnail' => get_template_directory_uri() . '/images/full-width.png'
    ),
    'left-sidebar' => array(
         'value'     => 'left-sidebar',
         'label'     => __( 'Left Sidebar', 'jobscout' ),
         'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'         
    ),
    'right-sidebar' => array(
         'value'     => 'right-sidebar',
         'label'     => __( 'Right Sidebar', 'jobscout' ),
         'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'         
     )    
);

function jobscout_sidebar_layout_callback(){
    global $post , $jobscout_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'jobscout_nonce' ); ?>
    <table class="form-table">
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'jobscout' ); ?></em></td>
        </tr>    
        <tr>
            <td>
                <?php  
                    foreach( $jobscout_sidebar_layout as $field ){  
                        $layout = get_post_meta( $post->ID, '_jobscout_sidebar_layout', true ); ?>
                        <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                            <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="jobscout_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) ){ checked( $field['value'], 'default-sidebar' ); }?>/>
                            <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
                            </label>
                        </div>
                        <?php 
                    } // end foreach 
                ?>
                <div class="clear"></div>
            </td>
        </tr>  
    </table>
 <?php 
}

function jobscout_save_sidebar_layout( $post_id ){
    global $jobscout_sidebar_layout;

    // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'jobscout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'jobscout_nonce' ], basename( __FILE__ ) ) )
        return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;

    if('page' == $_POST['post_type'] ){  
        if( ! current_user_can( 'edit_page', $post_id ) ) return $post_id;  
    }elseif( ! current_user_can( 'edit_post', $post_id ) ){  
        return $post_id;  
    }
    
    $layout = isset( $_POST['jobscout_sidebar_layout'] ) ? sanitize_key( $_POST['jobscout_sidebar_layout'] ) : 'default-sidebar';

    if( array_key_exists( $layout, $jobscout_sidebar_layout ) ){
        update_post_meta( $post_id, '_jobscout_sidebar_layout', $layout );
    }else{
        delete_post_meta( $post_id, '_jobscout_sidebar_layout' );
    }           
}
add_action( 'save_post' , 'jobscout_save_sidebar_layout' );

/**
 * Contact banner meta box registration.
 *
 * Adds controls only when editing the Contact Page template.
 *
 * @param WP_Post $post Current post object.
 */
function jobscout_add_contact_banner_box( $post ) {
	if ( empty( $post ) || 'page' !== $post->post_type ) {
		return;
	}

	$template = get_page_template_slug( $post->ID );
	if ( 'page-contact.php' !== $template ) {
		return;
	}

	add_meta_box(
		'jobscout_contact_banner',
		__( 'Contact Banner', 'jobscout' ),
		'jobscout_contact_banner_box_callback',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes_page', 'jobscout_add_contact_banner_box' );

/**
 * Render contact banner controls.
 *
 * @param WP_Post $post Current post object.
 */
function jobscout_contact_banner_box_callback( $post ) {
	wp_nonce_field( 'jobscout_contact_banner_nonce', 'jobscout_contact_banner_nonce' );

	$banner_title = get_post_meta( $post->ID, 'contact_banner_title', true );
	$banner_image = get_post_meta( $post->ID, 'contact_banner_image', true );
	$banner_image_url = '';

	if ( $banner_image ) {
		$banner_image_url = wp_get_attachment_image_url( absint( $banner_image ), 'large' );
	}
	?>
	<div class="jobscout-contact-banner-fields">
		<p>
			<label class="jobscout-contact-banner-label" for="jobscout_contact_banner_title">
				<?php esc_html_e( 'Banner title', 'jobscout' ); ?>
			</label>
			<input type="text" class="widefat" id="jobscout_contact_banner_title" name="jobscout_contact_banner_title" value="<?php echo esc_attr( $banner_title ); ?>" placeholder="<?php esc_attr_e( 'Defaults to the page title.', 'jobscout' ); ?>">
		</p>

		<div class="jobscout-contact-banner-image-field" data-title="<?php esc_attr_e( 'Select banner image', 'jobscout' ); ?>" data-button="<?php esc_attr_e( 'Use this image', 'jobscout' ); ?>">
			<p class="jobscout-contact-banner-label">
				<?php esc_html_e( 'Banner background image', 'jobscout' ); ?>
			</p>
			<div class="jobscout-contact-banner-preview <?php echo $banner_image_url ? '' : 'jobscout-hidden'; ?>">
				<?php if ( $banner_image_url ) : ?>
					<img src="<?php echo esc_url( $banner_image_url ); ?>" alt="">
				<?php endif; ?>
			</div>
			<input type="hidden" id="jobscout_contact_banner_image" name="jobscout_contact_banner_image" value="<?php echo esc_attr( $banner_image ); ?>">
			<button type="button" class="button jobscout-contact-banner-upload">
				<?php esc_html_e( 'Select image', 'jobscout' ); ?>
			</button>
			<button type="button" class="button jobscout-contact-banner-remove <?php echo $banner_image_url ? '' : 'jobscout-hidden'; ?>">
				<?php esc_html_e( 'Remove image', 'jobscout' ); ?>
			</button>
			<p class="description">
				<?php esc_html_e( 'If no image is selected, the featured image or the theme default banner will be used.', 'jobscout' ); ?>
			</p>
		</div>
	</div>
	<?php
}

/**
 * Save banner metadata for the contact page.
 *
 * @param int $post_id Post ID.
 */
function jobscout_save_contact_banner_meta( $post_id ) {
	if ( ! isset( $_POST['jobscout_contact_banner_nonce'] ) || ! wp_verify_nonce( $_POST['jobscout_contact_banner_nonce'], 'jobscout_contact_banner_nonce' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		return;
	}

	$template = get_page_template_slug( $post_id );
	if ( 'page-contact.php' !== $template ) {
		return;
	}

	$title = isset( $_POST['jobscout_contact_banner_title'] ) ? sanitize_text_field( wp_unslash( $_POST['jobscout_contact_banner_title'] ) ) : '';
	$image = isset( $_POST['jobscout_contact_banner_image'] ) ? absint( $_POST['jobscout_contact_banner_image'] ) : 0;

	if ( $title ) {
		update_post_meta( $post_id, 'contact_banner_title', $title );
	} else {
		delete_post_meta( $post_id, 'contact_banner_title' );
	}

	if ( $image ) {
		update_post_meta( $post_id, 'contact_banner_image', $image );
	} else {
		delete_post_meta( $post_id, 'contact_banner_image' );
	}
}
add_action( 'save_post_page', 'jobscout_save_contact_banner_meta' );