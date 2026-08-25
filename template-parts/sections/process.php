<?php
/**
 * Our Process section.
 *
 * A centered heading over a row of numbered process steps. Shared across
 * the Service Listing page and every single Service page, so its content is
 * edited from Theme Settings -> Site Sections rather than any one page.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_intro = tfh_option( 'process_intro' );
$tfh_steps = tfh_rows( 'process_steps' );
?>
<section class="tfh-process tfh-section" id="our-process">
	<div class="tfh-container">

		<div class="tfh-section-head tfh-section-head--center">
			<?php tfh_eyebrow( tfh_option( 'process_eyebrow' ) ); ?>
			<?php
			tfh_split_heading(
				tfh_option( 'process_title' ),
				(int) tfh_option( 'process_title_highlight' ),
				'h2'
			);
			?>
			<?php if ( $tfh_intro ) : ?>
				<p><?php echo esc_html( $tfh_intro ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $tfh_steps ) : ?>
			<div class="tfh-process__grid">
				<?php foreach ( $tfh_steps as $tfh_index => $tfh_step ) : ?>
					<?php
					$tfh_icon  = isset( $tfh_step['icon'] ) && $tfh_step['icon'] ? $tfh_step['icon'] : 'check';
					$tfh_title = isset( $tfh_step['title'] ) ? $tfh_step['title'] : '';
					$tfh_text  = isset( $tfh_step['text'] ) ? $tfh_step['text'] : '';

					if ( ! $tfh_title ) {
						continue;
					}
					?>
					<div class="tfh-process__step">
						<span class="tfh-process__number"><?php echo esc_html( str_pad( $tfh_index + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
						<span class="tfh-process__icon">
							<?php tfh_icon( $tfh_icon, array( 'size' => 22 ) ); ?>
						</span>
						<h3 class="tfh-process__title"><?php echo esc_html( $tfh_title ); ?></h3>
						<?php if ( $tfh_text ) : ?>
							<p class="tfh-process__text"><?php echo esc_html( $tfh_text ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
