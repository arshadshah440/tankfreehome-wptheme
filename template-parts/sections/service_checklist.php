<?php
/**
 * Single service section: What's Included.
 *
 * A simple two-column checklist.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_items = tfh_field_rows( 'service_whats_included' );
?>
<?php if ( $tfh_items ) : ?>
	<section class="tfh-service-checklist tfh-section" id="whats-included">
		<div class="tfh-container">

			<div class="tfh-section-head tfh-section-head--center">
				<p class="tfh-eyebrow"><?php esc_html_e( "What's Included", 'tank-free-home' ); ?></p>
				<h2 class="tfh-heading"><?php esc_html_e( 'What This Service Covers', 'tank-free-home' ); ?></h2>
			</div>

			<ul class="tfh-service-checklist__grid">
				<?php foreach ( $tfh_items as $tfh_item ) : ?>
					<?php $tfh_text = isset( $tfh_item['item'] ) ? $tfh_item['item'] : ''; ?>
					<?php if ( ! $tfh_text ) { continue; } ?>
					<li>
						<?php tfh_icon( 'check', array( 'size' => 16 ) ); ?>
						<span><?php echo esc_html( $tfh_text ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>

		</div>
	</section>
<?php endif; ?>
