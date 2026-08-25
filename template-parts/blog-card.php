<?php
/**
 * Reusable blog post card, rendered inside the loop (after the_post()).
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;
?>
<article class="tfh-blog-card">

	<a class="tfh-blog-card__media" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'tfh-blog', array( 'class' => 'tfh-blog-card__image', 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<img class="tfh-blog-card__image" src="<?php echo esc_url( tfh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
		<?php endif; ?>
	</a>

	<div class="tfh-blog-card__body">
		<div class="tfh-blog-card__meta">
			<?php tfh_posted_on(); ?>
		</div>

		<h3 class="tfh-blog-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<?php if ( has_excerpt() || get_the_content() ) : ?>
			<p class="tfh-blog-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
		<?php endif; ?>

		<a class="tfh-blog-card__cta" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Read More', 'tank-free-home' ); ?>
			<?php tfh_icon( 'arrow-right', array( 'size' => 14 ) ); ?>
		</a>
	</div>

</article>
