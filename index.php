<?php
/**
 * Fallback template.
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="tfh-site-main">
	<div class="tfh-container tfh-section">
		<?php if ( have_posts() ) : ?>
			<div class="tfh-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/blog-card' );
				endwhile;
				?>
			</div>

			<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found.', 'tank-free-home' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
