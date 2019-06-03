<?php
/**
 * Template part for displaying a pagination
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

the_posts_pagination(
	array(
		'mid_size'           => 2,
		'prev_text'          => '❬',
		'next_text'          => '❭',
		'screen_reader_text' => __( 'Page navigation', 'wp-rig' ),
	)
);
