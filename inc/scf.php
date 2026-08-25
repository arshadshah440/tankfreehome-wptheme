<?php
/**
 * Secure Custom Fields (SCF) / Advanced Custom Fields integration.
 *
 * Registers the "Theme Settings" options page with Header, Footer and Brand
 * sub-pages, and points SCF at the theme's /acf-json folder so every field
 * group lives in version control.
 *
 * SCF is the WordPress.org maintained fork of ACF and exposes the same
 * `acf_*` function names, so this file works with either plugin.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

/**
 * Is a compatible fields plugin active?
 *
 * @return bool
 */
function tfh_has_scf() {
	return function_exists( 'acf_add_options_page' ) && function_exists( 'get_field' );
}

/**
 * Register the Theme Settings options pages.
 *
 * @return void
 */
function tfh_register_options_pages() {
	if ( ! tfh_has_scf() ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title'      => __( 'Theme Settings', 'tank-free-home' ),
			'menu_title'      => __( 'Theme Settings', 'tank-free-home' ),
			'menu_slug'       => 'tfh-theme-settings',
			'capability'      => 'edit_theme_options',
			'icon_url'        => 'dashicons-admin-customizer',
			'position'        => 59,
			'redirect'        => true,
			'update_button'   => __( 'Save Settings', 'tank-free-home' ),
			'updated_message' => __( 'Theme settings saved.', 'tank-free-home' ),
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Header Settings', 'tank-free-home' ),
			'menu_title'  => __( 'Header', 'tank-free-home' ),
			'menu_slug'   => 'tfh-header-settings',
			'parent_slug' => 'tfh-theme-settings',
			'capability'  => 'edit_theme_options',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Footer Settings', 'tank-free-home' ),
			'menu_title'  => __( 'Footer', 'tank-free-home' ),
			'menu_slug'   => 'tfh-footer-settings',
			'parent_slug' => 'tfh-theme-settings',
			'capability'  => 'edit_theme_options',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Brand &amp; Contact', 'tank-free-home' ),
			'menu_title'  => __( 'Brand &amp; Contact', 'tank-free-home' ),
			'menu_slug'   => 'tfh-brand-settings',
			'parent_slug' => 'tfh-theme-settings',
			'capability'  => 'edit_theme_options',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Site Sections', 'tank-free-home' ),
			'menu_title'  => __( 'Site Sections', 'tank-free-home' ),
			'menu_slug'   => 'tfh-sections-settings',
			'parent_slug' => 'tfh-theme-settings',
			'capability'  => 'edit_theme_options',
		)
	);
}
add_action( 'acf/init', 'tfh_register_options_pages' );

/**
 * Save new/updated field groups into the theme's acf-json folder.
 *
 * @param string $path Default save path.
 * @return string
 */
function tfh_acf_json_save_point( $path ) {
	return TFH_DIR . 'acf-json';
}
add_filter( 'acf/settings/save_json', 'tfh_acf_json_save_point' );

/**
 * Load field groups from the theme's acf-json folder.
 *
 * @param array $paths Existing load paths.
 * @return array
 */
function tfh_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = TFH_DIR . 'acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'tfh_acf_json_load_point' );

/**
 * Warn administrators when the fields plugin is missing, since the header and
 * footer fall back to placeholder content without it.
 *
 * @return void
 */
function tfh_scf_missing_notice() {
	if ( tfh_has_scf() || ! current_user_can( 'install_plugins' ) ) {
		return;
	}

	$screen = get_current_screen();

	if ( $screen && ! in_array( $screen->id, array( 'dashboard', 'themes', 'plugins' ), true ) ) {
		return;
	}

	$install_url = wp_nonce_url(
		self_admin_url( 'plugin-install.php?tab=search&s=secure+custom+fields' ),
		'install-plugin'
	);

	printf(
		'<div class="notice notice-warning"><p><strong>%1$s</strong> %2$s <a href="%3$s">%4$s</a></p></div>',
		esc_html__( 'Tank Free Home:', 'tank-free-home' ),
		esc_html__( 'the header, footer and homepage are edited through Secure Custom Fields (or ACF). Install and activate one of them to unlock Theme Settings &rarr; Header / Footer and the Homepage Sections panel. Until then the theme shows placeholder content.', 'tank-free-home' ),
		esc_url( $install_url ),
		esc_html__( 'Install Secure Custom Fields', 'tank-free-home' )
	);
}
add_action( 'admin_notices', 'tfh_scf_missing_notice' );

/**
 * Read a value from the Theme Settings options pages.
 *
 * Falls back to tfh_default() so templates always render something sensible,
 * including on a fresh install with no fields plugin present.
 *
 * @param string $selector Field name.
 * @param mixed  $fallback Optional explicit fallback. When null the value from
 *                         tfh_default() is used.
 * @return mixed
 */
function tfh_option( $selector, $fallback = null ) {
	$value = null;

	if ( tfh_has_scf() ) {
		$value = get_field( $selector, 'option' );
	}

	$is_empty = ( null === $value || '' === $value || array() === $value || false === $value );

	if ( $is_empty ) {
		return ( null === $fallback ) ? tfh_default( $selector ) : $fallback;
	}

	return $value;
}

/**
 * Read a sub value from a repeater row while inside have_rows().
 *
 * @param string $selector Sub field name.
 * @param mixed  $fallback Fallback value.
 * @return mixed
 */
function tfh_sub( $selector, $fallback = '' ) {
	if ( ! function_exists( 'get_sub_field' ) ) {
		return $fallback;
	}

	$value = get_sub_field( $selector );

	return ( null === $value || '' === $value ) ? $fallback : $value;
}
