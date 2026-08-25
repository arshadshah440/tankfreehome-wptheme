<?php
/**
 * Reusable inner-page header: breadcrumb, page title and an optional subtitle.
 *
 * Used by custom page templates (About Us, and future interior pages) so
 * every non-homepage page opens with the same navy banner treatment as the
 * rest of the site.
 *
 * @param array $args {
 *     @type string $subtitle_field ACF field name to read the subtitle from.
 *     @type string $subtitle       Literal subtitle text, used instead of
 *                                   $subtitle_field when set (e.g. an excerpt).
 *     @type array  $parent         Optional breadcrumb segment between Home
 *                                   and the current title: array( 'label', 'url' ).
 *     @type string $title          Literal title, used instead of the_title().
 *                                   Needed on the blog index: WordPress
 *                                   points $post at the first listed post
 *                                   before the Loop runs, so the_title()
 *                                   there would show that post's title
 *                                   instead of the "Posts page" itself.
 * }
 *
 * @package Tank_Free_Home
 */

defined( 'ABSPATH' ) || exit;

$tfh_subtitle_field = isset( $args['subtitle_field'] ) ? $args['subtitle_field'] : '';
$tfh_subtitle        = isset( $args['subtitle'] ) ? $args['subtitle'] : ( $tfh_subtitle_field ? tfh_field( $tfh_subtitle_field ) : '' );
$tfh_parent          = isset( $args['parent'] ) ? $args['parent'] : null;
$tfh_title           = isset( $args['title'] ) ? $args['title'] : get_the_title();
?>
<section class="tfh-page-header">
	<div class="tfh-container tfh-page-header__inner">

		<nav class="tfh-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'tank-free-home' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'tank-free-home' ); ?></a>
			<span aria-hidden="true">/</span>
			<?php if ( $tfh_parent && ! empty( $tfh_parent['label'] ) ) : ?>
				<?php if ( ! empty( $tfh_parent['url'] ) ) : ?>
					<a href="<?php echo esc_url( $tfh_parent['url'] ); ?>"><?php echo esc_html( $tfh_parent['label'] ); ?></a>
				<?php else : ?>
					<span><?php echo esc_html( $tfh_parent['label'] ); ?></span>
				<?php endif; ?>
				<span aria-hidden="true">/</span>
			<?php endif; ?>
			<span aria-current="page"><?php echo esc_html( $tfh_title ); ?></span>
		</nav>

		<h1 class="tfh-page-header__title"><?php echo esc_html( $tfh_title ); ?></h1>

		<?php if ( $tfh_subtitle ) : ?>
			<p class="tfh-page-header__subtitle"><?php echo esc_html( $tfh_subtitle ); ?></p>
		<?php endif; ?>

	</div>
</section>
