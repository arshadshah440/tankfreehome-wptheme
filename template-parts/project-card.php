<?php
/**
 * Reusable project card, rendered inside the loop (after the_post()).
 *
 * Photo with a title caption, used by the homepage's Projects gallery.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_link = tfh_link( tfh_field( 'project_link', '', get_the_ID() ), get_the_title() );
$tfh_url  = $tfh_link ? $tfh_link['url'] : get_permalink();
?>
<article class="tfh-project-card">

	<a class="tfh-project-card__link" href="<?php echo esc_url( $tfh_url ); ?>">

		<span class="tfh-project-card__media">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'tfh-project', array( 'class' => 'tfh-project-card__image', 'loading' => 'lazy' ) ); ?>
			<?php else : ?>
				<img class="tfh-project-card__image" src="<?php echo esc_url( tfh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
			<?php endif; ?>
		</span>

		<span class="tfh-project-card__overlay">
			<h3 class="tfh-project-card__title"><?php the_title(); ?></h3>

			<?php if ( has_excerpt() || get_the_content() ) : ?>
				<span class="tfh-project-card__text"><?php echo esc_html( get_the_excerpt() ); ?></span>
			<?php endif; ?>

			<span class="tfh-project-card__arrow">
				<?php tfh_icon( 'arrow-right', array( 'size' => 16 ) ); ?>
			</span>
		</span>

	</a>

</article>
