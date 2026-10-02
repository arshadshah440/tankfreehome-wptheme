<?php
/**
 * Tank Free Home - Theme bootstrap.
 *
 * This file only defines constants and loads the modules in /inc.
 * Keep feature code in its own module rather than adding it here.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme constants.
 */
define( 'TFH_VERSION', '1.0.0' );
define( 'TFH_DIR', trailingslashit( get_template_directory() ) );
define( 'TFH_URI', trailingslashit( get_template_directory_uri() ) );

/**
 * Load theme modules.
 *
 * @return void
 */
function tfh_load_modules() {
	$modules = array(
		'setup',          // Theme supports, menus, image sizes.
		'enqueue',        // Styles and scripts.
		'icons',          // Inline SVG icon library.
		'post-types',     // Service, Testimonial and Project custom post types.
		'template-tags',  // Reusable template helpers.
		'scf',            // Secure Custom Fields options pages + JSON sync.
		'seo',            // Per-entry SEO title / meta description overrides.
		'defaults',       // Fallback content used before fields are filled in.
		'contact-form',   // Contact page form submission handler.
	);

	foreach ( $modules as $module ) {
		$file = TFH_DIR . 'inc/' . $module . '.php';

		if ( is_readable( $file ) ) {
			require_once $file;
		}
	}
}
tfh_load_modules();
