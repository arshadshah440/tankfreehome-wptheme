<?php
/**
 * Location page section: Local Insight.
 *
 * Region-specific considerations, reusing the About page's values grid and
 * the homepage service card's centered icon+title+text style.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_intro = tfh_field( 'location_insights_intro' );
$tfh_items = tfh_field_rows( 'location_insights_items' );
?>
<?php if ( $tfh_items ) : ?>
	<section class="tfh-about-values tfh-section" id="local-insight">
		<div class="tfh-container">

			<div class="tfh-section-head tfh-section-head--center">
				<?php tfh_eyebrow( tfh_field( 'location_insights_eyebrow' ) ); ?>
				<?php
				tfh_split_heading(
					tfh_field( 'location_insights_title' ),
					(int) tfh_field( 'location_insights_title_highlight' ),
					'h2'
				);
				?>
				<?php if ( $tfh_intro ) : ?>
					<p><?php echo esc_html( $tfh_intro ); ?></p>
				<?php endif; ?>
			</div>

			<div class="tfh-about-values__grid">
				<?php foreach ( $tfh_items as $tfh_item ) : ?>
					<?php
					$tfh_icon  = isset( $tfh_item['icon'] ) && $tfh_item['icon'] ? $tfh_item['icon'] : 'thermometer';
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

		</div>
	</section>
<?php endif; ?>
