<?php
/**
 * Service Listing page section: Paginated service grid.
 *
 * Reuses the homepage's service card component and grid styles. Pagination
 * uses its own "spage" query string param (not WordPress's reserved "page"
 * or "paged") so it never collides with core pagination on a static page.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_per_page = absint( tfh_field( 'services_listing_per_page' ) );
$tfh_per_page = $tfh_per_page ? $tfh_per_page : 6;

$tfh_current_page = isset( $_GET['spage'] ) ? absint( $_GET['spage'] ) : 1; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only pagination pointer, not a state-changing action.
$tfh_current_page = $tfh_current_page ? $tfh_current_page : 1;

$tfh_services = new WP_Query(
	array(
		'post_type'      => 'tfh_service',
		'posts_per_page' => $tfh_per_page,
		'paged'          => $tfh_current_page,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order date ID',
		'order'          => 'ASC',
	)
);
?>
<section class="tfh-services tfh-section" id="services">
	<div class="tfh-container">

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

			<?php if ( $tfh_services->max_num_pages > 1 ) : ?>
				<nav class="tfh-pagination" aria-label="<?php esc_attr_e( 'Services pagination', 'tank-free-home' ); ?>">
					<?php
					echo paginate_links( // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- paginate_links() output is already escaped.
						array(
							'base'      => esc_url_raw( add_query_arg( 'spage', '%#%' ) ),
							'format'    => '',
							'current'   => $tfh_current_page,
							'total'     => (int) $tfh_services->max_num_pages,
							'prev_text' => tfh_get_icon( 'chevron-left', array( 'size' => 16, 'label' => __( 'Previous page', 'tank-free-home' ) ) ),
							'next_text' => tfh_get_icon( 'chevron-right', array( 'size' => 16, 'label' => __( 'Next page', 'tank-free-home' ) ) ),
							'mid_size'  => 1,
							'end_size'  => 1,
						)
					);
					?>
				</nav>
			<?php endif; ?>
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
