<?php
/**
 * Homepage section: Latest Tankless Projects.
 *
 * Cards are pulled from the Project custom post type.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_count = absint( tfh_field( 'projects_count' ) );
$tfh_count = $tfh_count ? $tfh_count : 3;

$tfh_projects = new WP_Query(
	array(
		'post_type'           => 'tfh_project',
		'posts_per_page'      => $tfh_count,
		'post_status'         => 'publish',
		'orderby'             => 'date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

$tfh_button = tfh_link( tfh_field( 'projects_button' ), __( 'See All', 'tank-free-home' ) );
?>
<section class="tfh-projects tfh-section" id="projects">
	<div class="tfh-container">

		<div class="tfh-section-head tfh-section-head--split">
			<div>
				<?php tfh_eyebrow( tfh_field( 'projects_eyebrow' ) ); ?>
				<?php
				tfh_split_heading(
					tfh_field( 'projects_title' ),
					(int) tfh_field( 'projects_title_highlight' ),
					'h2'
				);
				?>
			</div>

			<div class="tfh-projects__aside">
				<?php $tfh_text = tfh_field( 'projects_text' ); ?>
				<?php if ( $tfh_text ) : ?>
					<p class="tfh-projects__text"><?php echo esc_html( $tfh_text ); ?></p>
				<?php endif; ?>

				<?php if ( $tfh_button ) : ?>
					<a class="tfh-btn tfh-btn--navy"<?php echo tfh_link_attrs( $tfh_button ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in tfh_link_attrs(). ?>>
						<?php echo esc_html( $tfh_button['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( $tfh_projects->have_posts() ) : ?>
			<div class="tfh-projects__grid">
				<?php
				while ( $tfh_projects->have_posts() ) :
					$tfh_projects->the_post();
					get_template_part( 'template-parts/project-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
			<p class="tfh-empty-hint">
				<?php
				printf(
					/* translators: %s: link to add a project. */
					esc_html__( 'No projects yet. %s to fill this gallery.', 'tank-free-home' ),
					'<a href="' . esc_url( admin_url( 'post-new.php?post_type=tfh_project' ) ) . '">'
						. esc_html__( 'Add a project', 'tank-free-home' ) . '</a>'
				);
				?>
			</p>
		<?php endif; ?>

	</div>
</section>
