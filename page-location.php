<?php
/**
 * Template Name: Location
 * Template Post Type: page
 *
 * The Tank Free Home location page template, assignable to one page per
 * service area (e.g. California, Oregon, Washington, Florida). The page's
 * own title becomes the location name throughout. Services, Why Choose Us,
 * and Testimonials are reused site-wide sections, not duplicated per
 * location. Edit everything else under the "Location Page Sections" panel
 * below the editor.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered between the page header and the shared Why Choose
 * Us/Services/Testimonials blocks, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$tfh_location_sections = apply_filters(
	'tfh_location_sections',
	array( 'location_stats' )
);
?>

<main id="main" class="tfh-site-main tfh-location-page">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page-header', null, array( 'subtitle_field' => 'location_header_subtitle' ) );

		foreach ( $tfh_location_sections as $tfh_section ) {
			if ( tfh_section_enabled( $tfh_section ) ) {
				get_template_part( 'template-parts/sections/' . $tfh_section );
			}
		}

		// Shared across templates and edited from Theme Settings -> Site Sections.
		if ( tfh_section_enabled( 'why', 'option' ) ) {
			get_template_part( 'template-parts/sections/why' );
		}

		get_template_part( 'template-parts/sections/services' );

		if ( tfh_section_enabled( 'location_insights' ) ) {
			get_template_part( 'template-parts/sections/location_insights' );
		}

		if ( tfh_section_enabled( 'testimonials', 'option' ) ) {
			get_template_part( 'template-parts/sections/testimonials' );
		}

		if ( tfh_section_enabled( 'location_area' ) ) {
			get_template_part( 'template-parts/sections/location_area' );
		}

		get_template_part( 'template-parts/sections/location_faq' );

	endwhile;
	?>

</main>

<?php
get_footer();
