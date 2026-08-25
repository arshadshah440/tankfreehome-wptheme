<?php
/**
 * Template Name: Contact Us
 * Template Post Type: page
 *
 * The Tank Free Home "Contact Us" page: a quick-info card row, then a
 * contact form with a sidebar of contact details. Edit every section under
 * the "Contact Page Sections" panel below the editor.
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
$tfh_contact_sections = apply_filters(
	'tfh_contact_sections',
	array( 'contact_info', 'contact_form' )
);
?>

<main id="main" class="tfh-site-main tfh-contact-page">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page-header', null, array( 'subtitle_field' => 'contact_header_subtitle' ) );

		foreach ( $tfh_contact_sections as $tfh_section ) {
			if ( tfh_section_enabled( $tfh_section ) ) {
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
