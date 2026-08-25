<?php
/**
 * Blog posts index.
 *
 * Used for the site's designated "Posts page" (Settings -> Reading). Not a
 * selectable page template -- WordPress picks this up automatically for the
 * blog listing, following the same page-header + card-grid + pagination
 * pattern as the rest of the theme.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

get_header();

global $wp_query;
?>

<main id="main" class="tfh-site-main tfh-blog-page">

	<?php if ( ! is_paged() ) : ?>
		<?php
		$tfh_blog_title = get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Blog', 'tank-free-home' );
		get_template_part( 'template-parts/page-header', null, array( 'title' => $tfh_blog_title ) );
		?>
	<?php endif; ?>

	<section class="tfh-section">
		<div class="tfh-container">

			<?php if ( have_posts() ) : ?>
				<div class="tfh-blog__grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/blog-card' );
					endwhile;
					?>
				</div>

				<?php if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav class="tfh-pagination" aria-label="<?php esc_attr_e( 'Posts pagination', 'tank-free-home' ); ?>">
						<?php
						echo paginate_links( // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- paginate_links() output is already escaped.
							array(
								'current'   => max( 1, (int) get_query_var( 'paged' ) ),
								'total'     => (int) $wp_query->max_num_pages,
								'prev_text' => tfh_get_icon( 'chevron-left', array( 'size' => 16, 'label' => __( 'Previous page', 'tank-free-home' ) ) ),
								'next_text' => tfh_get_icon( 'chevron-right', array( 'size' => 16, 'label' => __( 'Next page', 'tank-free-home' ) ) ),
								'mid_size'  => 1,
								'end_size'  => 1,
							)
						);
						?>
					</nav>
				<?php endif; ?>
			<?php else : ?>
				<p class="tfh-empty-hint"><?php esc_html_e( 'Nothing has been posted yet. Check back soon.', 'tank-free-home' ); ?></p>
			<?php endif; ?>

		</div>
	</section>

</main>

<?php
get_footer();
