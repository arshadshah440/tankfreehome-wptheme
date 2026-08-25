<?php
/**
 * Homepage section: Hero.
 *
 * Full-bleed navy panel with a title, supporting text, a CTA button and a
 * stat row on the left, and a technician photo on the right.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_bg      = tfh_image( tfh_field( 'hero_background' ), 'full' );
$tfh_image   = tfh_image( tfh_field( 'hero_image' ), 'tfh-wide' );
$tfh_eyebrow = tfh_field( 'hero_eyebrow' );
$tfh_title   = tfh_field( 'hero_title' );
$tfh_text    = tfh_field( 'hero_text' );
$tfh_button  = tfh_link( tfh_field( 'hero_button' ), __( 'Get Started', 'tank-free-home' ) );
$tfh_stats   = tfh_field_rows( 'hero_stats' );
?>
<section class="tfh-hero" id="hero">

	<?php if ( $tfh_bg['url'] ) : ?>
		<div class="tfh-hero__bg" style="background-image:url('<?php echo esc_url( $tfh_bg['url'] ); ?>');" aria-hidden="true"></div>
	<?php endif; ?>

	<div class="tfh-container tfh-hero__inner">

		<div class="tfh-hero__content">

			<?php if ( $tfh_eyebrow ) : ?>
				<p class="tfh-hero__eyebrow"><?php echo esc_html( $tfh_eyebrow ); ?></p>
			<?php endif; ?>

			<?php if ( $tfh_title ) : ?>
				<h1 class="tfh-hero__title"><?php echo esc_html( $tfh_title ); ?></h1>
			<?php endif; ?>

			<?php if ( $tfh_text ) : ?>
				<p class="tfh-hero__text"><?php echo esc_html( $tfh_text ); ?></p>
			<?php endif; ?>

			<?php if ( $tfh_button ) : ?>
				<div class="tfh-hero__actions">
					<a class="tfh-btn tfh-btn--accent"<?php echo tfh_link_attrs( $tfh_button ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in tfh_link_attrs(). ?>>
						<?php echo esc_html( $tfh_button['title'] ); ?>
					</a>
				</div>
			<?php endif; ?>

			<?php if ( $tfh_stats ) : ?>
				<div class="tfh-hero__stats">
					<?php foreach ( $tfh_stats as $tfh_stat ) : ?>
						<?php
						$tfh_value = isset( $tfh_stat['value'] ) ? $tfh_stat['value'] : '';
						$tfh_label = isset( $tfh_stat['label'] ) ? $tfh_stat['label'] : '';

						if ( ! $tfh_value && ! $tfh_label ) {
							continue;
						}
						?>
						<div class="tfh-hero__stat">
							<span class="tfh-hero__stat-value"><?php echo esc_html( $tfh_value ); ?></span>
							<span class="tfh-hero__stat-label"><?php echo esc_html( $tfh_label ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>

		<div class="tfh-hero__media">
			<?php if ( $tfh_image['url'] ) : ?>
				<img src="<?php echo esc_url( $tfh_image['url'] ); ?>" alt="<?php echo esc_attr( $tfh_image['alt'] ); ?>" decoding="async">
			<?php else : ?>
				<img src="<?php echo esc_url( tfh_placeholder_image_url() ); ?>" alt="" decoding="async">
			<?php endif; ?>
		</div>

	</div>

	<div class="tfh-hero__divider" aria-hidden="true"></div>
</section>
