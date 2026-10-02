<?php
/**
 * Front-end and editor assets.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

/**
 * File modification time, used for cache busting during development.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
function tfh_asset_version( $relative_path ) {
	$file = TFH_DIR . ltrim( $relative_path, '/' );

	return file_exists( $file ) ? (string) filemtime( $file ) : TFH_VERSION;
}

/**
 * Enqueue front-end styles and scripts.
 *
 * @return void
 */
function tfh_enqueue_assets() {
	wp_enqueue_style(
		'tfh-fonts',
		'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap',
		array(),
		null // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- external font.
	);

	$stylesheets = array(
		'tfh-tokens' => 'assets/css/tokens.css',
		'tfh-base'   => 'assets/css/base.css',
		'tfh-header' => 'assets/css/header.css',
		'tfh-footer' => 'assets/css/footer.css',
	);

	// Page templates beyond the homepage that reuse its section components
	// (page header, cards, buttons, etc.) plus their own page-specific styles.
	$tfh_page_stylesheets = array(
		'page-about.php'    => 'tfh-about',
		'page-contact.php'  => 'tfh-contact',
		'page-faq.php'      => 'tfh-faq',
		'page-privacy.php'  => 'tfh-privacy',
		'page-services.php' => 'tfh-services',
		'page-location.php' => 'tfh-location',
	);

	$tfh_is_single_service = is_singular( 'tfh_service' );
	$tfh_is_blog           = is_home() || is_singular( 'post' );

	if ( is_page_template( 'page-homepage.php' ) || is_page_template( array_keys( $tfh_page_stylesheets ) ) || $tfh_is_single_service || $tfh_is_blog ) {
		$stylesheets['tfh-home'] = 'assets/css/home.css';
	}

	foreach ( $tfh_page_stylesheets as $tfh_template => $tfh_handle ) {
		if ( is_page_template( $tfh_template ) ) {
			$stylesheets[ $tfh_handle ] = 'assets/css/' . substr( $tfh_handle, 4 ) . '.css';
		}
	}

	// The single Service template reuses the FAQ page's accordion styles for
	// its own service-specific FAQ and the Service Listing page's "Our
	// Process" styles for the shared process section, plus its own small
	// stylesheet.
	if ( $tfh_is_single_service ) {
		$stylesheets['tfh-faq']      = 'assets/css/faq.css';
		$stylesheets['tfh-services'] = 'assets/css/services.css';
		$stylesheets['tfh-service']  = 'assets/css/service.css';
		$stylesheets['tfh-service-flex'] = 'assets/css/service-flex.css';
	}

	// The Location template reuses the About page's stat-row/values-grid
	// styles and the FAQ page's accordion styles.
	if ( is_page_template( 'page-location.php' ) ) {
		$stylesheets['tfh-about'] = 'assets/css/about.css';
		$stylesheets['tfh-faq']   = 'assets/css/faq.css';
	}

	if ( $tfh_is_blog ) {
		$stylesheets['tfh-blog'] = 'assets/css/blog.css';
	}

	$deps = array( 'tfh-fonts' );

	foreach ( $stylesheets as $handle => $path ) {
		wp_enqueue_style( $handle, TFH_URI . $path, $deps, tfh_asset_version( $path ) );
		$deps[] = $handle;
	}

	// style.css last so child themes and users can override everything above.
	wp_enqueue_style( 'tfh-style', get_stylesheet_uri(), $deps, tfh_asset_version( 'style.css' ) );

	wp_enqueue_script(
		'tfh-navigation',
		TFH_URI . 'assets/js/navigation.js',
		array(),
		tfh_asset_version( 'assets/js/navigation.js' ),
		true
	);

	wp_localize_script(
		'tfh-navigation',
		'tfhNav',
		array(
			'openLabel'  => __( 'Open menu', 'tank-free-home' ),
			'closeLabel' => __( 'Close menu', 'tank-free-home' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tfh_enqueue_assets' );

/**
 * Load the design tokens inside the block editor so colors match the front end.
 *
 * @return void
 */
function tfh_editor_assets() {
	add_editor_style(
		array(
			'assets/css/tokens.css',
			'assets/css/base.css',
			'assets/css/home.css',
		)
	);
}
add_action( 'after_setup_theme', 'tfh_editor_assets' );

/**
 * Preconnect to the Google Fonts hosts.
 *
 * @param array  $urls          URLs to print.
 * @param string $relation_type Relation type.
 * @return array
 */
function tfh_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type && wp_style_is( 'tfh-fonts', 'queue' ) ) {
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'tfh_resource_hints', 10, 2 );
