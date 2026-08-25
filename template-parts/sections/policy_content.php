<?php
/**
 * Privacy Policy page section: Table of contents + numbered sections.
 *
 * Reuses the site's narrow reading-width container and default typography
 * (base.css) rather than introducing new prose styling. The final "Contact
 * Us" entry is generated here rather than stored in ACF, so it always shows
 * the live phone/email from Theme Settings -> Brand & Contact.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_intro    = tfh_field( 'privacy_intro' );
$tfh_sections = tfh_field_rows( 'privacy_sections' );

$tfh_toc = array();

foreach ( $tfh_sections as $tfh_key => $tfh_section ) {
	$tfh_heading = isset( $tfh_section['heading'] ) ? $tfh_section['heading'] : '';

	if ( ! $tfh_heading ) {
		unset( $tfh_sections[ $tfh_key ] );
		continue;
	}

	$tfh_sections[ $tfh_key ]['slug'] = 'policy-' . sanitize_title( $tfh_heading );
	$tfh_toc[]                        = array(
		'slug'    => $tfh_sections[ $tfh_key ]['slug'],
		'heading' => $tfh_heading,
	);
}

$tfh_toc[] = array(
	'slug'    => 'policy-contact-us',
	'heading' => __( 'Contact Us', 'tank-free-home' ),
);

$tfh_phone = tfh_option( 'brand_phone' );
$tfh_email = tfh_option( 'brand_email' );
?>
<section class="tfh-policy tfh-section" id="privacy-policy">
	<div class="tfh-container tfh-container--narrow">

		<?php if ( $tfh_intro ) : ?>
			<p class="tfh-policy__intro"><?php echo esc_html( $tfh_intro ); ?></p>
		<?php endif; ?>

		<?php if ( $tfh_toc ) : ?>
			<nav class="tfh-policy__toc" aria-label="<?php esc_attr_e( 'Table of contents', 'tank-free-home' ); ?>">
				<ol>
					<?php foreach ( $tfh_toc as $tfh_entry ) : ?>
						<li><a href="#<?php echo esc_attr( $tfh_entry['slug'] ); ?>"><?php echo esc_html( $tfh_entry['heading'] ); ?></a></li>
					<?php endforeach; ?>
				</ol>
			</nav>
		<?php endif; ?>

		<div class="tfh-policy__body">
			<?php foreach ( $tfh_sections as $tfh_section ) : ?>
				<div class="tfh-policy__section" id="<?php echo esc_attr( $tfh_section['slug'] ); ?>">
					<h2><?php echo esc_html( $tfh_section['heading'] ); ?></h2>
					<?php if ( ! empty( $tfh_section['body'] ) ) : ?>
						<?php echo wp_kses_post( wpautop( $tfh_section['body'] ) ); ?>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>

			<div class="tfh-policy__section" id="policy-contact-us">
				<h2><?php esc_html_e( 'Contact Us', 'tank-free-home' ); ?></h2>
				<p>
					<?php esc_html_e( 'If you have any questions about this Privacy Policy or would like to exercise your privacy rights, please contact us:', 'tank-free-home' ); ?>
				</p>
				<ul>
					<?php if ( $tfh_phone ) : ?>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $tfh_phone ) ); ?>"><?php echo esc_html( $tfh_phone ); ?></a></li>
					<?php endif; ?>
					<?php if ( $tfh_email ) : ?>
						<li><a href="mailto:<?php echo esc_attr( sanitize_email( $tfh_email ) ); ?>"><?php echo esc_html( $tfh_email ); ?></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

	</div>
</section>
