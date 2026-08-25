<?php

/**
 * Homepage section: Expertise.
 *
 * A photo with a floating stat badge on the left, a navy progress-bar card
 * listing core services on the right.
 *
 * @package Tank_Free_Home
 */

defined('ABSPATH') || exit;

$tfh_image = tfh_image(tfh_field('expertise_image'), 'tfh-card');
$tfh_items = tfh_field_rows('expertise_items');

$tfh_badge_value = tfh_field('expertise_badge_value');
$tfh_badge_label = tfh_field('expertise_badge_label');
$tfh_badge_text  = tfh_field('expertise_badge_text');
?>
<section class="tfh-expertise tfh-section" id="expertise">
	<div class="tfh-container tfh-expertise__grid">

		<div class="tfh-expertise__media">

			<div class="tfh-section-head">
				<?php tfh_eyebrow(tfh_field('expertise_eyebrow')); ?>
				<?php
				tfh_split_heading(
					tfh_field('expertise_title'),
					(int) tfh_field('expertise_title_highlight'),
					'h2'
				);
				?>
			</div>

			<div class="tfh-expertise__stat-row">
				<div class="tfh-expertise__photo">
					<?php if ($tfh_image['url']) : ?>
						<img src="<?php echo esc_url($tfh_image['url']); ?>" alt="<?php echo esc_attr($tfh_image['alt']); ?>" loading="lazy" decoding="async">
					<?php else : ?>
						<img src="<?php echo esc_url(tfh_placeholder_image_url()); ?>" alt="" loading="lazy" decoding="async">
					<?php endif; ?>
				</div>

				<?php if ($tfh_badge_value || $tfh_badge_label) : ?>
					<div class="tfh-expertise__badge">
						<?php if ($tfh_badge_value) : ?>
							<span class="tfh-expertise__badge-value"><?php echo esc_html($tfh_badge_value); ?></span>
						<?php endif; ?>
						<?php if ($tfh_badge_label) : ?>
							<span class="tfh-expertise__badge-label"><?php echo esc_html($tfh_badge_label); ?></span>
						<?php endif; ?>
						<hr>
						<?php if ($tfh_badge_text) : ?>
							<p class="tfh-expertise__text"><?php echo esc_html($tfh_badge_text); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>


		</div>

		<?php if ($tfh_items) : ?>
			<div class="tfh-expertise__panel">
				<?php foreach ($tfh_items as $tfh_item) : ?>
					<?php
					$tfh_label   = isset($tfh_item['label']) ? $tfh_item['label'] : '';
					$tfh_percent = isset($tfh_item['percent']) ? max(0, min(100, (int) $tfh_item['percent'])) : 0;

					if (! $tfh_label) {
						continue;
					}
					?>
					<div class="tfh-progress">
						<span class="tfh-progress__label"><?php echo esc_html($tfh_label); ?></span>
						<div class="tfh-progress__track">
							<span class="tfh-progress__fill" style="width:<?php echo esc_attr($tfh_percent); ?>%">
								<span class="tfh-progress__value"><?php echo esc_html($tfh_percent); ?>%</span>
							</span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>