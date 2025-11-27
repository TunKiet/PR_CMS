<?php
/**
 * Custom Job Detail Layout - theo mẫu khách hàng
 */
?>
<div class="job-detail-wrapper" style="background:#fafafa;padding:30px 0;">
        <div class="job-detail-container" style="max-width:1100px;margin:0 auto;display:flex;flex-direction:column;gap:30px;">
                <!-- Breadcrumb -->
                <div style="margin-bottom:12px;">
                        <nav class="breadcrumb" style="font-size:0.98em;color:#b88c4a;">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:#b88c4a;text-decoration:none;">Home</a> /
                                <a href="<?php echo esc_url( get_post_type_archive_link( 'job_listing' ) ); ?>" style="color:#b88c4a;text-decoration:none;">All Jobs</a> /
                                <span style="color:#f4a259;font-weight:600;">Job Detail</span>
                        </nav>
                </div>
                <!-- Block 1: Job Main Info -->
                <div class="job-header" style="background:#fff;padding:24px 32px;border-radius:8px;display:flex;align-items:flex-start;justify-content:space-between;box-shadow:0 2px 8px rgba(0,0,0,0.03);">
                        <div style="display:flex;align-items:flex-start;gap:24px;">
                                <div class="job-logo" style="width:100px;min-width:100px;">
                                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium'); } ?>
                                </div>
                                <div>
                                        <h1 class="job-title" style="margin:0 0 8px 0;font-size:1.6em;font-weight:700;"><?php the_title(); ?></h1>
                                        <div style="color:#888;font-size:0.95em;">Created: <?php echo get_the_date('M d, Y'); ?></div>
                                        <div style="margin:8px 0;">
                                                <?php
                                                        // Loại hình
                                                        if ( function_exists('wpjm_get_the_job_types') ) {
                                                                $types = wpjm_get_the_job_types();
                                                                if ( !empty($types) ) {
                                                                        foreach ($types as $type) {
                                                                                echo '<span style="background:#f5f5f5;border-radius:4px;padding:2px 10px;margin-right:8px;font-size:0.95em;">'.esc_html($type->name).'</span>';
                                                                        }
                                                                }
                                                        }
                                                        // Danh mục
                                                        $terms = get_the_terms(get_the_ID(), 'job_listing_category');
                                                        if ( $terms && !is_wp_error($terms) ) {
                                                                foreach ($terms as $term) {
                                                                        echo '<span style="background:#f5f5f5;border-radius:4px;padding:2px 10px;margin-right:8px;font-size:0.95em;">'.esc_html($term->name).'</span>';
                                                                }
                                                        }
                                                        // Khu vực
                                                        $locations = get_the_terms(get_the_ID(), 'job_listing_location');
                                                        if ( $locations && !is_wp_error($locations) ) {
                                                                foreach ($locations as $loc) {
                                                                        echo '<span style="background:#f5f5f5;border-radius:4px;padding:2px 10px;margin-right:8px;font-size:0.95em;">'.esc_html($loc->name).'</span>';
                                                                }
                                                        }
                                                ?>
                                        </div>
                                        <div style="color:#888;font-size:0.95em;">@ <?php echo get_post_meta(get_the_ID(), '_company_name', true); ?></div>
                                </div>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:12px;align-items:flex-end;">
                                <button style="border:1.5px solid #f4a259;background:#fff;color:#f4a259;padding:8px 24px;border-radius:4px;font-weight:600;cursor:pointer;">SHARE</button>
                                <button style="border:1px solid #f4a259;background:#fff;color:#f4a259;padding:8px 24px;border-radius:4px;font-weight:600;cursor:pointer;">APPLY JOB</button>
                        </div>
                </div>

                <!-- Block 2 & 3: Main Content + Sidebar -->
                <div style="display:flex;gap:32px;">
                        <!-- Main Content -->
                        <div style="flex:2;background:#fff;padding:32px 32px 32px 32px;border-radius:8px;">
                                <h2 style="font-size:1.2em;font-weight:700;">Overview about Company</h2>
                                <div style="margin-bottom:24px;"><?php the_content(); ?></div>
                                <h2 style="font-size:1.2em;font-weight:700;">Our Key Skills</h2>
                                <div style="margin-bottom:24px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum...</div>
                                <h2 style="font-size:1.2em;font-weight:700;">Why You'll Love Working Here</h2>
                                <div style="margin-bottom:24px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum...</div>
                                <h2 style="font-size:1.2em;font-weight:700;">Location</h2>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus lectus tristique massa gravida vel elementum...</div>
                        </div>
                        <!-- Sidebar -->
                        <div style="flex:1;display:flex;flex-direction:column;gap:24px;">
                                <div style="background:#fff;padding:24px;border-radius:8px;">
                                        <div style="font-weight:600;margin-bottom:8px;">Staff Rating</div>
                                        <div style="font-size:1.5em;color:#f4a259;">
                                                ★★★★☆ <span style="color:#333;font-size:1em;vertical-align:middle;">4.0</span>
                                        </div>
                                </div>
                                <div style="background:#fff;padding:24px;border-radius:8px;">
                                        <div style="font-weight:600;margin-bottom:8px;">Company Photos</div>
                                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Company Photo" style="width:100%;border-radius:6px;object-fit:cover;" />
                                        <div style="position:absolute;top:16px;right:16px;background:rgba(0,0,0,0.5);color:#fff;padding:2px 8px;border-radius:12px;font-size:0.95em;">+5</div>
                                </div>
                        </div>
                </div>

                <!-- Block 4: Other Jobs -->
                <div style="background:#fff;padding:32px;border-radius:8px;margin-top:16px;">
                        <h2 style="text-align:center;font-size:1.3em;font-weight:700;letter-spacing:1px;">OTHER JOBS</h2>
                        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:24px;">
                                <?php
                                $args = array(
                                        'post_type' => 'job_listing',
                                        'posts_per_page' => 6,
                                        'post__not_in' => array(get_the_ID()),
                                );
                                $other_jobs = new WP_Query($args);
                                if ( $other_jobs->have_posts() ) :
                                        while ( $other_jobs->have_posts() ) : $other_jobs->the_post(); ?>
                                                <div style="background:#fafafa;padding:18px 16px;border-radius:6px;">
                                                        <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px;">
                                                                <div style="width:40px;min-width:40px;">
                                                                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); } ?>
                                                                </div>
                                                                <div>
                                                                        <div style="font-weight:600;"><?php the_title(); ?></div>
                                                                        <div style="color:#888;font-size:0.95em;">Created: <?php echo get_the_date('M d, Y'); ?></div>
                                                                        <div style="color:#888;font-size:0.95em;">Ho Chi Minh City</div>
                                                                </div>
                                                        </div>
                                                        <div style="font-size:0.95em;line-height:1.5;">
                                                                • Be responsible for the effective operational management of the hotel<br>
                                                                • Excellent salary bonuses & recognition activities<br>
                                                                • Foreign language allowance (up to 500 USD/month)
                                                        </div>
                                                </div>
                                <?php endwhile; wp_reset_postdata(); endif; ?>
                        </div>
                </div>
        </div>
</div>