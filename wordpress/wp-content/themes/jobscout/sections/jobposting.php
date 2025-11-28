<?php
/**
 * Job Posting Section
 * 
 * @package JobScout
 */

$job_title         = get_theme_mod( 'job_posting_section_title', __( 'Top Jobs', 'jobscout' ) );
$ed_jobposting     = get_theme_mod( 'ed_jobposting', true );
$count_posts       = wp_count_posts('job_listing'); 
if ( $ed_jobposting && jobscout_is_wp_job_manager_activated() && $job_title  ) {
    ?>
    <section id="job-posting-section" class="top-job-section">
        <div class="container">
            <?php 
                if( $job_title ) echo '<h2 class="section-title">'. esc_html( $job_title ) .'</h2>'; 
                if( jobscout_is_wp_job_manager_activated() && $count_posts->publish != 0 ){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                            // Load đủ job, JS sẽ ẩn bớt để ban đầu chỉ hiển thị 6
                            echo do_shortcode('[jobs show_filters="false" post_status="publish" per_page="999"]'); 
                            ?>
                        </div>
                    </div>

                    <div class="top-jobs-view-more" style="text-align: center; margin-top: 30px;">
                        <button type="button" id="top-jobs-load-more" class="btn-view-more-jobs" style="display: inline-block; padding: 12px 36px; border: 2px solid #f7941d; background: transparent; color: #f7941d; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px; cursor: pointer;">
                            <?php esc_html_e( 'View More Jobs', 'jobscout' ); ?>
                        </button>
                    </div>
                <?php } 
            ?>
        </div>
    </section>
    <script>
        (function() {
            const INITIAL_VISIBLE = 6;   // Số job hiển thị ban đầu
            const LOAD_MORE_COUNT = 4;   // Mỗi lần bấm hiện thêm tối đa 4 job

            // Script này chạy ngay sau khi HTML Top Jobs được render
            const section = document.getElementById('job-posting-section');
            if (!section) return;

            const listingsWrapper = section.querySelector('.job_listings');
            if (!listingsWrapper) return;

            const items = listingsWrapper.querySelectorAll('.job_listing');
            const btn   = document.getElementById('top-jobs-load-more');

            if (!items.length || !btn) return;

            if (items.length <= INITIAL_VISIBLE) {
                // Nếu tổng số job <= 6 thì không cần nút
                btn.style.display = 'none';
                return;
            }

            // Ẩn các job sau vị trí thứ 6
            items.forEach(function(item, index) {
                if (index >= INITIAL_VISIBLE) {
                    item.style.display = 'none';
                }
            });

            btn.addEventListener('click', function() {
                let shownThisClick = 0;

                items.forEach(function(item) {
                    if (shownThisClick >= LOAD_MORE_COUNT) {
                        return;
                    }

                    if (item.style.display === 'none') {
                        item.style.display = '';
                        shownThisClick++;
                    }
                });

                // Nếu không còn job nào ẩn thì ẩn luôn nút
                const hasHidden = Array.prototype.some.call(items, function(item) {
                    return item.style.display === 'none';
                });

                if (!hasHidden) {
                    btn.style.display = 'none';
                }
            });
        })();
    </script>
    <?php
}