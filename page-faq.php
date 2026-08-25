<?php
/**
 * Template Name: FAQ
 * Template Post Type: page
 *
 * The Tank Free Home FAQ page: a page header and a categorized question
 * accordion. Edit every section under the "FAQ Page Sections" panel below
 * the editor.
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
$tfh_faq_sections = apply_filters(
	'tfh_faq_sections',
	array( 'faq_list' )
);
?>

<main id="main" class="tfh-site-main tfh-faq-page">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page-header', null, array( 'subtitle_field' => 'faq_header_subtitle' ) );

		foreach ( $tfh_faq_sections as $tfh_section ) {
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
