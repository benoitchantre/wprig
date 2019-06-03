<?php
/**
 * WP_Rig\WP_Rig\Sidebars\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Sidebars;

use WP_Rig\WP_Rig\Component_Interface;
use WP_Rig\WP_Rig\Templating_Component_Interface;
use function WP_Rig\WP_Rig\wp_rig;
use function add_action;
use function add_filter;
use function register_sidebar;
use function esc_html__;
use function is_active_sidebar;
use function dynamic_sidebar;
use function get_theme_file_uri;
use function get_theme_file_path;
use function wp_enqueue_script;
use function is_singular;

/**
 * Class for managing sidebars.
 *
 * Exposes template tags:
 * * `wp_rig()->template_has_active_sidebar()`
 * * `wp_rig()->get_template_active_sidebars()`
 * * `wp_rig()->is_primary_sidebar_active()`
 * * `wp_rig()->display_primary_sidebar()`
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 */
class Component implements Component_Interface, Templating_Component_Interface {

	const PRIMARY_SIDEBAR_SLUG = 'sidebar-1';

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'sidebars';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'widgets_init', array( $this, 'action_register_sidebars' ) );
		add_filter( 'body_class', array( $this, 'filter_body_classes' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'action_enqueue_navigation_script' ) );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `wp_rig()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return array(
			'template_has_active_sidebar'      => array( $this, 'template_has_active_sidebar' ),
			'get_template_active_sidebars'     => array( $this, 'get_template_active_sidebars' ),
			'is_primary_sidebar_active'        => array( $this, 'is_primary_sidebar_active' ),
			'display_primary_sidebar'          => array( $this, 'display_primary_sidebar' ),
			'is_footer_sidebar_active'         => array( $this, 'is_footer_sidebar_active' ),
			'display_primary_footer_sidebar'   => array( $this, 'display_primary_footer_sidebar' ),
			'display_secondary_footer_sidebar' => array( $this, 'display_secondary_footer_sidebar' ),
		);
	}

	/**
	 * Registers the sidebars.
	 */
	public function action_register_sidebars() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'wp-rig' ),
				'id'            => static::PRIMARY_SIDEBAR_SLUG,
				'description'   => esc_html__( 'Add widgets here.', 'wp-rig' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 1', 'wp-rig' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Add widgets here.', 'wp-rig' ),
				'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h5 class="footer-widget-title">',
				'after_title'   => '</h5>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer 2', 'wp-rig' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Add widgets here.', 'wp-rig' ),
				'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h5 class="footer-widget-title">',
				'after_title'   => '</h5>',
			)
		);
	}

	/**
	 * Gets an array of sidebars IDs that are used by the current template.
	 *
	 * @return array sidebar IDs.
	 */
	private function get_template_sidebars() : array {
		global $template;

		switch ( basename( $template ) ) {
			case 'front-page.php':
			case 'home.php':
			case 'archive.php':
			case 'full-width.php':
			case '404.php':
			case '500.php':
			case 'offline.php':
				$sidebars = array( 'footer-1', 'footer-2' );
				break;
			default:
				$sidebars = array( 'footer-1', 'footer-2', static::PRIMARY_SIDEBAR_SLUG );
		}

		return $sidebars;
	}

	/**
	 * Gets an array of sidebars IDs that are used by the current template and active.
	 *
	 * @return array sidebar IDs.
	 */
	public function get_template_active_sidebars() : array {
		return array_filter( $this->get_template_sidebars(), 'is_active_sidebar' );
	}

	/**
	 * Checks whether the current template has a sidebar that is active.
	 *
	 * @return bool True if the template has a sidebar that is active, false otherwise.
	 */
	public function template_has_active_sidebar() : bool {
		return ! empty( $this->get_template_active_sidebars() );
	}

	/**
	 * Adds custom classes to indicate whether a sidebar is present to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array Filtered body classes.
	 */
	public function filter_body_classes( array $classes ) : array {
		if ( in_array( static::PRIMARY_SIDEBAR_SLUG, $this->get_template_active_sidebars() ) ) {
			$classes[] = 'has-sidebar';
		}

		return $classes;
	}

	/**
	 * Checks whether the primary sidebar is active.
	 *
	 * @return bool True if the primary sidebar is active, false otherwise.
	 */
	public function is_primary_sidebar_active() : bool {
		return (bool) is_active_sidebar( static::PRIMARY_SIDEBAR_SLUG );
	}

	/**
	 * Displays the primary sidebar.
	 */
	public function display_primary_sidebar() {
		dynamic_sidebar( static::PRIMARY_SIDEBAR_SLUG );
	}

	/**
	 * Checks whether a footer sidebar is active.
	 *
	 * @return bool True if at least one sidebar is active, false otherwise.
	 */
	public function is_footer_sidebar_active() : bool {
		return (bool) is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' );
	}

	/**
	 * Displays the primary footer sidebar.
	 */
	public function display_primary_footer_sidebar() {
		dynamic_sidebar( 'footer-1' );
	}

	/**
	 * Displays the secondary footer sidebar.
	 */
	public function display_secondary_footer_sidebar() {
		dynamic_sidebar( 'footer-2' );
	}

	/**
	 * Enqueues a script that adjust that adjust the vertical position of the primary sidebar.
	 */
	public function action_enqueue_navigation_script() {
		// If the AMP plugin is active, return early.
		if ( wp_rig()->is_amp() ) {
			return;
		}

		// If there's no sidebar, return early.
		if ( ! is_singular() || ! $this->is_primary_sidebar_active() ) {
			return;
		}

		// Enqueue the navigation script.
		wp_enqueue_script(
			'wp-rig-sidebar',
			get_theme_file_uri( '/assets/js/sidebar.min.js' ),
			array(),
			wp_rig()->get_asset_version( get_theme_file_path( '/assets/js/sidebar.min.js' ) ),
			true
		);
		wp_script_add_data( 'wp-rig-sidebar', 'async', true );
		wp_script_add_data( 'wp-rig-sidebar', 'precache', true );
	}
}
