<?php
/**
 * The site header.
 *
 * Top bar, logo, primary navigation and the "Book Now" CTA. Every string,
 * image and toggle below is editable in the admin under Theme Settings →
 * Header (Secure Custom Fields options page).
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_topbar_enable = (bool) tfh_option( 'header_topbar_enable' );
$tfh_topbar_cta     = tfh_link( tfh_option( 'header_topbar_cta' ), __( 'Book Now', 'tank-free-home' ) );
$tfh_topbar_socials = tfh_rows( 'header_topbar_socials' );

$tfh_phone = tfh_option( 'brand_phone' );
$tfh_email = tfh_option( 'brand_email' );

$tfh_style = tfh_option( 'header_style' );

$tfh_header_classes = array( 'tfh-header' );

if ( 'overlay' === $tfh_style && is_front_page() ) {
	$tfh_header_classes[] = 'tfh-header--overlay';
} elseif ( 'sticky' === $tfh_style ) {
	$tfh_header_classes[] = 'tfh-header--sticky';
} else {
	$tfh_header_classes[] = 'tfh-header--solid';
}

$tfh_logo        = tfh_header_logo_src();
$tfh_logo_height = absint( tfh_option( 'header_logo_height' ) );
$tfh_logo_height = $tfh_logo_height ? $tfh_logo_height : 40;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#tfh-content"><?php esc_html_e( 'Skip to content', 'tank-free-home' ); ?></a>

<div id="page" class="tfh-site">

	<?php if ( $tfh_topbar_enable && ( $tfh_phone || $tfh_email || $tfh_topbar_cta || $tfh_topbar_socials ) ) : ?>
		<div class="tfh-topbar">
			<div class="tfh-container tfh-topbar__inner">

				<div class="tfh-topbar__contact">
					<?php if ( $tfh_phone ) : ?>
						<a class="tfh-topbar__item" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $tfh_phone ) ); ?>">
							<?php tfh_icon( 'phone', array( 'size' => 15 ) ); ?>
							<span><?php echo esc_html( $tfh_phone ); ?></span>
						</a>
					<?php endif; ?>

					<?php if ( $tfh_email ) : ?>
						<a class="tfh-topbar__item" href="mailto:<?php echo esc_attr( sanitize_email( $tfh_email ) ); ?>">
							<?php tfh_icon( 'mail', array( 'size' => 15 ) ); ?>
							<span><?php echo esc_html( $tfh_email ); ?></span>
						</a>
					<?php endif; ?>
				</div>

				<div class="tfh-topbar__aside">
					<?php if ( $tfh_topbar_socials ) : ?>
						<ul class="tfh-topbar__socials">
							<?php foreach ( $tfh_topbar_socials as $tfh_social ) : ?>
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
										<?php tfh_icon( $tfh_social_icon, array( 'size' => 13 ) ); ?>
										<span class="screen-reader-text"><?php echo esc_html( $tfh_social_label ); ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ( $tfh_topbar_cta ) : ?>
						<a class="tfh-topbar__cta"<?php echo tfh_link_attrs( $tfh_topbar_cta ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in tfh_link_attrs(). ?>>
							<?php tfh_icon( 'calendar-check', array( 'size' => 15 ) ); ?>
							<?php echo esc_html( $tfh_topbar_cta['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>

			</div>
		</div>
	<?php endif; ?>

	<header id="masthead" class="<?php echo esc_attr( implode( ' ', $tfh_header_classes ) ); ?>">
		<div class="tfh-container tfh-header__inner">

			<?php // ---------------------------------------------------------- Branding ?>
			<a class="tfh-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php if ( $tfh_logo['url'] ) : ?>
					<img
						class="tfh-branding__logo"
						src="<?php echo esc_url( $tfh_logo['url'] ); ?>"
						alt="<?php echo esc_attr( $tfh_logo['alt'] ? $tfh_logo['alt'] : get_bloginfo( 'name' ) ); ?>"
						style="height:<?php echo esc_attr( $tfh_logo_height ); ?>px"
						decoding="async"
					>
				<?php else : ?>
					<span class="tfh-branding__text">
						<span class="tfh-branding__name"><?php bloginfo( 'name' ); ?></span>
						<?php $tfh_tagline = get_bloginfo( 'description', 'display' ); ?>
						<?php if ( $tfh_tagline ) : ?>
							<span class="tfh-branding__tagline"><?php echo esc_html( $tfh_tagline ); ?></span>
						<?php endif; ?>
					</span>
				<?php endif; ?>
			</a>

			<?php // ---------------------------------------------------------- Navigation ?>
			<nav id="tfh-primary-nav" class="tfh-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'tank-free-home' ); ?>">

				<button
					class="tfh-nav__close"
					type="button"
					aria-label="<?php esc_attr_e( 'Close menu', 'tank-free-home' ); ?>"
				>
					<?php tfh_icon( 'x', array( 'size' => 18 ) ); ?>
				</button>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_id'        => 'tfh-primary-menu',
						'menu_class'     => 'tfh-nav__list',
						'depth'          => 2,
						'fallback_cb'    => 'tfh_fallback_menu',
					)
				);
				?>
			</nav>

			<?php // ---------------------------------------------------------- Actions ?>
			<div class="tfh-header__actions">

				<button
					class="tfh-menu-toggle"
					type="button"
					aria-controls="tfh-primary-nav"
					aria-expanded="false"
					aria-label="<?php esc_attr_e( 'Open menu', 'tank-free-home' ); ?>"
				>
					<span class="tfh-menu-toggle__bars" aria-hidden="true"></span>
				</button>

			</div>

		</div>
	</header>

	<div id="tfh-content" class="tfh-site-content">
