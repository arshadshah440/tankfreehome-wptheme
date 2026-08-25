<?php
/**
 * Template Name: Privacy Policy
 * Template Post Type: page
 *
 * The Tank Free Home Privacy Policy page: a page header, a table of
 * contents, and the numbered policy sections. Edit the content under the
 * "Privacy Policy Page Sections" panel below the editor.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="tfh-site-main tfh-privacy-page">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page-header', null, array( 'subtitle_field' => 'privacy_header_subtitle' ) );

		get_template_part( 'template-parts/sections/policy_content' );

		// Anything typed into the editor renders after the designed sections.
		$tfh_editor_content = trim( get_the_content() );

		if ( $tfh_editor_content ) :
			?>
			<div class="tfh-section">
				<div class="tfh-container tfh-container--narrow tfh-entry-content">
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
