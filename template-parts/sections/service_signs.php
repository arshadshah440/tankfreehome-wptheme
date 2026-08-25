<?php
/**
 * Single service section: Signs You May Need This.
 *
 * Reuses the homepage service card's centered icon+title+text style.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_items = tfh_field_rows( 'service_signs' );
?>
<?php if ( $tfh_items ) : ?>
	<section class="tfh-service-signs tfh-section" id="signs">
		<div class="tfh-container">

			<div class="tfh-section-head tfh-section-head--center">
				<p class="tfh-eyebrow"><?php esc_html_e( 'Common Signs', 'tank-free-home' ); ?></p>
				<h2 class="tfh-heading"><?php esc_html_e( 'Signs You May Need This Service', 'tank-free-home' ); ?></h2>
			</div>

			<div class="tfh-services__grid">
				<?php foreach ( $tfh_items as $tfh_item ) : ?>
					<?php
					$tfh_icon  = isset( $tfh_item['icon'] ) && $tfh_item['icon'] ? $tfh_item['icon'] : 'gauge';
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
