<style>
.job-search-form {
    display: flex;
    align-items: center;
    gap: 0;
    max-width: 1000px;
    margin: 0 auto;
}

.search-input-wrapper,
.location-select-wrapper {
    position: relative;
    background: white;
    display: flex;
    align-items: center;
    padding: 0 20px;
    height: 60px;
}

.search-input-wrapper {
    flex: 1;
    min-width: 350px;
}

.location-select-wrapper {
    min-width: 250px;
    border-left: 1px solid #e0e0e0;
}

.search-icon,
.location-icon {
    font-size: 18px;
    margin-right: 12px;
    opacity: 0.5;
}

.search-input,
.location-select {
    border: none;
    outline: none;
    font-size: 15px;
    width: 100%;
    background: transparent;
    color: #333;
}

.search-input::placeholder {
    color: #999;
}

.location-select {
    cursor: pointer;
    appearance: none;
    padding-right: 30px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23333' d='M6 8L0 0h12z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
}

.search-button {
    background: #ff6b35;
    color: white;
    border: none;
    padding: 0 35px;
    height: 60px;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: background 0.3s ease;
    white-space: nowrap;
}

.search-button:hover {
    background: #ff5722;
}

/* Responsive */
@media (max-width: 768px) {
    .job-search-form {
        flex-direction: column;
        width: 100%;
    }
    
    .search-input-wrapper,
    .location-select-wrapper {
        width: 100%;
        min-width: 100%;
    }
    
    .location-select-wrapper {
        border-left: none;
        border-top: 1px solid #e0e0e0;
    }
    
    .search-button {
        width: 100%;
    }
}
</style>
<?php

/**
 * Banner Section
 * 
 * @package JobScout
 */

$ed_banner         = get_theme_mod('ed_banner_section', true);
$banner_title      = get_theme_mod('banner_title', __('Aim Higher, Dream Bigger', 'jobscout'));
$banner_subtitle   = get_theme_mod('banner_subtitle', __('Each month, more than 7 million JobScout turn to website in their search for work, making over 160,000 applications every day.', 'jobscout'));
$find_a_job_link   = get_option('job_manager_jobs_page_id', 0);

if ($ed_banner && has_custom_header()) { ?>
    <div id="banner-section" class="site-banner<?php if (has_header_video()) echo esc_attr(' video-banner'); ?>">
        <div class="item">
            <?php the_custom_header_markup(); ?>
            <div class="banner-caption">
                <div class="container">
                    <div class="caption-inner">
                        <?php
                        if ($banner_title) echo '<h2 class="title">' . esc_html($banner_title) . '</h2>';
                        if ($banner_subtitle) echo '<div class="description">' . wpautop(wp_kses_post($banner_subtitle)) . '</div>';
                        ?>
                        <div class="form-wrap">
                            <div class="search-filter-wrap">
                                <div class="job-search-form">
                                    <div class="search-input-wrapper">
                                        <i class="search-icon">🔍</i>
                                        <input type="text"
                                            class="search-input"
                                            placeholder="Search for jobs, companies, skills"
                                            name="search_keywords">
                                    </div>

                                    <div class="location-select-wrapper">
                                        <i class="location-icon">📍</i>
                                        <select class="location-select" name="search_location">
                                            <option value="tokyo">Tokyo</option>
                                            <option value="osaka">Osaka</option>
                                            <option value="kyoto">Kyoto</option>
                                            <option value="yokohama">Yokohama</option>
                                            <option value="nagoya">Nagoya</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="search-button">
                                        SEARCH JOB
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
