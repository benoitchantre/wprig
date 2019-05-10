<?php
/**
 * The sidebar containing the footer widget areas
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( ! wp_rig()->is_footer_sidebar_active() ) {
	return;
}

wp_rig()->print_styles( 'wp-rig-widgets' );

?>

<div class="footer-sidebars row alignwide">
	<div class="footer-sidebar widget-area">
		<?php wp_rig()->display_primary_footer_sidebar(); ?>
	</div><!-- .footer-sidebar -->
	<div class="footer-sidebar widget-area">
		<?php wp_rig()->display_secondary_footer_sidebar(); ?>
	</div><!-- .footer-sidebars -->
</div>