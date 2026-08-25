<?php
/**
 * Single service section: Related Services.
 *
 * Up to 3 other published services, excluding the current one.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_related = new WP_Query(
	array(
		'post_type'           => 'tfh_service',
		'posts_per_page'      => 3,
		'post__not_in'        => array( get_the_ID() ),
		'post_status'         => 'publish',
		'orderby'             => 'menu_order date ID',
		'order'               => 'ASC',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

$tfh_services_url = tfh_url_by_template( 'page-services.php' );
?>
<?php if ( $tfh_related->have_posts() ) : ?>
	<section class="tfh-services tfh-section" id="related-services">
		<div class="tfh-container">

			<div class="tfh-section-head tfh-section-head--split">
				<div>
					<p class="tfh-eyebrow"><?php esc_html_e( 'Related Services', 'tank-free-home' ); ?></p>
					<h2 class="tfh-heading"><?php esc_html_e( 'Other Ways We Can Help', 'tank-free-home' ); ?></h2>
				</div>

				<?php if ( $tfh_services_url ) : ?>
					<a class="tfh-btn tfh-btn--navy" href="<?php echo esc_url( $tfh_services_url ); ?>">
						<?php esc_html_e( 'View All Services', 'tank-free-home' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<div class="tfh-services__grid">
				<?php
				while ( $tfh_related->have_posts() ) :
					$tfh_related->the_post();
					get_template_part( 'template-parts/service-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>

		</div>
	</section>
<?php endif; ?>
