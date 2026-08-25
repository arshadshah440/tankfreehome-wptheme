<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 *
 * The Tank Free Home landing page, built section by section. Assign this
 * template to a page and edit every section under the "Homepage Sections"
 * panel below the editor.
 *
 * Each section lives in its own template part so it can be reused, reordered
 * or overridden from a child theme.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Sections rendered on the homepage, in order.
 *
 * @param array $sections Slugs matching template-parts/sections/{slug}.php.
 */
$tfh_sections = apply_filters(
	'tfh_homepage_sections',
	array( 'hero', 'about', 'expertise', 'services', 'why', 'projects', 'testimonials' )
);

// These sections are shared across multiple templates and edited from
// Theme Settings -> Site Sections, rather than from this page's own fields.
$tfh_option_sections = array( 'why', 'testimonials' );
?>

<main id="main" class="tfh-site-main tfh-home">

	<?php
	while ( have_posts() ) :
		the_post();

		foreach ( $tfh_sections as $tfh_section ) {
			$tfh_context = in_array( $tfh_section, $tfh_option_sections, true ) ? 'option' : 'post';

			if ( tfh_section_enabled( $tfh_section, $tfh_context ) ) {
				get_template_part( 'template-parts/sections/' . $tfh_section );
			}
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
