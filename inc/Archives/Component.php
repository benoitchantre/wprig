<?php
/**
 * WP_Rig\WP_Rig\Archives\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Archives;

use WP_Rig\WP_Rig\Component_Interface;
use function add_filter;
use function is_category;
use function is_tag;
use function is_tax;
use function single_term_title;

/**
 * Class for managing archives.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'archives';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_filter( 'get_the_archive_title', array( $this, 'filter_archive_title' ) );
	}

	/**
	 * Filters the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	public function filter_archive_title( $title ) {
		if ( is_category() || is_tag() || is_tax( array( 'voxia_sector_activity' ) ) ) {
			return single_term_title( '', false );
		}

		return $title;
	}
}
