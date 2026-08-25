<?php
/**
 * Why Choose Us section.
 *
 * Dark navy panel: eyebrow/title with an experience badge, a full-width
 * photo, then a row of three feature columns. Shared across the homepage,
 * Service Listing page, and every single Service page, so its content is
 * edited from Theme Settings -> Site Sections rather than any one page.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_image = tfh_image( tfh_option( 'why_image' ), 'tfh-wide' );
$tfh_items = tfh_rows( 'why_items' );

$tfh_badge_value = tfh_option( 'why_badge_value' );
$tfh_badge_label = tfh_option( 'why_badge_label' );
?>
<section class="tfh-why tfh-section" id="why-choose-us">
	<div class="tfh-container">

		<div class="tfh-why__head">
			<div class="tfh-heading-wrapper">
				<?php tfh_eyebrow( tfh_option( 'why_eyebrow' ) ); ?>
				<?php
				tfh_split_heading(
					tfh_option( 'why_title' ),
					(int) tfh_option( 'why_title_highlight' ),
					'h2'
				);
				?>
			</div>

			<?php if ( $tfh_badge_value || $tfh_badge_label ) : ?>
				<div class="tfh-why__badge">
					<?php if ( $tfh_badge_value ) : ?>
						<span class="tfh-why__badge-value"><?php echo esc_html( $tfh_badge_value ); ?></span>
					<?php endif; ?>
					<?php if ( $tfh_badge_label ) : ?>
						<span class="tfh-why__badge-label"><?php echo esc_html( $tfh_badge_label ); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="tfh-why__media">
			<?php if ( $tfh_image['url'] ) : ?>
				<img src="<?php echo esc_url( $tfh_image['url'] ); ?>" alt="<?php echo esc_attr( $tfh_image['alt'] ); ?>" loading="lazy" decoding="async">
			<?php else : ?>
				<img src="<?php echo esc_url( tfh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
			<?php endif; ?>
		</div>

		<?php if ( $tfh_items ) : ?>
			<div class="tfh-why__columns">
				<?php foreach ( $tfh_items as $tfh_item ) : ?>
					<?php
					$tfh_icon  = isset( $tfh_item['icon'] ) && $tfh_item['icon'] ? $tfh_item['icon'] : 'shield';
					$tfh_title = isset( $tfh_item['title'] ) ? $tfh_item['title'] : '';
					$tfh_text  = isset( $tfh_item['text'] ) ? $tfh_item['text'] : '';

					if ( ! $tfh_title ) {
						continue;
					}
					?>
					<div class="tfh-why__column">
						<span class="tfh-why__column-icon">
							<?php tfh_icon( $tfh_icon, array( 'size' => 26 ) ); ?>
						</span>
						<h3 class="tfh-why__column-title"><?php echo esc_html( $tfh_title ); ?></h3>
						<?php if ( $tfh_text ) : ?>
							<p class="tfh-why__column-text"><?php echo esc_html( $tfh_text ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
