<?php
/**
 * Template Name: Service Listing
 * Template Post Type: page
 *
 * The Tank Free Home service listing page: a paginated grid of every
 * service, an "Our Process" walkthrough, and the homepage's "Why Choose Us"
 * section. Edit the listing under the "Service Listing Page Sections" panel
 * below the editor; Our Process and Why Choose Us are shared across
 * templates and edited from Theme Settings -> Site Sections instead.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered between the page header and the footer CTA, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$tfh_services_page_sections = apply_filters(
	'tfh_services_page_sections',
	array( 'services_listing' )
);
?>

<main id="main" class="tfh-site-main tfh-services-page">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page-header', null, array( 'subtitle_field' => 'services_header_subtitle' ) );

		foreach ( $tfh_services_page_sections as $tfh_section ) {
			if ( tfh_section_enabled( $tfh_section ) ) {
				get_template_part( 'template-parts/sections/' . $tfh_section );
			}
		}

		// Shared across templates and edited from Theme Settings -> Site Sections.
		if ( tfh_section_enabled( 'process', 'option' ) ) {
			get_template_part( 'template-parts/sections/process' );
		}

		if ( tfh_section_enabled( 'why', 'option' ) ) {
			get_template_part( 'template-parts/sections/why' );
		}

		// Anything typed into the editor renders after the designed sections.
		$tfh_editor_content = trim( get_the_content() );

		if ( $tfh_editor_content ) :
			?>
			<div class="tfh-section">
				<div class="tfh-container tfh-entry-content">
					<?php the_content(); ?>
				</div>
			</div>
			<?php
		endif;

	endwhile;
	?>

</main>

<?php
get_footer();
