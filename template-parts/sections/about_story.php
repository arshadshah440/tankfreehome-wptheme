<?php
/**
 * About page section: Our Story.
 *
 * A photo on the left, a short company narrative on the right. Reuses the
 * homepage About section's grid styles from home.css.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_image = tfh_image( tfh_field( 'about_story_image' ), 'tfh-card' );
$tfh_text  = tfh_field( 'about_story_text' );
?>
<section class="tfh-about tfh-section" id="our-story">
	<div class="tfh-container tfh-about__grid">

		<div class="tfh-about__media">
			<?php if ( $tfh_image['url'] ) : ?>
				<img src="<?php echo esc_url( $tfh_image['url'] ); ?>" alt="<?php echo esc_attr( $tfh_image['alt'] ); ?>" loading="lazy" decoding="async">
			<?php else : ?>
				<img src="<?php echo esc_url( tfh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
			<?php endif; ?>
		</div>

		<div class="tfh-about__content">

			<?php tfh_eyebrow( tfh_field( 'about_story_eyebrow' ) ); ?>
			<?php
			tfh_split_heading(
				tfh_field( 'about_story_title' ),
				(int) tfh_field( 'about_story_title_highlight' ),
				'h2'
			);
			?>

			<?php if ( $tfh_text ) : ?>
				<div class="tfh-about-story__body">
					<?php foreach ( explode( "\n\n", $tfh_text ) as $tfh_paragraph ) : ?>
						<?php
						$tfh_paragraph = trim( $tfh_paragraph );

						if ( ! $tfh_paragraph ) {
							continue;
						}
						?>
						<p><?php echo esc_html( $tfh_paragraph ); ?></p>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>

	</div>
</section>
