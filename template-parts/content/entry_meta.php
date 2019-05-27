<?php
/**
 * Template part for displaying a post's metadata
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

$post_type_obj = get_post_type_object( get_post_type() );

$time_string = '';

// Show date only when the post type is 'post' or has an archive.
if ( 'post' === $post_type_obj->name || $post_type_obj->has_archive ) {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$time_string = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
}

$author_string = '';

// Show author only if the post type supports it.
if ( post_type_supports( $post_type_obj->name, 'author' ) ) {
	$author_string = sprintf(
		'<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);
}

?>
<div class="entry-meta">
	<?php
	if ( ! empty( $author_string ) ) {
		?>
		<span class="posted-by">
			<?php
			echo $author_string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</span>
		<?php
	}

	if ( ! empty( $time_string ) ) {
		?>
		<span class="posted-on">
			<?php
			echo $time_string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</span>
		<?php
	}
	?>
</div><!-- .entry-meta -->
<?php
