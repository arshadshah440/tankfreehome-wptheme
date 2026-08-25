<?php
/**
 * FAQ page section: Categorized question list.
 *
 * A row of category jump links at the top, then each category rendered as
 * its own labeled group of question/answer pairs, built with native
 * <details>/<summary> so it works without any JavaScript.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_intro      = tfh_field( 'faq_list_intro' );
$tfh_categories = tfh_field_rows( 'faq_categories' );

// Give each category a stable anchor slug, and drop empty ones up front.
foreach ( $tfh_categories as $tfh_key => $tfh_category ) {
	$tfh_name = isset( $tfh_category['category_name'] ) ? $tfh_category['category_name'] : '';

	if ( ! $tfh_name ) {
		unset( $tfh_categories[ $tfh_key ] );
		continue;
	}

	$tfh_categories[ $tfh_key ]['slug'] = 'faq-' . sanitize_title( $tfh_name );
}
?>
<section class="tfh-faq tfh-section" id="faq">
	<div class="tfh-container">

		<div class="tfh-section-head tfh-section-head--center">
			<?php tfh_eyebrow( tfh_field( 'faq_list_eyebrow' ) ); ?>
			<?php
			tfh_split_heading(
				tfh_field( 'faq_list_title' ),
				(int) tfh_field( 'faq_list_title_highlight' ),
				'h2'
			);
			?>
			<?php if ( $tfh_intro ) : ?>
				<p><?php echo esc_html( $tfh_intro ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( count( $tfh_categories ) > 1 ) : ?>
			<nav class="tfh-faq__nav" aria-label="<?php esc_attr_e( 'FAQ categories', 'tank-free-home' ); ?>">
				<?php foreach ( $tfh_categories as $tfh_category ) : ?>
					<a href="#<?php echo esc_attr( $tfh_category['slug'] ); ?>"><?php echo esc_html( $tfh_category['category_name'] ); ?></a>
				<?php endforeach; ?>
			</nav>
		<?php endif; ?>

		<?php if ( $tfh_categories ) : ?>
			<div class="tfh-faq__categories">
				<?php foreach ( $tfh_categories as $tfh_cat_index => $tfh_category ) : ?>
					<?php
					$tfh_questions = isset( $tfh_category['questions'] ) && is_array( $tfh_category['questions'] )
						? $tfh_category['questions']
						: array();

					if ( ! $tfh_questions ) {
						continue;
					}
					?>
					<div class="tfh-faq__category" id="<?php echo esc_attr( $tfh_category['slug'] ); ?>">
						<h3 class="tfh-faq__category-title"><?php echo esc_html( $tfh_category['category_name'] ); ?></h3>

						<div class="tfh-faq__list">
							<?php foreach ( $tfh_questions as $tfh_q_index => $tfh_item ) : ?>
								<?php
								$tfh_question = isset( $tfh_item['question'] ) ? $tfh_item['question'] : '';
								$tfh_answer   = isset( $tfh_item['answer'] ) ? $tfh_item['answer'] : '';

								if ( ! $tfh_question ) {
									continue;
								}
								?>
								<details class="tfh-faq__item" <?php echo ( 0 === $tfh_cat_index && 0 === $tfh_q_index ) ? 'open' : ''; ?>>
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
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
