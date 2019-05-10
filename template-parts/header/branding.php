<?php
/**
 * Template part for displaying the header branding
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<div class="site-branding">
	<?php
	if ( is_front_page() && is_home() ) {
		?>
		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="header-logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/voxia-communication.svg' ); ?>" alt="Voxia communication" />
			</a>
		</h1>
		<?php
	} else {
		?>
		<p class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="header-logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/voxia-communication.svg' ); ?>" alt="Voxia communication" />
			</a>
		</p>
		<?php
	}
	?>
</div><!-- .site-branding -->
