<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.27.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
$job_salary   = get_post_meta( get_the_ID(), '_job_salary', true );
$job_featured = get_post_meta( get_the_ID(), '_featured', true );
$company_name = get_post_meta( get_the_ID(), '_company_name', true );

?>
<article <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">

	<figure class="company-logo">
		<?php the_company_logo( 'thumbnail' ); ?>
	</figure>

	<div class="job-title-wrap">
		
		<h2 class="entry-title">
			<a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a>
		</h2>
		
		<?php if( $company_name ){ ?>
			<div class="company-name">
				<?php the_company_name(); ?>
			</div>
		<?php } ?>
		
		<div class="entry-meta">
			<?php 
				do_action( 'job_listing_meta_start' );

				$job_created       = get_the_date( 'M d, Y' );
				$job_location_text = wp_strip_all_tags( get_the_job_location( $post ) );
				$job_category_name = '';
				$job_categories    = get_the_terms( get_the_ID(), 'job_listing_category' );
				if ( ! is_wp_error( $job_categories ) && ! empty( $job_categories ) ) {
					$job_category_name = $job_categories[0]->name;
				}
			?>
			<div class="job-meta-top">
				<span class="job-created-label"><?php esc_html_e( 'Created:', 'jobscout' ); ?></span>
				<span class="job-created-date"><?php echo esc_html( $job_created ); ?></span>
			</div>

			<div class="job-badges">
				<?php 
				if ( get_option( 'job_manager_enable_types' ) ) { 
					$types = wpjm_get_the_job_types();
					if ( ! empty( $types ) ) {
						$jobtype = current( $types );
						?>
							<span class="job-badge"><?php echo esc_html( $jobtype->name ); ?></span>
						<?php
					}
				}

				if ( $job_category_name ) : ?>
					<span class="job-badge"><?php echo esc_html( $job_category_name ); ?></span>
				<?php endif; ?>

				<?php if ( $job_location_text ) : ?>
					<span class="job-badge"><?php echo esc_html( $job_location_text ); ?></span>
				<?php endif; ?>
			</div>

			<?php do_action( 'job_listing_meta_end' ); ?>
		</div>		

		<?php
		// Short description under badges (uses job excerpt)
		$job_excerpt = get_the_excerpt();
		if ( ! empty( $job_excerpt ) ) : ?>
			<div class="job-desc">
				<?php echo wp_kses_post( wpautop( wp_trim_words( $job_excerpt, 40 ) ) ); ?>
			</div>
		<?php endif; ?>
	</div>

	<?php if( $job_featured ){ ?>
		<div class="featured-label"><?php esc_html_e( 'Featured', 'jobscout' ); ?></div>
	<?php } ?>

</article>
