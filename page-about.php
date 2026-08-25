<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 *
 * The Tank Free Home "About Us" page, built section by section to match the
 * homepage template's design. Assign this template to a page and edit every
 * section under the "About Page Sections" panel below the editor.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered between the page header and the Services/Testimonials
 * blocks, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$tfh_about_sections = apply_filters(
	'tfh_about_sections',
	array( 'about_story', 'about_stats', 'about_values', 'about_credentials' )
);
?>

<main id="main" class="tfh-site-main tfh-about-page">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page-header', null, array( 'subtitle_field' => 'about_header_subtitle' ) );

		foreach ( $tfh_about_sections as $tfh_section ) {
			if ( tfh_section_enabled( $tfh_section ) ) {
				get_template_part( 'template-parts/sections/' . $tfh_section );
			}
		}

		// The Services and Testimonials sections are shared with the homepage,
		// pulling from the same custom post types.
		get_template_part( 'template-parts/sections/services' );
		get_template_part( 'template-parts/sections/testimonials' );

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
