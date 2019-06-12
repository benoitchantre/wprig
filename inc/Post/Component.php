<?php
/**
 * WP_Rig\WP_Rig\Post\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Post;

use WP_Rig\WP_Rig\Component_Interface;
use function add_filter;
use function wp_trim_words;
use function is_home;
use function is_archive;

/**
 * Class for managing posts.
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
		add_filter( 'the_title', array( $this, 'filter_the_title' ), 10, 2 );
		add_filter( 'excerpt_length', array( $this, 'filter_excerpt_length' ), 999 );
		add_filter( 'excerpt_more', array( $this, 'filter_excerpt_more' ) );
	}

	/**
	 * Filters the post title.
	 *
	 * @param string $title The post title.
	 * @param int $id The post ID.
	 * @return string (Maybe) modified post title.
	 */
	public function filter_the_title( string $title, int $id ) : string {
		if( is_home() || is_archive() ) {
			return wp_trim_words( $title, 15, ' [...]' );
		}

		return $title;
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
