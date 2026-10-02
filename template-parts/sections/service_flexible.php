<?php
/**
 * Single service section: flexible content blocks.
 *
 * Renders tfh_service's "service_content_blocks" flexible content field,
 * one layout at a time. New layout types go here + in group_tfh_service.json.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

if ( ! have_rows( 'service_content_blocks' ) ) {
	return;
}

while ( have_rows( 'service_content_blocks' ) ) :
	the_row();
	$tfh_layout = get_row_layout();
	?>

	<?php if ( 'icon_list' === $tfh_layout ) : ?>
		<section class="tfh-section tfh-flex-icons">
			<div class="tfh-container">
				<div class="tfh-section-head tfh-section-head--center">
					<?php tfh_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
					<?php if ( get_sub_field( 'title' ) ) : ?>
						<h2 class="tfh-heading"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
					<?php endif; ?>
					<?php if ( get_sub_field( 'intro' ) ) : ?>
						<p><?php echo wp_kses_post( nl2br( esc_html( get_sub_field( 'intro' ) ) ) ); ?></p>
					<?php endif; ?>
				</div>
				<?php if ( have_rows( 'items' ) ) : ?>
					<div class="tfh-services__grid">
						<?php while ( have_rows( 'items' ) ) : the_row(); ?>
							<div class="tfh-service-card">
								<span class="tfh-service-card__icon">
									<?php tfh_icon( get_sub_field( 'icon' ) ? get_sub_field( 'icon' ) : 'check', array( 'size' => 26 ) ); ?>
								</span>
								<?php if ( get_sub_field( 'title' ) ) : ?>
									<h3 class="tfh-service-card__title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
								<?php endif; ?>
								<?php if ( get_sub_field( 'text' ) ) : ?>
									<p class="tfh-service-card__text"><?php echo esc_html( get_sub_field( 'text' ) ); ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

	<?php elseif ( 'text_block' === $tfh_layout ) : ?>
		<section class="tfh-section tfh-flex-text">
			<div class="tfh-container tfh-container--narrow">
				<?php tfh_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
				<?php if ( get_sub_field( 'title' ) ) : ?>
					<h2 class="tfh-heading"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
				<?php endif; ?>
				<?php if ( get_sub_field( 'body' ) ) : ?>
					<div class="tfh-entry-content">
						<?php echo wp_kses_post( wpautop( get_sub_field( 'body' ) ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

	<?php elseif ( 'table' === $tfh_layout ) : ?>
		<section class="tfh-section tfh-flex-table">
			<div class="tfh-container tfh-container--narrow">
				<div class="tfh-section-head tfh-section-head--center">
					<?php tfh_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
					<?php if ( get_sub_field( 'title' ) ) : ?>
						<h2 class="tfh-heading"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
					<?php endif; ?>
					<?php if ( get_sub_field( 'intro' ) ) : ?>
						<p><?php echo wp_kses_post( nl2br( esc_html( get_sub_field( 'intro' ) ) ) ); ?></p>
					<?php endif; ?>
				</div>
				<?php if ( have_rows( 'rows' ) ) : ?>
					<div class="tfh-flex-table__grid">
						<?php while ( have_rows( 'rows' ) ) : the_row(); ?>
							<div class="tfh-flex-table__row">
								<span class="tfh-flex-table__col1"><?php echo esc_html( get_sub_field( 'col1' ) ); ?></span>
								<span class="tfh-flex-table__col2"><?php echo esc_html( get_sub_field( 'col2' ) ); ?></span>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

	<?php elseif ( 'steps' === $tfh_layout ) : ?>
		<section class="tfh-section tfh-flex-steps">
			<div class="tfh-container">
				<div class="tfh-section-head tfh-section-head--center">
					<?php tfh_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
					<?php if ( get_sub_field( 'title' ) ) : ?>
						<h2 class="tfh-heading"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
					<?php endif; ?>
					<?php if ( get_sub_field( 'intro' ) ) : ?>
						<p><?php echo wp_kses_post( nl2br( esc_html( get_sub_field( 'intro' ) ) ) ); ?></p>
					<?php endif; ?>
				</div>
				<?php if ( have_rows( 'items' ) ) : ?>
					<div class="tfh-process__grid">
						<?php $tfh_i = 0; ?>
						<?php while ( have_rows( 'items' ) ) : the_row(); ?>
							<?php $tfh_i++; ?>
							<div class="tfh-process__step">
								<span class="tfh-process__number"><?php echo esc_html( str_pad( $tfh_i, 2, '0', STR_PAD_LEFT ) ); ?></span>
								<span class="tfh-process__icon">
									<?php tfh_icon( 'check', array( 'size' => 22 ) ); ?>
								</span>
								<?php if ( get_sub_field( 'title' ) ) : ?>
									<h3 class="tfh-process__title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
								<?php endif; ?>
								<?php if ( get_sub_field( 'text' ) ) : ?>
									<p class="tfh-process__text"><?php echo esc_html( get_sub_field( 'text' ) ); ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

	<?php elseif ( 'link_list' === $tfh_layout ) : ?>
		<section class="tfh-section tfh-flex-links">
			<div class="tfh-container">
				<div class="tfh-section-head tfh-section-head--center">
					<?php tfh_eyebrow( get_sub_field( 'eyebrow' ) ); ?>
					<?php if ( get_sub_field( 'title' ) ) : ?>
						<h2 class="tfh-heading"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
					<?php endif; ?>
				</div>
				<?php if ( have_rows( 'items' ) ) : ?>
					<ul class="tfh-flex-links__list">
						<?php while ( have_rows( 'items' ) ) : the_row(); ?>
							<?php if ( get_sub_field( 'label' ) && get_sub_field( 'url' ) ) : ?>
								<li>
									<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>">
										<?php tfh_icon( 'arrow-right', array( 'size' => 14 ) ); ?>
										<?php echo esc_html( get_sub_field( 'label' ) ); ?>
									</a>
								</li>
							<?php endif; ?>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</section>

	<?php endif; ?>

<?php endwhile; ?>
