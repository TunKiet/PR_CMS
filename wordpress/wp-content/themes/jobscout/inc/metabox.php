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
 * News Page Metabox
 */
function jobscout_add_news_page_metabox() {
    add_meta_box(
        'jobscout_news_page_settings',
        __( 'News Page Settings', 'jobscout' ),
        'jobscout_news_page_metabox_callback',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jobscout_add_news_page_metabox' );

function jobscout_news_page_metabox_callback( $post ) {
    wp_nonce_field( 'jobscout_news_page_nonce', 'jobscout_news_page_nonce_field' );
    
    // Get current values
    $banner_image = get_post_meta( $post->ID, '_news_banner_image', true );
    $banner_title = get_post_meta( $post->ID, '_news_banner_title', true );
    $section_title = get_post_meta( $post->ID, '_news_section_title', true );
    $posts_count = get_post_meta( $post->ID, '_news_posts_count', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="news_banner_image"><?php _e( 'Banner Image URL', 'jobscout' ); ?></label></th>
            <td>
                <input type="text" id="news_banner_image" name="news_banner_image" value="<?php echo esc_attr( $banner_image ); ?>" class="widefat" />
                <p class="description"><?php _e( 'Enter banner image URL (leave empty to use default header image)', 'jobscout' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="news_banner_title"><?php _e( 'Banner Title', 'jobscout' ); ?></label></th>
            <td>
                <input type="text" id="news_banner_title" name="news_banner_title" value="<?php echo esc_attr( $banner_title ); ?>" class="widefat" />
                <p class="description"><?php _e( 'Enter banner title (leave empty to use page title)', 'jobscout' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="news_section_title"><?php _e( 'Section Title', 'jobscout' ); ?></label></th>
            <td>
                <input type="text" id="news_section_title" name="news_section_title" value="<?php echo esc_attr( $section_title ); ?>" class="widefat" />
                <p class="description"><?php _e( 'Enter section title (default: NEWEST BLOG ENTRIES)', 'jobscout' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="news_posts_count"><?php _e( 'Number of Posts', 'jobscout' ); ?></label></th>
            <td>
                <input type="number" id="news_posts_count" name="news_posts_count" value="<?php echo esc_attr( $posts_count ? $posts_count : 8 ); ?>" min="1" max="50" />
                <p class="description"><?php _e( 'Number of blog posts to display (default: 8)', 'jobscout' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

function jobscout_save_news_page_metabox( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['jobscout_news_page_nonce_field'] ) || ! wp_verify_nonce( $_POST['jobscout_news_page_nonce_field'], 'jobscout_news_page_nonce' ) ) {
        return;
    }
    
    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    // Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    }
    
    // Save fields
    if ( isset( $_POST['news_banner_image'] ) ) {
        update_post_meta( $post_id, '_news_banner_image', esc_url_raw( $_POST['news_banner_image'] ) );
    }
    
    if ( isset( $_POST['news_banner_title'] ) ) {
        update_post_meta( $post_id, '_news_banner_title', sanitize_text_field( $_POST['news_banner_title'] ) );
    }
    
    if ( isset( $_POST['news_section_title'] ) ) {
        update_post_meta( $post_id, '_news_section_title', sanitize_text_field( $_POST['news_section_title'] ) );
    }
    
    if ( isset( $_POST['news_posts_count'] ) ) {
        update_post_meta( $post_id, '_news_posts_count', absint( $_POST['news_posts_count'] ) );
    }
}
add_action( 'save_post', 'jobscout_save_news_page_metabox' );

/**
 * Post Metabox for News Card Custom Fields
 */
function jobscout_add_news_card_metabox() {
    add_meta_box(
        'jobscout_news_card_settings',
        __( 'News Card Display Settings', 'jobscout' ),
        'jobscout_news_card_metabox_callback',
        'post',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'jobscout_add_news_card_metabox' );

function jobscout_news_card_metabox_callback( $post ) {
    wp_nonce_field( 'jobscout_news_card_nonce', 'jobscout_news_card_nonce_field' );
    
    // Get current values
    $card_title = get_post_meta( $post->ID, '_news_card_title', true );
    $card_excerpt = get_post_meta( $post->ID, '_news_card_excerpt', true );
    $card_readmore = get_post_meta( $post->ID, '_news_card_readmore', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="news_card_title"><?php _e( 'Custom Card Title', 'jobscout' ); ?></label></th>
            <td>
                <input type="text" id="news_card_title" name="news_card_title" value="<?php echo esc_attr( $card_title ); ?>" class="widefat" />
                <p class="description"><?php _e( 'Custom title for news card (leave empty to use post title)', 'jobscout' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="news_card_excerpt"><?php _e( 'Custom Card Excerpt', 'jobscout' ); ?></label></th>
            <td>
                <textarea id="news_card_excerpt" name="news_card_excerpt" rows="3" class="widefat"><?php echo esc_textarea( $card_excerpt ); ?></textarea>
                <p class="description"><?php _e( 'Custom excerpt for news card (leave empty to use auto-generated excerpt)', 'jobscout' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="news_card_readmore"><?php _e( 'Custom Read More Text', 'jobscout' ); ?></label></th>
            <td>
                <input type="text" id="news_card_readmore" name="news_card_readmore" value="<?php echo esc_attr( $card_readmore ); ?>" class="widefat" />
                <p class="description"><?php _e( 'Custom read more button text (default: Read More)', 'jobscout' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

function jobscout_save_news_card_metabox( $post_id ) {
    // Check nonce
    if ( ! isset( $_POST['jobscout_news_card_nonce_field'] ) || ! wp_verify_nonce( $_POST['jobscout_news_card_nonce_field'], 'jobscout_news_card_nonce' ) ) {
        return;
    }
    
    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    // Check permissions
    if ( 'post' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    
    // Save fields
    if ( isset( $_POST['news_card_title'] ) ) {
        update_post_meta( $post_id, '_news_card_title', sanitize_text_field( $_POST['news_card_title'] ) );
    }
    
    if ( isset( $_POST['news_card_excerpt'] ) ) {
        update_post_meta( $post_id, '_news_card_excerpt', wp_kses_post( $_POST['news_card_excerpt'] ) );
    }
    
    if ( isset( $_POST['news_card_readmore'] ) ) {
        update_post_meta( $post_id, '_news_card_readmore', sanitize_text_field( $_POST['news_card_readmore'] ) );
    }
}
add_action( 'save_post', 'jobscout_save_news_card_metabox' );