<?php
/**
 * Single Service template.
 *
 * The detail page for one entry in the Service custom post type: page
 * header, overview, a checklist, common signs, the shared process and "why
 * choose us" sections (reused from the homepage so they never drift out of
 * sync), related services, testimonials, and a service-specific FAQ.
 *
 * Fields specific to this template are edited from each Service's own edit
 * screen, under "Service Card" -> "Detail Page".
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered between the page header and the shared Process/Why
 * Choose Us/Testimonials blocks, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$tfh_service_sections = apply_filters(
	'tfh_single_service_sections',
	array( 'service_overview', 'service_checklist', 'service_signs' )
);
?>

<main id="main" class="tfh-site-main tfh-service-page">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part(
			'template-parts/page-header',
			null,
			array(
				'subtitle' => get_the_excerpt(),
				'parent'   => array(
					'label' => __( 'Our Services', 'tank-free-home' ),
					'url'   => tfh_url_by_template( 'page-services.php' ),
				),
			)
		);

		foreach ( $tfh_service_sections as $tfh_section ) {
			get_template_part( 'template-parts/sections/' . $tfh_section );
		}

		// Shared across templates and edited from Theme Settings -> Site Sections.
		if ( tfh_section_enabled( 'process', 'option' ) ) {
			get_template_part( 'template-parts/sections/process' );
		}

		if ( tfh_section_enabled( 'why', 'option' ) ) {
			get_template_part( 'template-parts/sections/why' );
		}

		get_template_part( 'template-parts/sections/service_related' );

		if ( tfh_section_enabled( 'testimonials', 'option' ) ) {
			get_template_part( 'template-parts/sections/testimonials' );
		}

		get_template_part( 'template-parts/sections/service_faq' );

	endwhile;
	?>

</main>

<?php
get_footer();
