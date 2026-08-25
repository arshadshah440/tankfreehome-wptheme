<?php

/**
 * Reusable service card, rendered inside the loop (after the_post()).
 *
 * Icon-topped card used by the homepage's Services section.
 *
 * @package Tank_Free_Home
 */

defined('ABSPATH') || exit;

$tfh_icon_field = tfh_field('service_icon', '', get_the_ID());
$tfh_icon_url   = (is_array($tfh_icon_field) && ! empty($tfh_icon_field['url'])) ? $tfh_icon_field['url'] : '';
$tfh_icon_alt   = (is_array($tfh_icon_field) && ! empty($tfh_icon_field['alt'])) ? $tfh_icon_field['alt'] : '';
$tfh_link       = tfh_link(tfh_field('service_link', '', get_the_ID()), get_the_title());
$tfh_url        = $tfh_link ? $tfh_link['url'] : get_permalink();

$tfh_fallback_icons = array('droplet', 'refresh', 'wrench', 'thermometer', 'bolt', 'inspection');
$tfh_fallback_icon  = $tfh_fallback_icons[get_the_ID() % count($tfh_fallback_icons)];
?>

<article class="tfh-service-card">

		<span class="tfh-service-card__icon">
			<?php if ($tfh_icon_url) : ?>
				<img src="<?php echo esc_url($tfh_icon_url); ?>" alt="<?php echo esc_attr($tfh_icon_alt); ?>" loading="lazy" decoding="async">
			<?php else : ?>
				<?php tfh_icon($tfh_fallback_icon, array('size' => 28)); ?>
			<?php endif; ?>
		</span>

		<h3 class="tfh-service-card__title">
			<a href="<?php echo esc_url($tfh_url); ?>"><?php the_title(); ?></a>
		</h3>

		<?php if (has_excerpt() || get_the_content()) : ?>
			<p class="tfh-service-card__text"><?php echo esc_html(get_the_excerpt()); ?></p>
		<?php endif; ?>

</article>