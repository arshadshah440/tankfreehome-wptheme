<?php
/**
 * Homepage section: Reliable Tankless Water Heater Services We Provide.
 *
 * Cards are pulled from the Service custom post type.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_count = absint( tfh_field( 'services_count' ) );
$tfh_count = $tfh_count ? $tfh_count : 6;

$tfh_args = array(
	'post_type'           => 'tfh_service',
	'posts_per_page'      => $tfh_count,
	'post_status'         => 'publish',
	'orderby'             => 'menu_order date ID',
	'order'               => 'ASC',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
);

$tfh_term = tfh_field( 'services_category' );

if ( $tfh_term ) {
	$tfh_args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		array(
			'taxonomy' => 'tfh_service_cat',
			'field'    => is_numeric( $tfh_term ) ? 'term_id' : 'slug',
			'terms'    => $tfh_term,
		),
	);
}

$tfh_services = new WP_Query( $tfh_args );
?>
<section class="tfh-services tfh-section" id="services">
	<div class="tfh-container">

		<div class="tfh-section-head tfh-section-head--center">
			<?php tfh_eyebrow( tfh_field( 'services_eyebrow' ) ); ?>
			<?php
			tfh_split_heading(
				tfh_field( 'services_title' ),
				(int) tfh_field( 'services_title_highlight' ),
				'h2'
			);
			?>
		</div>

		<?php if ( $tfh_services->have_posts() ) : ?>
			<div class="tfh-services__grid">
				<?php
				while ( $tfh_services->have_posts() ) :
					$tfh_services->the_post();
					get_template_part( 'template-parts/service-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
			<p class="tfh-empty-hint">
				<?php
				printf(
					/* translators: %s: link to add a service. */
					esc_html__( 'No services yet. %s to fill this grid.', 'tank-free-home' ),
					'<a href="' . esc_url( admin_url( 'post-new.php?post_type=tfh_service' ) ) . '">'
						. esc_html__( 'Add a service', 'tank-free-home' ) . '</a>'
				);
				?>
			</p>
		<?php endif; ?>

	</div>
</section>
