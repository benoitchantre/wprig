<?php
/**
 * Template part for displaying a post's taxonomy terms
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

$taxonomy = 'voxia_sector_activity';

if ( ! taxonomy_exists( $taxonomy ) ) {
	return;
}

$class     = $taxonomy . '-links term-links';
/* translators: separator between taxonomy terms */
$separator = _x( ', ', 'list item separator', 'wp-rig' );
$list      = get_the_term_list( $post->ID, 'voxia_sector_activity', '', esc_html( $separator ), '' );

if ( empty( $list ) ) {
	return;
}
?>

<div class="entry-taxonomies">
	<span class="<?php echo esc_attr( $class ); ?>">
		<?php echo wp_kses_post( $list ); ?>
	</span>
</div><!-- .entry-taxonomies -->
