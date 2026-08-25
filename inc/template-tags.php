<?php
/**
 * Reusable template helpers.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

/**
 * Normalise an SCF/ACF image value into a URL + alt pair.
 *
 * Accepts the array, ID and URL return formats.
 *
 * @param mixed  $image Field value.
 * @param string $size  Image size for ID/array values.
 * @return array{url:string,alt:string,width:int,height:int}
 */
function tfh_image( $image, $size = 'full' ) {
	$result = array(
		'url'    => '',
		'alt'    => '',
		'width'  => 0,
		'height' => 0,
	);

	if ( empty( $image ) ) {
		return $result;
	}

	if ( is_array( $image ) ) {
		$id = isset( $image['ID'] ) ? (int) $image['ID'] : ( isset( $image['id'] ) ? (int) $image['id'] : 0 );

		if ( $id ) {
			return tfh_image( $id, $size );
		}

		$result['url'] = isset( $image['url'] ) ? $image['url'] : '';
		$result['alt'] = isset( $image['alt'] ) ? $image['alt'] : '';

		return $result;
	}

	if ( is_numeric( $image ) ) {
		$src = wp_get_attachment_image_src( (int) $image, $size );

		if ( $src ) {
			$result['url']    = $src[0];
			$result['width']  = (int) $src[1];
			$result['height'] = (int) $src[2];
			$result['alt']    = (string) get_post_meta( (int) $image, '_wp_attachment_image_alt', true );
		}

		return $result;
	}

	$result['url'] = (string) $image;

	return $result;
}

/**
 * URL of the theme's bundled "no photo yet" placeholder graphic.
 *
 * Used for front-end content images only (hero/about/project photos, card
 * thumbnails, etc.) when the matching field or featured image hasn't been
 * set - never for CSS background images, which already degrade gracefully.
 *
 * @return string
 */
function tfh_placeholder_image_url() {
	return TFH_URI . 'assets/images/placeholder.svg';
}

/**
 * Normalise an SCF/ACF link value.
 *
 * @param mixed  $link          Field value (array, URL string or empty).
 * @param string $default_title Fallback label.
 * @return array{url:string,title:string,target:string}|null Null when there is no URL.
 */
function tfh_link( $link, $default_title = '' ) {
	if ( empty( $link ) ) {
		return null;
	}

	if ( is_string( $link ) ) {
		$link = array( 'url' => $link );
	}

	if ( ! is_array( $link ) || empty( $link['url'] ) ) {
		return null;
	}

	$title = isset( $link['title'] ) && '' !== $link['title'] ? $link['title'] : $default_title;

	return array(
		'url'    => $link['url'],
		'title'  => $title,
		'target' => ! empty( $link['target'] ) ? $link['target'] : '',
	);
}

/**
 * Build safe href/target/rel attributes for a normalised link.
 *
 * @param array $link Result of tfh_link().
 * @return string
 */
function tfh_link_attrs( $link ) {
	if ( ! $link ) {
		return '';
	}

	$attrs = ' href="' . esc_url( $link['url'] ) . '"';

	if ( '_blank' === $link['target'] ) {
		$attrs .= ' target="_blank" rel="noopener noreferrer"';
	}

	return $attrs;
}

/**
 * Resolve the header logo, falling back to the WordPress custom logo and then
 * to the logo shipped with the theme.
 *
 * @return array{url:string,alt:string}
 */
function tfh_header_logo_src() {
	$image = tfh_image( tfh_option( 'header_logo' ), 'full' );

	if ( $image['url'] ) {
		return $image;
	}

	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( $custom_logo_id ) {
		$image = tfh_image( $custom_logo_id, 'full' );

		if ( $image['url'] ) {
			return $image;
		}
	}

	$bundled = TFH_DIR . 'assets/images/logo.png';

	if ( file_exists( $bundled ) ) {
		return array(
			'url' => TFH_URI . 'assets/images/logo.png',
			'alt' => get_bloginfo( 'name' ),
		);
	}

	return array(
		'url' => '',
		'alt' => '',
	);
}

/**
 * Resolve the footer logo.
 *
 * @return array{url:string,alt:string}
 */
function tfh_footer_logo_src() {
	$image = tfh_image( tfh_option( 'footer_logo' ), 'full' );

	if ( $image['url'] ) {
		return $image;
	}

	$bundled = TFH_DIR . 'assets/images/logo-white.png';

	if ( file_exists( $bundled ) ) {
		return array(
			'url' => TFH_URI . 'assets/images/logo-white.png',
			'alt' => get_bloginfo( 'name' ),
		);
	}

	return array(
		'url' => '',
		'alt' => '',
	);
}

/**
 * Get the repeater rows for an options-page field, using defaults when empty.
 *
 * @param string $field Field name.
 * @return array<int, array>
 */
function tfh_rows( $field ) {
	$rows = tfh_option( $field );

	return is_array( $rows ) ? $rows : array();
}

/**
 * Render the copyright line, expanding {year} and {sitename}.
 *
 * @return string
 */
function tfh_copyright_text() {
	$text = (string) tfh_option( 'footer_copyright' );

	return strtr(
		$text,
		array(
			'{year}'     => date_i18n( 'Y' ),
			'{sitename}' => get_bloginfo( 'name' ),
		)
	);
}

/**
 * Fallback header menu shown before a menu is assigned to the Primary location.
 *
 * @return void
 */
function tfh_fallback_menu() {
	echo '<ul id="tfh-primary-menu" class="tfh-nav__list">';

	wp_list_pages(
		array(
			'title_li'    => '',
			'depth'       => 1,
			'number'      => 5,
			'sort_column' => 'menu_order, post_title',
		)
	);

	echo '</ul>';
}

/**
 * Output brand colour overrides as CSS custom properties.
 *
 * Only prints declarations that differ from the design defaults.
 *
 * @return void
 */
function tfh_brand_inline_css() {
	$map = array(
		'--tfh-accent' => array( 'brand_primary_color', '#F60101' ),
		'--tfh-navy'   => array( 'brand_secondary_color', '#0B2A4A' ),
		'--tfh-ink'    => array( 'brand_ink_color', '#101E30' ),
		'--tfh-grey-500' => array( 'brand_body_color', '#5C6B7A' ),
	);

	$declarations = array();

	foreach ( $map as $property => $config ) {
		list( $field, $default ) = $config;

		$value = tfh_option( $field );

		if ( ! is_string( $value ) || '' === $value ) {
			continue;
		}

		if ( 0 === strcasecmp( $value, $default ) ) {
			continue;
		}

		if ( ! preg_match( '/^#([0-9a-f]{3}|[0-9a-f]{6})$/i', $value ) ) {
			continue;
		}

		$declarations[] = $property . ':' . $value . ';';

		if ( '--tfh-accent' === $property ) {
			list( $r, $g, $b ) = sscanf( tfh_hex_expand( $value ), '#%02x%02x%02x' );

			$declarations[] = sprintf( '--tfh-accent-10:rgba(%d,%d,%d,0.1);', $r, $g, $b );
			$declarations[] = sprintf( '--tfh-accent-20:rgba(%d,%d,%d,0.2);', $r, $g, $b );
			$declarations[] = sprintf( '--tfh-accent-dark:%s;', tfh_shade( $value, -0.16 ) );
		}

		if ( '--tfh-navy' === $property ) {
			$declarations[] = sprintf( '--tfh-navy-dark:%s;', tfh_shade( $value, -0.18 ) );
		}
	}

	if ( ! $declarations ) {
		return;
	}

	wp_add_inline_style( 'tfh-tokens', ':root{' . implode( '', $declarations ) . '}' );
}
add_action( 'wp_enqueue_scripts', 'tfh_brand_inline_css', 20 );

/**
 * Expand a 3-digit hex colour to 6 digits.
 *
 * @param string $hex Hex colour.
 * @return string
 */
function tfh_hex_expand( $hex ) {
	$hex = ltrim( $hex, '#' );

	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	return '#' . $hex;
}

/**
 * Lighten or darken a hex colour.
 *
 * @param string $hex    Hex colour.
 * @param float  $amount Between -1 (black) and 1 (white).
 * @return string
 */
function tfh_shade( $hex, $amount ) {
	list( $r, $g, $b ) = sscanf( tfh_hex_expand( $hex ), '#%02x%02x%02x' );

	$adjust = function ( $channel ) use ( $amount ) {
		$target = $amount < 0 ? 0 : 255;

		return (int) round( $channel + ( $target - $channel ) * abs( $amount ) );
	};

	return sprintf( '#%02x%02x%02x', $adjust( $r ), $adjust( $g ), $adjust( $b ) );
}

/**
 * Read a field from the current post (used by the homepage template).
 *
 * Falls back to tfh_default() so the page renders sensibly before anything
 * has been filled in, and works even with no fields plugin installed.
 *
 * @param string   $selector Field name.
 * @param mixed    $fallback Optional explicit fallback. Null uses tfh_default().
 * @param int|null $post_id  Optional post ID. Defaults to the current post.
 * @return mixed
 */
function tfh_field( $selector, $fallback = null, $post_id = null ) {
	$value = null;

	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $selector, $post_id );
	}

	$is_empty = ( null === $value || '' === $value || array() === $value || false === $value );

	if ( $is_empty ) {
		return ( null === $fallback ) ? tfh_default( $selector ) : $fallback;
	}

	return $value;
}

/**
 * Repeater rows from the current post, falling back to the defaults.
 *
 * @param string   $selector Field name.
 * @param int|null $post_id  Optional post ID.
 * @return array<int, array>
 */
function tfh_field_rows( $selector, $post_id = null ) {
	$rows = tfh_field( $selector, null, $post_id );

	return is_array( $rows ) ? $rows : array();
}

/**
 * Is a section switched on?
 *
 * Sections default to visible, so a brand new page shows the full design.
 *
 * @param string $section Section slug, e.g. "hero".
 * @param string $context "post" (default) reads the current post/page's own
 *                        field. "option" reads it from Theme Settings
 *                        instead, for sections shared across templates
 *                        (Why Choose Us, Our Process, Testimonials) that
 *                        aren't tied to one specific page.
 * @return bool
 */
function tfh_section_enabled( $section, $context = 'post' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return true;
	}

	$value = ( 'option' === $context )
		? get_field( $section . '_enable', 'option' )
		: get_field( $section . '_enable' );

	return ( null === $value ) ? true : (bool) $value;
}

/**
 * Find the published page assigned a given custom page template.
 *
 * @param string $template Template file name, e.g. "page-homepage.php".
 * @return string Permalink, or '' when no page uses that template.
 */
function tfh_url_by_template( $template ) {
	static $cache = array();

	if ( array_key_exists( $template, $cache ) ) {
		return $cache[ $template ];
	}

	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'no_found_rows'  => true,
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => $template, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		)
	);

	$url = $pages ? get_permalink( $pages[0] ) : '';

	$cache[ $template ] = $url ? $url : '';

	return $cache[ $template ];
}

/**
 * Find the published page using the Projects Listing template.
 *
 * @return string Permalink, or the Project post type archive as a fallback.
 */
function tfh_projects_listing_url() {
	$url = tfh_url_by_template( 'page-projects.php' );

	return $url ? $url : (string) get_post_type_archive_link( 'tfh_project' );
}

/**
 * Render the small accent eyebrow label used above every section title.
 *
 * @param string $text Label text.
 * @return void
 */
function tfh_eyebrow( $text ) {
	if ( ! $text ) {
		return;
	}

	printf(
		'<p class="tfh-eyebrow"><span>%1$s</span></p>',
		esc_html( $text )
	);
}

/**
 * Render a pill button with a trailing circular arrow.
 *
 * @param mixed  $link          SCF link value or URL string.
 * @param string $default_title Fallback label.
 * @param string $variant       "", "navy", "white" or "outline".
 * @return void
 */
function tfh_btn_arrow( $link, $default_title = '', $variant = '' ) {
	$link = tfh_link( $link, $default_title );

	if ( ! $link ) {
		return;
	}

	$class = 'tfh-btn-arrow';

	if ( $variant ) {
		$class .= ' tfh-btn-arrow--' . sanitize_html_class( $variant );
	}

	printf(
		'<a class="%1$s"%2$s><span class="tfh-btn-arrow__label">%3$s</span><span class="tfh-btn-arrow__icon">%4$s</span></a>',
		esc_attr( $class ),
		tfh_link_attrs( $link ), // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in tfh_link_attrs().
		esc_html( $link['title'] ),
		tfh_get_icon( 'arrow-right', array( 'size' => 18 ) ) // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- built and escaped in tfh_get_icon().
	);
}

/**
 * Render a heading where the last N words are highlighted in the accent colour.
 *
 * @param string $text      Full heading text.
 * @param int    $highlight Number of trailing words to accent. 0 disables.
 * @param string $tag       HTML tag. Default h2.
 * @param string $class     Extra CSS class.
 * @return void
 */
function tfh_split_heading( $text, $highlight = 1, $tag = 'h2', $class = '' ) {
	$text = trim( (string) $text );

	if ( '' === $text ) {
		return;
	}

	$tag       = preg_match( '/^h[1-6]$/', $tag ) ? $tag : 'h2';
	$classes   = trim( 'tfh-heading ' . $class );
	$highlight = max( 0, (int) $highlight );
	$words     = preg_split( '/\s+/', $text );

	if ( $highlight > 0 && count( $words ) > $highlight ) {
		$accent = array_splice( $words, -$highlight );

		$inner = esc_html( implode( ' ', $words ) ) . ' <span class="tfh-heading__accent">'
			. esc_html( implode( ' ', $accent ) ) . '</span>';
	} else {
		$inner = esc_html( $text );
	}

	printf(
		'<%1$s class="%2$s">%3$s</%1$s>',
		esc_attr( $tag ),
		esc_attr( $classes ),
		$inner // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- each part escaped above.
	);
}

/**
 * Accent the leading word of a short line of text (e.g. "24/7 Customer Support...").
 *
 * @param string $text Full text.
 * @return string Escaped HTML with the first word wrapped in an accent span.
 */
function tfh_lead_highlight( $text ) {
	$text = trim( (string) $text );

	if ( '' === $text ) {
		return '';
	}

	$words = preg_split( '/\s+/', $text );
	$lead  = array_shift( $words );

	if ( ! $words ) {
		return '<span class="tfh-lead-accent">' . esc_html( $lead ) . '</span>';
	}

	return '<span class="tfh-lead-accent">' . esc_html( $lead ) . '</span> ' . esc_html( implode( ' ', $words ) );
}

/**
 * Render a five-star rating row.
 *
 * @param float $rating Rating out of 5.
 * @return void
 */
function tfh_stars( $rating = 5 ) {
	$rating = max( 0, min( 5, (float) $rating ) );
	$full   = (int) round( $rating );

	echo '<span class="tfh-stars" role="img" aria-label="'
		/* translators: %s: rating out of five. */
		. esc_attr( sprintf( __( '%s out of 5 stars', 'tank-free-home' ), number_format_i18n( $rating, 1 ) ) )
		. '">';

	for ( $i = 1; $i <= 5; $i++ ) {
		$class = $i <= $full ? 'tfh-stars__star is-on' : 'tfh-stars__star';
		echo '<span class="' . esc_attr( $class ) . '">';
		tfh_icon( 'star', array( 'size' => 16 ) );
		echo '</span>';
	}

	echo '</span>';
}

/**
 * Print the post date and author for the blog card.
 *
 * @return void
 */
function tfh_posted_on() {
	printf(
		'<span class="tfh-entry__meta-item"><time datetime="%1$s">%2$s</time></span><span class="tfh-entry__meta-item">%3$s</span>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_html( get_the_author() )
	);
}
