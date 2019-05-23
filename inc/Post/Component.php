<?php
/**
 * WP_Rig\WP_Rig\Post\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Post;

use WP_Rig\WP_Rig\Component_Interface;
use function add_filter;

/**
 * Class for managing excerpts.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'post';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_filter( 'post_class', array( $this, 'filter_post_class' ), 10, 3 );
		add_filter( 'excerpt_length', array( $this, 'filter_excerpt_length' ), 999 );
		add_filter( 'excerpt_more', array( $this, 'filter_excerpt_more' ) );
	}

	/**
	 * Filters the list of CSS class names for the current post.
	 *
	 * @param string[] $classes An array of post class names.
	 * @param string[] $class   An array of additional class names added to the post.
	 * @param int      $post_id The post ID.
	 */
	public function filter_post_class( array $classes, array $class, int $post_id ) {
		if ( is_home() || is_archive() ) {
			$classes[] = 'card';
		}

		return $classes;
	}

	/**
	 * Filters the except length.
	 *
	 * @param int $length Excerpt length (words).
	 * @return int (Maybe) modified excerpt length.
	 */
	public function filter_excerpt_length( int $length ) : int {
		return 20;
	}

	/**
	 * Filters the excerpt "read more" string.
	 *
	 * @param string $more "Read more" excerpt string.
	 * @return string (Maybe) modified "read more" excerpt string.
	 */
	public function filter_excerpt_more( string $more ) : string {
		return ' [...]';
	}
}
