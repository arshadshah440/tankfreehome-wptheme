<?php
/**
 * Native contact form submission handler for the Contact Us page.
 *
 * No form plugin is bundled, so this posts to admin-post.php, verifies a
 * nonce and honeypot, then emails the brand inbox via wp_mail().
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

/**
 * The list of "How can we help?" choices shown in the form.
 *
 * @return array<string, string> Value => label.
 */
function tfh_contact_service_choices() {
	return array(
		'installation' => __( 'Tankless Installation', 'tank-free-home' ),
		'replacement'  => __( 'System Replacement', 'tank-free-home' ),
		'repair'       => __( 'Repair & Diagnostics', 'tank-free-home' ),
		'maintenance'  => __( 'Maintenance & Flushing', 'tank-free-home' ),
		'other'        => __( 'Something Else', 'tank-free-home' ),
	);
}

/**
 * Handle the contact form POST.
 *
 * @return void
 */
function tfh_handle_contact_submit() {
	$base_redirect = isset( $_POST['tfh_redirect'] )
		? esc_url_raw( wp_unslash( $_POST['tfh_redirect'] ) )
		: home_url( '/' );

	$nonce_ok = isset( $_POST['tfh_contact_nonce'] )
		&& wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tfh_contact_nonce'] ) ), 'tfh_contact_form' );

	if ( ! $nonce_ok ) {
		wp_safe_redirect( add_query_arg( 'contact', 'error', $base_redirect ) );
		exit;
	}

	// Honeypot: bots fill every field, humans never see this one.
	if ( ! empty( $_POST['tfh_company'] ) ) {
		wp_safe_redirect( add_query_arg( 'contact', 'success', $base_redirect ) );
		exit;
	}

	$name    = isset( $_POST['tfh_name'] ) ? sanitize_text_field( wp_unslash( $_POST['tfh_name'] ) ) : '';
	$email   = isset( $_POST['tfh_email'] ) ? sanitize_email( wp_unslash( $_POST['tfh_email'] ) ) : '';
	$phone   = isset( $_POST['tfh_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['tfh_phone'] ) ) : '';
	$service = isset( $_POST['tfh_service'] ) ? sanitize_text_field( wp_unslash( $_POST['tfh_service'] ) ) : '';
	$message = isset( $_POST['tfh_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['tfh_message'] ) ) : '';

	$service_choices = tfh_contact_service_choices();
	$service_label   = isset( $service_choices[ $service ] ) ? $service_choices[ $service ] : '';

	$missing = ( '' === $name || '' === $email || ! is_email( $email ) || '' === $message );

	if ( $missing ) {
		$redirect = add_query_arg(
			array(
				'contact'     => 'error',
				'tfh_name'    => rawurlencode( $name ),
				'tfh_email'   => rawurlencode( $email ),
				'tfh_phone'   => rawurlencode( $phone ),
				'tfh_service' => rawurlencode( $service ),
			),
			$base_redirect
		);

		wp_safe_redirect( $redirect );
		exit;
	}

	$to = tfh_option( 'brand_email' );
	$to = $to ? $to : get_option( 'admin_email' );

	$subject = sprintf(
		/* translators: 1: site name, 2: sender name. */
		__( '[%1$s] New contact form message from %2$s', 'tank-free-home' ),
		get_bloginfo( 'name' ),
		$name
	);

	$body  = __( 'You have a new message from the website contact form:', 'tank-free-home' ) . "\n\n";
	$body .= __( 'Name:', 'tank-free-home' ) . ' ' . $name . "\n";
	$body .= __( 'Email:', 'tank-free-home' ) . ' ' . $email . "\n";
	$body .= __( 'Phone:', 'tank-free-home' ) . ' ' . ( $phone ? $phone : '-' ) . "\n";
	$body .= __( 'How can we help:', 'tank-free-home' ) . ' ' . ( $service_label ? $service_label : '-' ) . "\n\n";
	$body .= __( 'Message:', 'tank-free-home' ) . "\n" . $message . "\n";

	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'contact', $sent ? 'success' : 'mail_error', $base_redirect ) );
	exit;
}
add_action( 'admin_post_tfh_contact_submit', 'tfh_handle_contact_submit' );
add_action( 'admin_post_nopriv_tfh_contact_submit', 'tfh_handle_contact_submit' );
