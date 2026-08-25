<?php
/**
 * Contact page section: Contact form + sidebar.
 *
 * A native form (no plugin) posting to admin-post.php, handled by
 * tfh_handle_contact_submit() in inc/contact-form.php, alongside a navy
 * sidebar card repeating the brand's contact details and socials.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_text = tfh_field( 'contact_form_text' );

$tfh_status = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only status flag, not a state-changing action.

$tfh_old_name    = isset( $_GET['tfh_name'] ) ? sanitize_text_field( wp_unslash( $_GET['tfh_name'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$tfh_old_email   = isset( $_GET['tfh_email'] ) ? sanitize_email( wp_unslash( $_GET['tfh_email'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$tfh_old_phone   = isset( $_GET['tfh_phone'] ) ? sanitize_text_field( wp_unslash( $_GET['tfh_phone'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$tfh_old_service = isset( $_GET['tfh_service'] ) ? sanitize_text_field( wp_unslash( $_GET['tfh_service'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

$tfh_phone    = tfh_option( 'brand_phone' );
$tfh_email    = tfh_option( 'brand_email' );
$tfh_address  = tfh_option( 'brand_address' );
$tfh_hours    = tfh_option( 'brand_hours' );
$tfh_socials  = tfh_rows( 'footer_socials' );
$tfh_services = tfh_contact_service_choices();
?>
<section class="tfh-contact-form tfh-section" id="contact-form">
	<div class="tfh-container">

		<div class="tfh-section-head tfh-section-head--center">
			<?php tfh_eyebrow( tfh_field( 'contact_form_eyebrow' ) ); ?>
			<?php
			tfh_split_heading(
				tfh_field( 'contact_form_title' ),
				(int) tfh_field( 'contact_form_title_highlight' ),
				'h2'
			);
			?>
			<?php if ( $tfh_text ) : ?>
				<p><?php echo esc_html( $tfh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( 'success' === $tfh_status ) : ?>
			<div class="tfh-form-notice tfh-form-notice--success" role="status">
				<?php esc_html_e( "Thanks for reaching out! We've received your message and will be in touch shortly.", 'tank-free-home' ); ?>
			</div>
		<?php elseif ( 'mail_error' === $tfh_status ) : ?>
			<div class="tfh-form-notice tfh-form-notice--error" role="alert">
				<?php
				printf(
					/* translators: %s: phone number. */
					esc_html__( "Something went wrong sending your message. Please call us directly at %s.", 'tank-free-home' ),
					esc_html( $tfh_phone )
				);
				?>
			</div>
		<?php elseif ( 'error' === $tfh_status ) : ?>
			<div class="tfh-form-notice tfh-form-notice--error" role="alert">
				<?php esc_html_e( 'Please fill in your name, a valid email and a message, then try again.', 'tank-free-home' ); ?>
			</div>
		<?php endif; ?>

		<div class="tfh-contact-form__grid">

			<form class="tfh-contact-form__form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

				<input type="hidden" name="action" value="tfh_contact_submit">
				<input type="hidden" name="tfh_redirect" value="<?php echo esc_url( get_permalink() ); ?>">
				<?php wp_nonce_field( 'tfh_contact_form', 'tfh_contact_nonce' ); ?>

				<div class="tfh-field-hp" aria-hidden="true">
					<label for="tfh_company"><?php esc_html_e( 'Company', 'tank-free-home' ); ?></label>
					<input type="text" id="tfh_company" name="tfh_company" tabindex="-1" autocomplete="off">
				</div>

				<div class="tfh-form-row">
					<div class="tfh-field">
						<label for="tfh_name"><?php esc_html_e( 'Full Name', 'tank-free-home' ); ?> <span class="tfh-field__required">*</span></label>
						<input type="text" id="tfh_name" name="tfh_name" value="<?php echo esc_attr( $tfh_old_name ); ?>" required>
					</div>
					<div class="tfh-field">
						<label for="tfh_email"><?php esc_html_e( 'Email Address', 'tank-free-home' ); ?> <span class="tfh-field__required">*</span></label>
						<input type="email" id="tfh_email" name="tfh_email" value="<?php echo esc_attr( $tfh_old_email ); ?>" required>
					</div>
				</div>

				<div class="tfh-form-row">
					<div class="tfh-field">
						<label for="tfh_phone"><?php esc_html_e( 'Phone Number', 'tank-free-home' ); ?></label>
						<input type="tel" id="tfh_phone" name="tfh_phone" value="<?php echo esc_attr( $tfh_old_phone ); ?>">
					</div>
					<div class="tfh-field">
						<label for="tfh_service"><?php esc_html_e( 'How Can We Help?', 'tank-free-home' ); ?></label>
						<select id="tfh_service" name="tfh_service">
							<option value=""><?php esc_html_e( 'Select an option', 'tank-free-home' ); ?></option>
							<?php foreach ( $tfh_services as $tfh_value => $tfh_label ) : ?>
								<option value="<?php echo esc_attr( $tfh_value ); ?>" <?php selected( $tfh_old_service, $tfh_value ); ?>>
									<?php echo esc_html( $tfh_label ); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="tfh-field">
					<label for="tfh_message"><?php esc_html_e( 'Message', 'tank-free-home' ); ?> <span class="tfh-field__required">*</span></label>
					<textarea id="tfh_message" name="tfh_message" rows="5" required></textarea>
				</div>

				<button type="submit" class="tfh-btn tfh-btn--accent">
					<?php esc_html_e( 'Send Message', 'tank-free-home' ); ?>
				</button>

			</form>

			<div class="tfh-contact-form__sidebar">

				<h3><?php esc_html_e( 'Contact Information', 'tank-free-home' ); ?></h3>

				<div class="tfh-contact-form__rows">
					<?php if ( $tfh_phone ) : ?>
						<p class="tfh-footer__contact-item">
							<?php tfh_icon( 'phone', array( 'size' => 16 ) ); ?>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $tfh_phone ) ); ?>"><?php echo esc_html( $tfh_phone ); ?></a>
						</p>
					<?php endif; ?>

					<?php if ( $tfh_email ) : ?>
						<p class="tfh-footer__contact-item">
							<?php tfh_icon( 'mail', array( 'size' => 16 ) ); ?>
							<a href="mailto:<?php echo esc_attr( sanitize_email( $tfh_email ) ); ?>"><?php echo esc_html( $tfh_email ); ?></a>
						</p>
					<?php endif; ?>

					<?php if ( $tfh_address ) : ?>
						<p class="tfh-footer__contact-item">
							<?php tfh_icon( 'map-pin', array( 'size' => 16 ) ); ?>
							<span><?php echo wp_kses_post( nl2br( $tfh_address ) ); ?></span>
						</p>
					<?php endif; ?>

					<?php if ( $tfh_hours ) : ?>
						<p class="tfh-footer__contact-item">
							<?php tfh_icon( 'clock', array( 'size' => 16 ) ); ?>
							<span><?php echo esc_html( $tfh_hours ); ?></span>
						</p>
					<?php endif; ?>
				</div>

				<?php if ( $tfh_socials ) : ?>
					<ul class="tfh-socials">
						<?php foreach ( $tfh_socials as $tfh_social ) : ?>
							<?php
							$tfh_social_url = isset( $tfh_social['social_url'] ) ? $tfh_social['social_url'] : '';

							if ( ! $tfh_social_url ) {
								continue;
							}

							$tfh_social_icon = isset( $tfh_social['social_icon'] ) ? $tfh_social['social_icon'] : 'auto';

							if ( ! $tfh_social_icon || 'auto' === $tfh_social_icon ) {
								$tfh_social_icon = tfh_icon_from_url( $tfh_social_url );
							}
							?>
							<li>
								<a href="<?php echo esc_url( $tfh_social_url ); ?>" target="_blank" rel="noopener noreferrer">
									<?php tfh_icon( $tfh_social_icon, array( 'size' => 16 ) ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

			</div>

		</div>

	</div>
</section>
