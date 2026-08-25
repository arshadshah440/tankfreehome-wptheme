<?php

/**
 * What They Say About Us section.
 *
 * A grid of quote cards pulled from the Testimonial custom post type.
 * Reused across several templates, so the section's own eyebrow/title/count
 * are edited from Theme Settings -> Site Sections rather than any one page.
 *
 * @package Tank_Free_Home
 */

defined('ABSPATH') || exit;

$tfh_count = absint(tfh_option('testimonials_count'));
$tfh_count = $tfh_count ? $tfh_count : 6;

$tfh_quotes = new WP_Query(
	array(
		'post_type'           => 'tfh_testimonial',
		'posts_per_page'      => $tfh_count,
		'post_status'         => 'publish',
		'orderby'             => 'menu_order date',
		'order'               => 'ASC',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
?>
<section class="tfh-testimonials tfh-section" id="testimonials">
	<div class="tfh-container">

		<div class="tfh-section-head tfh-section-head--center">
			<?php tfh_eyebrow(tfh_option('testimonials_eyebrow')); ?>
			<?php
			tfh_split_heading(
				tfh_option('testimonials_title'),
				(int) tfh_option('testimonials_title_highlight'),
				'h2'
			);
			?>
		</div>

		<?php if ($tfh_quotes->have_posts()) : ?>
			<div class="tfh-testimonials__grid">
				<?php
				while ($tfh_quotes->have_posts()) :
					$tfh_quotes->the_post();

					$tfh_id     = get_the_ID();
					$tfh_role   = tfh_field('testimonial_role', '', $tfh_id);
					$tfh_quote  = tfh_field('testimonial_quote', '', $tfh_id);
					$tfh_rating = tfh_field('testimonial_rating', 5, $tfh_id);
				?>
					<figure class="tfh-testimonial-card">

						<figcaption class="tfh-testimonial-card__person">
							<span class="tfh-testimonial-card__avatar">
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('thumbnail', array('loading' => 'lazy')); ?>
								<?php else : ?>
									<span class="tfh-testimonial-card__avatar-fallback">
										<?php tfh_icon('user', array('size' => 20)); ?>
									</span>
								<?php endif; ?>
							</span>
							<span class="tfh-testimonial-card__meta">
								<span class="tfh-testimonial-card__name"><?php the_title(); ?></span>
								<?php if ($tfh_role) : ?>
									<span class="tfh-testimonial-card__role"><?php echo esc_html($tfh_role); ?></span>
								<?php endif; ?>
							</span>
						</figcaption>


						<?php if ($tfh_quote) : ?>
							<blockquote class="tfh-testimonial-card__quote"><?php echo esc_html($tfh_quote); ?></blockquote>
						<?php endif; ?>

						<?php tfh_stars($tfh_rating); ?>

					</figure>
				<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php elseif (current_user_can('edit_posts')) : ?>
			<p class="tfh-empty-hint">
				<?php
				printf(
					/* translators: %s: link to add a testimonial. */
					esc_html__('No testimonials yet. %s to fill this section.', 'tank-free-home'),
					'<a href="' . esc_url(admin_url('post-new.php?post_type=tfh_testimonial')) . '">'
						. esc_html__('Add a testimonial', 'tank-free-home') . '</a>'
				);
				?>
			</p>
		<?php endif; ?>

	</div>
</section>