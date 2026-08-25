<?php
/**
 * Homepage section: About Us.
 *
 * A technician photo on the left, section copy on the right with a stacked
 * list of feature rows (Proven Expertise, Fast & Dependable, Honest Pricing).
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_photo    = tfh_image( tfh_field( 'about_image' ), 'tfh-card' );
$tfh_features = tfh_field_rows( 'about_features' );
?>
<section class="tfh-about tfh-section" id="about">
	<div class="tfh-container tfh-about__grid">

		<div class="tfh-about__media">
			<?php if ( $tfh_photo['url'] ) : ?>
				<img src="<?php echo esc_url( $tfh_photo['url'] ); ?>" alt="<?php echo esc_attr( $tfh_photo['alt'] ); ?>" loading="lazy" decoding="async">
			<?php else : ?>
				<img src="<?php echo esc_url( tfh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
			<?php endif; ?>
		</div>

		<div class="tfh-about__content">

			<?php tfh_eyebrow( tfh_field( 'about_eyebrow' ) ); ?>

			<?php
			tfh_split_heading(
				tfh_field( 'about_title' ),
				(int) tfh_field( 'about_title_highlight' ),
				'h2'
			);
			?>

			<?php if ( $tfh_features ) : ?>
				<div class="tfh-about__features">
					<?php foreach ( $tfh_features as $tfh_index => $tfh_feature ) : ?>
						<?php
						$tfh_icon_field = isset( $tfh_feature['icon'] ) ? $tfh_feature['icon'] : '';
						$tfh_icon_url   = ( is_array( $tfh_icon_field ) && ! empty( $tfh_icon_field['url'] ) ) ? $tfh_icon_field['url'] : '';
						$tfh_ftitle     = isset( $tfh_feature['title'] ) ? $tfh_feature['title'] : '';
						$tfh_ftext      = isset( $tfh_feature['text'] ) ? $tfh_feature['text'] : '';
						$tfh_fallback_icons = array( 'shield-check', 'bolt', 'tag' );
						$tfh_fallback_icon  = $tfh_fallback_icons[ $tfh_index % count( $tfh_fallback_icons ) ];

						if ( ! $tfh_ftitle ) {
							continue;
						}
						?>
						<div class="tfh-feature-row">
							<span class="tfh-feature-row__icon">
								<?php if ( $tfh_icon_url ) : ?>
									<img src="<?php echo esc_url( $tfh_icon_url ); ?>" alt="">
								<?php else : ?>
									<?php tfh_icon( $tfh_fallback_icon, array( 'size' => 22 ) ); ?>
								<?php endif; ?>
							</span>
							<div class="tfh-feature-row__body">
								<h3 class="tfh-feature-row__title"><?php echo esc_html( $tfh_ftitle ); ?></h3>
								<?php if ( $tfh_ftext ) : ?>
									<p class="tfh-feature-row__text"><?php echo esc_html( $tfh_ftext ); ?></p>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>

	</div>
</section>
