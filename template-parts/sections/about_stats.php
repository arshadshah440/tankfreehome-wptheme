<?php
/**
 * About page section: Trust stats.
 *
 * A centered heading over a row of large stat figures.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_items = tfh_field_rows( 'about_stats_items' );
?>
<section class="tfh-about-stats tfh-section" id="track-record">
	<div class="tfh-container">

		<div class="tfh-section-head tfh-section-head--center">
			<?php tfh_eyebrow( tfh_field( 'about_stats_eyebrow' ) ); ?>
			<?php
			tfh_split_heading(
				tfh_field( 'about_stats_title' ),
				(int) tfh_field( 'about_stats_title_highlight' ),
				'h2'
			);
			?>
		</div>

		<?php if ( $tfh_items ) : ?>
			<div class="tfh-about-stats__row">
				<?php foreach ( $tfh_items as $tfh_item ) : ?>
					<?php
					$tfh_value = isset( $tfh_item['value'] ) ? $tfh_item['value'] : '';
					$tfh_label = isset( $tfh_item['label'] ) ? $tfh_item['label'] : '';

					if ( ! $tfh_value && ! $tfh_label ) {
						continue;
					}
					?>
					<div class="tfh-about-stats__item">
						<span class="tfh-about-stats__value"><?php echo esc_html( $tfh_value ); ?></span>
						<span class="tfh-about-stats__label"><?php echo esc_html( $tfh_label ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
