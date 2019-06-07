<?php
/**
 * Template part for displaying a post's featured image in a card
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>
<a class="post-thumbnail card__thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
	<?php
	if ( has_post_thumbnail() && ! post_password_required() ) {
		the_post_thumbnail(
			'wp-rig-featured',
			array(
				'class' => 'card__thumbnail-image',
				'alt' => the_title_attribute(
					array(
						'echo' => false,
					)
				),
			)
		);
	} else {
		?>
		<div class="card__thumbnail card__thumbnail-placeholder"></div>
		<?php
	}

	if ( is_home() ) {
		?>
		<img class="card__thumbnail-mask" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/mask-right.svg' ); ?>" />
		<?php
	}

	?>
</a><!-- .post-thumbnail -->
<?php
