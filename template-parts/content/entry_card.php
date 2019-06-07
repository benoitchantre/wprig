<?php
/**
 * Template part for displaying a post as a card
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry card' ); ?>>
	<?php
	get_template_part( 'template-parts/content/entry_thumbnail_card', get_post_type() );
	get_template_part( 'template-parts/content/entry_header_card', get_post_type() );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
