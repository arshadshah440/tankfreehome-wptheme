<?php
/**
 * Contact page section: Quick info cards.
 *
 * A row of four cards (phone, email, address, hours) pulled from
 * Theme Settings -> Brand & Contact, the same source the footer uses.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_phone   = tfh_option( 'brand_phone' );
$tfh_email   = tfh_option( 'brand_email' );
$tfh_address = tfh_option( 'brand_address' );
$tfh_hours   = tfh_option( 'brand_hours' );
$tfh_map_url = tfh_option( 'brand_map_url' );

$tfh_cards = array();

if ( $tfh_phone ) {
	$tfh_cards[] = array(
		'icon'  => 'phone',
		'label' => __( 'Call Us', 'tank-free-home' ),
		'value' => $tfh_phone,
		'url'   => 'tel:' . preg_replace( '/[^0-9+]/', '', $tfh_phone ),
	);
}

if ( $tfh_email ) {
	$tfh_cards[] = array(
		'icon'  => 'mail',
		'label' => __( 'Email Us', 'tank-free-home' ),
		'value' => $tfh_email,
		'url'   => 'mailto:' . sanitize_email( $tfh_email ),
	);
}

if ( $tfh_address ) {
	$tfh_cards[] = array(
		'icon'  => 'map-pin',
		'label' => __( 'Visit Us', 'tank-free-home' ),
		'value' => wp_kses_post( nl2br( $tfh_address ) ),
		'html'  => true,
		'url'   => $tfh_map_url,
	);
}

if ( $tfh_hours ) {
	$tfh_cards[] = array(
		'icon'  => 'clock',
		'label' => __( 'Business Hours', 'tank-free-home' ),
		'value' => $tfh_hours,
		'url'   => '',
	);
}
?>
<?php if ( $tfh_cards ) : ?>
	<section class="tfh-contact-info tfh-section" id="contact-info">
		<div class="tfh-container">

			<div class="tfh-contact-info__grid">
				<?php foreach ( $tfh_cards as $tfh_card ) : ?>
					<div class="tfh-contact-info__card">
						<span class="tfh-contact-info__icon">
							<?php tfh_icon( $tfh_card['icon'], array( 'size' => 24 ) ); ?>
						</span>
						<span class="tfh-contact-info__label"><?php echo esc_html( $tfh_card['label'] ); ?></span>
						<?php
						$tfh_value = ! empty( $tfh_card['html'] )
							? $tfh_card['value'] // Already sanitized with wp_kses_post() above.
							: nl2br( esc_html( $tfh_card['value'] ) );
						?>
						<?php if ( $tfh_card['url'] ) : ?>
							<a class="tfh-contact-info__value" href="<?php echo esc_url( $tfh_card['url'] ); ?>" <?php echo ( 'map-pin' === $tfh_card['icon'] ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
								<?php echo $tfh_value; // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped above. ?>
							</a>
						<?php else : ?>
							<span class="tfh-contact-info__value">
								<?php echo $tfh_value; // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped above. ?>
							</span>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</section>
<?php endif; ?>
