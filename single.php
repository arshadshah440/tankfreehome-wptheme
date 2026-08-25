<?php
/**
 * Single blog post template.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

get_header();

$tfh_blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : '';
?>

<main id="main" class="tfh-site-main tfh-single-post">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part(
			'template-parts/page-header',
			null,
			array(
				'subtitle' => sprintf(
					/* translators: 1: post date, 2: post author. */
					__( 'Posted on %1$s by %2$s', 'tank-free-home' ),
					get_the_date(),
					get_the_author()
				),
				'parent'   => $tfh_blog_url ? array(
					'label' => __( 'Blog', 'tank-free-home' ),
					'url'   => $tfh_blog_url,
				) : null,
			)
		);
		?>

		<article <?php post_class( 'tfh-section' ); ?>>
			<div class="tfh-container tfh-container--narrow">

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="tfh-single-post__thumb">
						<?php the_post_thumbnail( 'large', array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="tfh-entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<nav class="tfh-pagination" aria-label="' . esc_attr__( 'Page', 'tank-free-home' ) . '">',
							'after'  => '</nav>',
						)
					);
					?>
				</div>

				<?php
				$tfh_prev_post = get_previous_post();
				$tfh_next_post = get_next_post();
				?>
				<?php if ( $tfh_prev_post || $tfh_next_post ) : ?>
					<nav class="tfh-post-nav" aria-label="<?php esc_attr_e( 'More posts', 'tank-free-home' ); ?>">
						<?php if ( $tfh_prev_post ) : ?>
							<a class="tfh-post-nav__link tfh-post-nav__link--prev" href="<?php echo esc_url( get_permalink( $tfh_prev_post ) ); ?>">
								<?php tfh_icon( 'chevron-left', array( 'size' => 16 ) ); ?>
								<span>
									<small><?php esc_html_e( 'Previous', 'tank-free-home' ); ?></small>
									<?php echo esc_html( get_the_title( $tfh_prev_post ) ); ?>
								</span>
							</a>
						<?php endif; ?>
						<?php if ( $tfh_next_post ) : ?>
							<a class="tfh-post-nav__link tfh-post-nav__link--next" href="<?php echo esc_url( get_permalink( $tfh_next_post ) ); ?>">
								<span>
									<small><?php esc_html_e( 'Next', 'tank-free-home' ); ?></small>
									<?php echo esc_html( get_the_title( $tfh_next_post ) ); ?>
								</span>
								<?php tfh_icon( 'chevron-right', array( 'size' => 16 ) ); ?>
							</a>
						<?php endif; ?>
					</nav>
				<?php endif; ?>

			</div>
		</article>

		<?php
	endwhile;
	?>

</main>

<?php
get_footer();
