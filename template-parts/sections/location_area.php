<?php
/**
 * Location page section: Service Area.
 *
 * A centered heading over a row of city pills.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_cities = tfh_field_rows( 'location_area_cities' );
?>
<?php if ( $tfh_cities ) : ?>
	<section class="tfh-location-area tfh-section" id="service-area">
		<div class="tfh-container">

			<div class="tfh-section-head tfh-section-head--center">
				<?php tfh_eyebrow( tfh_field( 'location_area_eyebrow' ) ); ?>
				<?php
				tfh_split_heading(
					tfh_field( 'location_area_title' ),
					(int) tfh_field( 'location_area_title_highlight' ),
					'h2'
				);
				?>
			</div>

			<ul class="tfh-location-area__list">
				<?php foreach ( $tfh_cities as $tfh_row ) : ?>
					<?php $tfh_city = isset( $tfh_row['city'] ) ? $tfh_row['city'] : ''; ?>
					<?php if ( ! $tfh_city ) { continue; } ?>
					<li>
						<?php tfh_icon( 'map-pin', array( 'size' => 14 ) ); ?>
						<span><?php echo esc_html( $tfh_city ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>

		</div>
	</section>
<?php endif; ?>
