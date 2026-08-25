<?php
/**
 * About page section: Values.
 *
 * A centered heading and intro line over a grid of icon-topped value cards.
 * Reuses the homepage service card styles from home.css.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_intro = tfh_field( 'about_values_intro' );
$tfh_items = tfh_field_rows( 'about_values_items' );
?>
<section class="tfh-about-values tfh-section" id="our-values">
	<div class="tfh-container">

		<div class="tfh-section-head tfh-section-head--center">
			<?php tfh_eyebrow( tfh_field( 'about_values_eyebrow' ) ); ?>
			<?php
			tfh_split_heading(
				tfh_field( 'about_values_title' ),
				(int) tfh_field( 'about_values_title_highlight' ),
				'h2'
			);
			?>
			<?php if ( $tfh_intro ) : ?>
				<p><?php echo esc_html( $tfh_intro ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $tfh_items ) : ?>
			<div class="tfh-about-values__grid">
				<?php foreach ( $tfh_items as $tfh_item ) : ?>
					<?php
					$tfh_icon  = isset( $tfh_item['icon'] ) && $tfh_item['icon'] ? $tfh_item['icon'] : 'shield-check';
					$tfh_title = isset( $tfh_item['title'] ) ? $tfh_item['title'] : '';
					$tfh_text  = isset( $tfh_item['text'] ) ? $tfh_item['text'] : '';

					if ( ! $tfh_title ) {
						continue;
					}
					?>
					<div class="tfh-service-card">
						<span class="tfh-service-card__icon">
							<?php tfh_icon( $tfh_icon, array( 'size' => 26 ) ); ?>
						</span>

						<h3 class="tfh-service-card__title"><?php echo esc_html( $tfh_title ); ?></h3>

						<?php if ( $tfh_text ) : ?>
							<p class="tfh-service-card__text"><?php echo esc_html( $tfh_text ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
