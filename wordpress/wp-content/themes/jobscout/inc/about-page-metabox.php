<?php
/**
 * About Page Meta Boxes
 * 
 * Add custom fields for About page template
 */

// Add meta boxes
function about_page_add_meta_boxes() {
    add_meta_box(
        'about_page_hero',
        'Hero Section',
        'about_page_hero_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'about_page_about_us',
        'About Us Section',
        'about_page_about_us_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'about_page_services',
        'Services Section',
        'about_page_services_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'about_page_company',
        'Company Information',
        'about_page_company_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'about_page_add_meta_boxes');

// Hero Section Callback
function about_page_hero_callback($post) {
    wp_nonce_field('about_page_meta_box', 'about_page_meta_box_nonce');
    
    $hero_image = get_post_meta($post->ID, 'hero_image', true);
    $hero_title = get_post_meta($post->ID, 'hero_title', true);
    ?>
    <p>
        <label for="hero_image">Hero Background Image URL:</label><br>
        <input type="text" id="hero_image" name="hero_image" value="<?php echo esc_attr($hero_image); ?>" style="width: 100%;">
        <button type="button" class="button upload-image-button">Upload Image</button>
    </p>
    <p>
        <label for="hero_title">Hero Title:</label><br>
        <input type="text" id="hero_title" name="hero_title" value="<?php echo esc_attr($hero_title); ?>" style="width: 100%;" placeholder='SHARE "OMOTENASHI" WITH THE WORLD'>
    </p>
    <?php
}

// About Us Section Callback
function about_page_about_us_callback($post) {
    $about_image = get_post_meta($post->ID, 'about_image', true);
    $vision_text = get_post_meta($post->ID, 'vision_text', true);
    $mission_title = get_post_meta($post->ID, 'mission_title', true);
    $mission_text = get_post_meta($post->ID, 'mission_text', true);
    $core_value_text = get_post_meta($post->ID, 'core_value_text', true);
    ?>
    <p>
        <label for="about_image">About Image URL:</label><br>
        <input type="text" id="about_image" name="about_image" value="<?php echo esc_attr($about_image); ?>" style="width: 100%;">
        <button type="button" class="button upload-image-button">Upload Image</button>
    </p>
    <p>
        <label for="vision_text">Our Vision Text:</label><br>
        <textarea id="vision_text" name="vision_text" rows="3" style="width: 100%;"><?php echo esc_textarea($vision_text); ?></textarea>
    </p>
    <p>
        <label for="mission_title">Our Mission Title:</label><br>
        <input type="text" id="mission_title" name="mission_title" value="<?php echo esc_attr($mission_title); ?>" style="width: 100%;" placeholder="Our Mission">
    </p>
    <p>
        <label for="mission_text">Our Mission Text:</label><br>
        <textarea id="mission_text" name="mission_text" rows="2" style="width: 100%;"><?php echo esc_textarea($mission_text); ?></textarea>
    </p>
    <p>
        <label for="core_value_text">Our Core Value Text:</label><br>
        <textarea id="core_value_text" name="core_value_text" rows="3" style="width: 100%;"><?php echo esc_textarea($core_value_text); ?></textarea>
    </p>
    <?php
}

// Services Section Callback
function about_page_services_callback($post) {
    $services_title = get_post_meta($post->ID, 'services_title', true);
    $services_description = get_post_meta($post->ID, 'services_description', true);
    ?>
    <p>
        <label for="services_title">Services Title:</label><br>
        <input type="text" id="services_title" name="services_title" value="<?php echo esc_attr($services_title); ?>" style="width: 100%;" placeholder="Hotels, restaurants, banquets/ weddings management">
    </p>
    <p>
        <label for="services_description">Services Description:</label><br>
        <textarea id="services_description" name="services_description" rows="5" style="width: 100%;"><?php echo esc_textarea($services_description); ?></textarea>
    </p>
    <?php
}

// Company Information Callback
function about_page_company_callback($post) {
    $established_year = get_post_meta($post->ID, 'established_year', true);
    $head_office = get_post_meta($post->ID, 'head_office', true);
    $capital = get_post_meta($post->ID, 'capital', true);
    $ceo = get_post_meta($post->ID, 'ceo', true);
    $employees = get_post_meta($post->ID, 'employees', true);
    $company_image = get_post_meta($post->ID, 'company_image', true);
    ?>
    <p>
        <label for="established_year">Established Year:</label><br>
        <input type="text" id="established_year" name="established_year" value="<?php echo esc_attr($established_year); ?>" style="width: 100%;" placeholder="April 1993">
    </p>
    <p>
        <label for="head_office">Head Office:</label><br>
        <input type="text" id="head_office" name="head_office" value="<?php echo esc_attr($head_office); ?>" style="width: 100%;" placeholder="Marunouchi 2-1-1, Chiyoda, Tokyo">
    </p>
    <p>
        <label for="capital">Capital:</label><br>
        <input type="text" id="capital" name="capital" value="<?php echo esc_attr($capital); ?>" style="width: 100%;" placeholder="100,000,000 JPY">
    </p>
    <p>
        <label for="ceo">CEO:</label><br>
        <input type="text" id="ceo" name="ceo" value="<?php echo esc_attr($ceo); ?>" style="width: 100%;" placeholder="Yutaka Noda">
    </p>
    <p>
        <label for="employees">Number of Employees:</label><br>
        <input type="text" id="employees" name="employees" value="<?php echo esc_attr($employees); ?>" style="width: 100%;" placeholder="Full time: 890 / Temp: 1,600">
    </p>
    <p>
        <label for="company_image">Company Image URL:</label><br>
        <input type="text" id="company_image" name="company_image" value="<?php echo esc_attr($company_image); ?>" style="width: 100%;">
        <button type="button" class="button upload-image-button">Upload Image</button>
    </p>
    <?php
}

// Save meta box data
function about_page_save_meta_box_data($post_id) {
    if (!isset($_POST['about_page_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['about_page_meta_box_nonce'], 'about_page_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // List of fields to save
    $fields = array(
        'hero_image',
        'hero_title',
        'about_image',
        'vision_text',
        'mission_title',
        'mission_text',
        'core_value_text',
        'services_title',
        'services_description',
        'established_year',
        'head_office',
        'capital',
        'ceo',
        'employees',
        'company_image'
    );
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'about_page_save_meta_box_data');

// Add media uploader script
function about_page_admin_scripts() {
    global $post;
    
    if (isset($post) && $post->post_type == 'page') {
        wp_enqueue_media();
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('.upload-image-button').click(function(e) {
                e.preventDefault();
                var button = $(this);
                var input = button.prev('input');
                
                var custom_uploader = wp.media({
                    title: 'Select Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                }).on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    input.val(attachment.url);
                }).open();
            });
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'about_page_admin_scripts');
