<?php
/**
 * Template part for displaying the footer content
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<div class="footer-content row alignwide">
	<div>
		<?php
		wp_rig()->display_footer_nav_menu(
			array(
				'depth'      => 1,
				'menu_class' => 'menu-footer',
			)
		);
		?>
	</div>
	<div class="social-links">newsletter form</div>
</div><!-- .footer-branding -->
