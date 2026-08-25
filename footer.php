<?php
/**
 * The CTA band and site footer.
 *
 * Every string, image, link and toggle below is editable in the admin under
 * Theme Settings → Footer (Secure Custom Fields options page).
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_cta_enable     = (bool) tfh_option( 'footer_cta_enable' );
$tfh_cta_eyebrow    = tfh_option( 'footer_cta_eyebrow' );
$tfh_cta_title      = tfh_option( 'footer_cta_title' );
$tfh_cta_text       = tfh_option( 'footer_cta_text' );
$tfh_cta_phone_note = tfh_option( 'footer_cta_phone_note' );
$tfh_cta_button     = tfh_link( tfh_option( 'footer_cta_button' ), __( 'Get Started', 'tank-free-home' ) );

$tfh_footer_logo   = tfh_footer_logo_src();
$tfh_footer_height = absint( tfh_option( 'footer_logo_height' ) );
$tfh_footer_height = $tfh_footer_height ? $tfh_footer_height : 46;

$tfh_socials = tfh_rows( 'footer_socials' );

$tfh_links_source = tfh_option( 'footer_links_source' );
$tfh_links        = tfh_rows( 'footer_links' );
$tfh_services     = tfh_rows( 'footer_services' );

$tfh_phone   = tfh_option( 'footer_show_phone' ) ? tfh_option( 'brand_phone' ) : '';
$tfh_email   = tfh_option( 'footer_show_email' ) ? tfh_option( 'brand_email' ) : '';
$tfh_address = tfh_option( 'footer_show_address' ) ? tfh_option( 'brand_address' ) : '';
$tfh_map_url = tfh_option( 'brand_map_url' );
$tfh_contact_text = tfh_option( 'footer_contact_text' );

$tfh_legal = tfh_rows( 'footer_legal_links' );
?>

	</div><!-- #tfh-content -->

	<?php // ------------------------------------------------------------- CTA band ?>
	<?php if ( $tfh_cta_enable ) : ?>
		<section class="tfh-cta-band" aria-labelledby="tfh-cta-title">
			<div class="tfh-container tfh-cta-band__inner">

				<?php tfh_eyebrow( $tfh_cta_eyebrow ); ?>

				<?php if ( $tfh_cta_title ) : ?>
					<h2 class="tfh-cta-band__title" id="tfh-cta-title"><?php echo esc_html( $tfh_cta_title ); ?></h2>
				<?php endif; ?>

				<?php if ( $tfh_cta_text ) : ?>
					<p class="tfh-cta-band__text"><?php echo esc_html( $tfh_cta_text ); ?></p>
				<?php endif; ?>

				<?php if ( $tfh_cta_phone_note ) : ?>
					<p class="tfh-cta-band__note"><?php echo tfh_lead_highlight( $tfh_cta_phone_note ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped inside tfh_lead_highlight(). ?></p>
				<?php endif; ?>

				<?php if ( $tfh_cta_button ) : ?>
					<a class="tfh-btn tfh-btn--accent tfh-cta-band__button"<?php echo tfh_link_attrs( $tfh_cta_button ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in tfh_link_attrs(). ?>>
						<?php echo esc_html( $tfh_cta_button['title'] ); ?>
					</a>
				<?php endif; ?>

			</div>
		</section>
	<?php endif; ?>

	<?php // ------------------------------------------------------------- Footer ?>
	<footer id="colophon" class="tfh-footer">

		<div class="tfh-container tfh-footer__top">

			<?php // ------------------------------------------------- Brand column ?>
			<div class="tfh-footer__brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php if ( $tfh_footer_logo['url'] ) : ?>
						<img
							class="tfh-footer__logo"
							src="<?php echo esc_url( $tfh_footer_logo['url'] ); ?>"
							alt="<?php echo esc_attr( $tfh_footer_logo['alt'] ? $tfh_footer_logo['alt'] : get_bloginfo( 'name' ) ); ?>"
							style="height:<?php echo esc_attr( $tfh_footer_height ); ?>px"
							loading="lazy"
							decoding="async"
						>
					<?php else : ?>
						<span class="tfh-footer__logo--fallback"><?php bloginfo( 'name' ); ?></span>
					<?php endif; ?>
				</a>

				<?php $tfh_about = tfh_option( 'footer_about' ); ?>
				<?php if ( $tfh_about ) : ?>
					<p class="tfh-footer__about"><?php echo nl2br( esc_html( $tfh_about ) ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped above. ?></p>
				<?php endif; ?>

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

							$tfh_social_label = isset( $tfh_social['social_label'] ) && $tfh_social['social_label']
								? $tfh_social['social_label']
								: ucfirst( str_replace( '-', ' ', $tfh_social_icon ) );
							?>
							<li>
								<a href="<?php echo esc_url( $tfh_social_url ); ?>" target="_blank" rel="noopener noreferrer">
									<?php tfh_icon( $tfh_social_icon, array( 'size' => 16 ) ); ?>
									<span class="screen-reader-text"><?php echo esc_html( $tfh_social_label ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<?php // --------------------------------------------- Navigation ?>
			<div class="tfh-footer__col tfh-footer__col--links">
				<?php $tfh_links_title = tfh_option( 'footer_links_title' ); ?>
				<?php if ( $tfh_links_title ) : ?>
					<h2 class="tfh-footer__heading"><?php echo esc_html( $tfh_links_title ); ?></h2>
				<?php endif; ?>

				<?php if ( 'menu' === $tfh_links_source && has_nav_menu( 'footer_links' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_links',
							'container'      => false,
							'menu_class'     => 'tfh-footer__menu',
							'depth'          => 1,
						)
					);
					?>
				<?php elseif ( $tfh_links ) : ?>
					<ul class="tfh-footer__menu">
						<?php foreach ( $tfh_links as $tfh_row ) : ?>
							<?php $tfh_item = tfh_link( isset( $tfh_row['link'] ) ? $tfh_row['link'] : null ); ?>
							<?php if ( ! $tfh_item ) { continue; } ?>
							<li>
								<a<?php echo tfh_link_attrs( $tfh_item ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in tfh_link_attrs(). ?>>
									<?php echo esc_html( $tfh_item['title'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<?php // --------------------------------------------- Services ?>
			<?php if ( $tfh_services ) : ?>
				<div class="tfh-footer__col tfh-footer__col--services">
					<?php $tfh_services_title = tfh_option( 'footer_services_title' ); ?>
					<?php if ( $tfh_services_title ) : ?>
						<h2 class="tfh-footer__heading"><?php echo esc_html( $tfh_services_title ); ?></h2>
					<?php endif; ?>

					<ul class="tfh-footer__menu">
						<?php foreach ( $tfh_services as $tfh_row ) : ?>
							<?php $tfh_item = tfh_link( isset( $tfh_row['link'] ) ? $tfh_row['link'] : null ); ?>
							<?php if ( ! $tfh_item ) { continue; } ?>
							<li>
								<a<?php echo tfh_link_attrs( $tfh_item ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in tfh_link_attrs(). ?>>
									<?php echo esc_html( $tfh_item['title'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php // --------------------------------------------- Contact ?>
			<?php if ( $tfh_contact_text || $tfh_phone || $tfh_email || $tfh_address ) : ?>
				<div class="tfh-footer__col tfh-footer__col--contact">
					<?php $tfh_contact_title = tfh_option( 'footer_contact_title' ); ?>
					<?php if ( $tfh_contact_title ) : ?>
						<h2 class="tfh-footer__heading"><?php echo esc_html( $tfh_contact_title ); ?></h2>
					<?php endif; ?>

					<?php if ( $tfh_contact_text ) : ?>
						<p class="tfh-footer__contact-text"><?php echo esc_html( $tfh_contact_text ); ?></p>
					<?php endif; ?>

					<div class="tfh-footer__contact">

						<?php if ( $tfh_phone ) : ?>
							<p class="tfh-footer__contact-item">
								<?php tfh_icon( 'phone', array( 'size' => 16 ) ); ?>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $tfh_phone ) ); ?>">
									<?php echo esc_html( $tfh_phone ); ?>
								</a>
							</p>
						<?php endif; ?>

						<?php if ( $tfh_email ) : ?>
							<p class="tfh-footer__contact-item">
								<?php tfh_icon( 'mail', array( 'size' => 16 ) ); ?>
								<a href="mailto:<?php echo esc_attr( sanitize_email( $tfh_email ) ); ?>">
									<?php echo esc_html( $tfh_email ); ?>
								</a>
							</p>
						<?php endif; ?>

						<?php if ( $tfh_address ) : ?>
							<p class="tfh-footer__contact-item">
								<?php tfh_icon( 'map-pin', array( 'size' => 16 ) ); ?>
								<?php if ( $tfh_map_url ) : ?>
									<a href="<?php echo esc_url( $tfh_map_url ); ?>" target="_blank" rel="noopener noreferrer">
										<?php echo wp_kses_post( nl2br( $tfh_address ) ); ?>
									</a>
								<?php else : ?>
									<span><?php echo wp_kses_post( nl2br( $tfh_address ) ); ?></span>
								<?php endif; ?>
							</p>
						<?php endif; ?>

					</div>
				</div>
			<?php endif; ?>

		</div><!-- .tfh-footer__top -->

		<?php // ------------------------------------------------- Bottom bar ?>
		<div class="tfh-footer__bottom">
			<div class="tfh-container tfh-footer__bottom-inner">
				<p class="tfh-footer__copyright"><?php echo esc_html( tfh_copyright_text() ); ?></p>

				<?php if ( has_nav_menu( 'footer_legal' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_legal',
							'container'      => false,
							'menu_class'     => 'tfh-footer__legal',
							'depth'          => 1,
						)
					);
					?>
				<?php elseif ( $tfh_legal ) : ?>
					<ul class="tfh-footer__legal">
						<?php foreach ( $tfh_legal as $tfh_row ) : ?>
							<?php $tfh_item = tfh_link( isset( $tfh_row['link'] ) ? $tfh_row['link'] : null ); ?>
							<?php if ( ! $tfh_item ) { continue; } ?>
							<li>
								<a<?php echo tfh_link_attrs( $tfh_item ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in tfh_link_attrs(). ?>>
									<?php echo esc_html( $tfh_item['title'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
