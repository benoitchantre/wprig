<?php
/**
 * Template part for displaying the page header of the currently displayed page
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( is_404() ) {
	?>
	<header class="page-header">
		<h1 class="page-title">
			<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wp-rig' ); ?>
		</h1>
	</header><!-- .page-header -->
	<?php
} elseif ( is_home() && ! have_posts() ) {
	?>
	<header class="page-header">
		<h1 class="page-title">
			<?php esc_html_e( 'Nothing Found', 'wp-rig' ); ?>
		</h1>
	</header><!-- .page-header -->
	<?php
} elseif ( is_home() && ! is_front_page() ) {
	$page_for_posts = get_option( 'page_for_posts' );
	$intro_block_id = (int) get_post_meta( $page_for_posts, 'page-header', true );

	if ( ! $intro_block_id ) {
		?>
		<header class="page-header">
			<h1 class="page-title"><?php echo esc_html( get_the_title( $page_for_posts ) ); ?></h1>
		</header>
		<?php
		return;
	}

	$intro_block = get_post( $intro_block_id );

	if ( 'wp_block' === get_post_type( $intro_block ) ) {
		?>
		<header class="page-header">
			<?php echo wp_kses_post( do_blocks( $intro_block->post_content ) ); ?>
		</header><!-- .page-header -->
		<?php
	}
} elseif ( is_search() ) {
	?>
	<header class="page-header">
		<h1 class="page-title">
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'Search Results for: %s', 'wp-rig' ),
				'<span>' . get_search_query() . '</span>'
			);
			?>
		</h1>
	</header><!-- .page-header -->
	<?php
} elseif ( is_archive() ) {
	?>
	<header class="page-header">
		<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header><!-- .page-header -->
	<?php
} elseif ( is_single() && get_option( 'page_for_posts' ) ) {
	$page_for_posts = get_option( 'page_for_posts' );
	$intro_block_id = (int) get_post_meta( $page_for_posts, 'page-header', true );

	if ( ! $intro_block_id ) {
		?>
		<header class="page-header">
			<h1 class="page-title"><?php echo esc_html( get_the_title( $page_for_posts ) ); ?></h1>
		</header>
		<?php
		return;
	}

	$intro_block = get_post( $intro_block_id );

	if ( 'wp_block' === get_post_type( $intro_block ) ) {
		?>
		<header class="page-header">
			<?php echo wp_kses_post( do_blocks( $intro_block->post_content ) ); ?>
		</header>
		<?php
	}
} elseif ( is_singular() ) {
	$intro_block_id = (int) get_post_meta( get_the_ID(), 'page-header', true );

	if ( ! $intro_block_id ) {
		return;
	}

	$intro_block = get_post( $intro_block_id );

	if ( 'wp_block' === get_post_type( $intro_block ) ) {
		?>
		<header class="page-header">
			<?php echo wp_kses_post( do_blocks( $intro_block->post_content ) ); ?>
		</header>
		<?php
	}
}
