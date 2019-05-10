<?php
/**
 * Template part for displaying the footer info
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<div class="site-info">
	<?php
	/* translators: Theme author. */
	printf( esc_html__( '© 2019 Created by %s.', 'wp-rig' ), '<a href="' . esc_url( 'https://s-agence.ch' ) . '">S agence</a>' );

	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '<span class="sep"> | </span>' );
	}
	?>
</div><!-- .site-info -->
