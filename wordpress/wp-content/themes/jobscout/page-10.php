<?php
/**
 * Template for Jobs page (page_id=10) - custom layout, no sidebar, only main content, no unrelated blocks
 * @package JobScout
 */
get_header();
require_once get_template_directory() . '/inc/custom-jobs-banner.php';
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div style="width:100vw;max-width:none;background:#f5f5f5;padding:0;margin:0;">
            <section class="jobs-hero" style="width:1200px;margin:0 0 0 16px;background:url('<?php echo get_jobs_banner_url(); ?>') center/cover no-repeat;min-height:340px;display:flex;align-items:center;justify-content:center;border-radius:32px;overflow:hidden;position:relative;top:0;">
                <h1 style="color:#fff;font-size:3.4rem;font-weight:700;text-shadow:0 2px 8px rgba(0,0,0,0.3);letter-spacing:3px;">CAREER WITH US</h1>
            </section>
            <div class="jobs-main-content jobs-main-content-2col" style="width:1200px;margin:0 0 0 16px;padding:56px 0 0 0;min-height:100vh;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
                <h2 style="font-size:2rem;font-weight:600;margin:0;">ALL JOBS</h2>
                <div>
                    <form id="jobs-order-form" method="get" action="">
                        <input type="hidden" name="page_id" value="10" />
                        <select name="order" id="jobs-order-select" style="padding:8px 16px;border-radius:4px;border:1px solid #ddd;">
                            <option value="DESC" <?php if(!isset($_GET['order'])||$_GET['order']==='DESC') echo 'selected'; ?>>Latest Jobs</option>
                            <option value="ASC" <?php if(isset($_GET['order'])&&$_GET['order']==='ASC') echo 'selected'; ?>>Oldest Jobs</option>
                        </select>
                    </form>
                    <script>
                    document.getElementById('jobs-order-select').addEventListener('change', function() {
                        document.getElementById('jobs-order-form').submit();
                    });
                    </script>
                </div>
            </div>
            <?php
                $order = isset($_GET['order']) && $_GET['order'] === 'ASC' ? 'ASC' : 'DESC';
                echo do_shortcode('[jobs show_filters="false" per_page="8" orderby="date" order="' . $order . '"]');
            ?>
            <!-- Nút load more của plugin sẽ tự động hiển thị, không cần tạo thêm nút custom -->
        </div>
    </main>
</div>

<?php get_footer(); ?>
