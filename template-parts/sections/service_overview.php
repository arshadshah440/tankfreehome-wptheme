<?php
/**
 * Single service section: Overview.
 *
 * Featured photo + the service's own "Overview" field (edited from the
 * Service's own edit screen, under "Service Card" -> "Detail Page" -- not
 * the post editor), in the same two-column layout as the homepage's About
 * section (reusing home.css's grid styles).
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_overview = tfh_field( 'service_overview', '' );
?>
<section class="tfh-about tfh-section" id="overview">
	<div class="tfh-container tfh-about__grid">

		<div class="tfh-about__media">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'tfh-card', array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( tfh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
			<?php endif; ?>
		</div>

		<div class="tfh-about__content">
			<p class="tfh-eyebrow"><?php esc_html_e( 'Service Overview', 'tank-free-home' ); ?></p>
			<h2 class="tfh-heading"><?php the_title(); ?></h2>

			<?php if ( $tfh_overview ) : ?>
				<div class="tfh-service-detail__body">
					<?php echo wp_kses_post( wpautop( $tfh_overview ) ); ?>
				</div>
			<?php elseif ( get_the_excerpt() ) : ?>
				<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</div>

	</div>
</section>
