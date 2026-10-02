<?php
/**
 * Per-entry SEO title / meta description overrides.
 *
 * Reads the "SEO" tab fields on singular tfh_service entries. No SEO plugin
 * is active on this install, so this is the only source for these tags.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

/**
 * Override the <title> tag when a service has its own SEO Title set.
 *
 * @param array $title_parts Document title parts.
 * @return array
 */
function tfh_seo_document_title_parts( $title_parts ) {
	if ( ! is_singular( 'tfh_service' ) ) {
		return $title_parts;
	}

	$tfh_seo_title = tfh_field( 'service_seo_title', '' );

	if ( $tfh_seo_title ) {
		$title_parts['title'] = $tfh_seo_title;
	}

	return $title_parts;
}
add_filter( 'document_title_parts', 'tfh_seo_document_title_parts' );

/**
 * Print a meta description tag on singular tfh_service entries.
 *
 * @return void
 */
function tfh_seo_meta_description() {
	if ( ! is_singular( 'tfh_service' ) ) {
		return;
	}

	$tfh_description = tfh_field( 'service_seo_description', '' );

	if ( ! $tfh_description ) {
		$tfh_description = get_the_excerpt();
	}

	if ( $tfh_description ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $tfh_description ) );
	}
}
add_action( 'wp_head', 'tfh_seo_meta_description', 1 );
