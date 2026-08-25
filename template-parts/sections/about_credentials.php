<?php
/**
 * About page section: Credentials.
 *
 * Dark navy panel with a row of icon-topped credential columns.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_items = tfh_field_rows( 'about_credentials_items' );
?>
<section class="tfh-credentials tfh-section" id="credentials">
	<div class="tfh-container">

		<div class="tfh-section-head tfh-section-head--center">
			<?php tfh_eyebrow( tfh_field( 'about_credentials_eyebrow' ) ); ?>
			<?php
			tfh_split_heading(
				tfh_field( 'about_credentials_title' ),
				(int) tfh_field( 'about_credentials_title_highlight' ),
				'h2'
			);
			?>
		</div>

		<?php if ( $tfh_items ) : ?>
			<div class="tfh-credentials__grid">
				<?php foreach ( $tfh_items as $tfh_item ) : ?>
					<?php
					$tfh_icon  = isset( $tfh_item['icon'] ) && $tfh_item['icon'] ? $tfh_item['icon'] : 'shield';
					$tfh_title = isset( $tfh_item['title'] ) ? $tfh_item['title'] : '';
					$tfh_text  = isset( $tfh_item['text'] ) ? $tfh_item['text'] : '';

					if ( ! $tfh_title ) {
						continue;
					}
					?>
					<div class="tfh-credentials__item">
						<span class="tfh-credentials__icon">
							<?php tfh_icon( $tfh_icon, array( 'size' => 26 ) ); ?>
						</span>
						<h3 class="tfh-credentials__title"><?php echo esc_html( $tfh_title ); ?></h3>
						<?php if ( $tfh_text ) : ?>
							<p class="tfh-credentials__text"><?php echo esc_html( $tfh_text ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
