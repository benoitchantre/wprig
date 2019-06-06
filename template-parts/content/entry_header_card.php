<?php
/**
 * Template part for displaying a post's header
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<header class="entry-header card__entry-header">
	<?php
	if ( is_home() ) {
		get_template_part( 'template-parts/content/entry_taxonomies_card', get_post_type() );
	}
	get_template_part( 'template-parts/content/entry_title', get_post_type() );
	get_template_part( 'template-parts/content/entry_meta', get_post_type() );
	?>
</header><!-- .entry-header -->
