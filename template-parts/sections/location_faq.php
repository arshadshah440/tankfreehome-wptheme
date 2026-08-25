<?php
/**
 * Location page section: FAQ.
 *
 * Reuses the FAQ page's accordion styles (loaded alongside this template).
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_items = tfh_field_rows( 'location_faq_items' );
?>
<?php if ( $tfh_items ) : ?>
	<section class="tfh-faq tfh-section" id="location-faq">
		<div class="tfh-container">

			<div class="tfh-section-head tfh-section-head--center">
				<p class="tfh-eyebrow"><?php esc_html_e( 'FAQ', 'tank-free-home' ); ?></p>
				<h2 class="tfh-heading">
					<?php
					/* translators: %s: location/page title. */
					printf( esc_html__( 'Questions From %s Homeowners', 'tank-free-home' ), esc_html( get_the_title() ) );
					?>
				</h2>
			</div>

			<div class="tfh-faq__list">
				<?php foreach ( $tfh_items as $tfh_index => $tfh_item ) : ?>
					<?php
					$tfh_question = isset( $tfh_item['question'] ) ? $tfh_item['question'] : '';
					$tfh_answer   = isset( $tfh_item['answer'] ) ? $tfh_item['answer'] : '';

					if ( ! $tfh_question ) {
						continue;
					}
					?>
					<details class="tfh-faq__item" <?php echo ( 0 === $tfh_index ) ? 'open' : ''; ?>>
						<summary class="tfh-faq__question">
							<span><?php echo esc_html( $tfh_question ); ?></span>
							<span class="tfh-faq__icon">
								<?php tfh_icon( 'chevron-down', array( 'size' => 18 ) ); ?>
							</span>
						</summary>
						<?php if ( $tfh_answer ) : ?>
							<div class="tfh-faq__answer">
								<p><?php echo esc_html( $tfh_answer ); ?></p>
							</div>
						<?php endif; ?>
					</details>
				<?php endforeach; ?>
			</div>

		</div>
	</section>
<?php endif; ?>
