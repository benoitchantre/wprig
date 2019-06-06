<?php
/**
/**
 * The template for displaying the blog
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

get_header();

wp_rig()->print_styles( 'wp-rig-content' );

?>
	<main id="primary" class="site-main">
		<?php
		if ( have_posts() ) {
			get_template_part( 'template-parts/content/page_header' );

			?>
			<div class="cards">
				<?php
				while ( have_posts() ) {
					the_post();

					if ( 1 === $wp_query->current_post ) {
						echo '<div></div>';
					}

					get_template_part( 'template-parts/content/entry_card', get_post_type() );
				}
				?>
			</div>
			<?php

			get_template_part( 'template-parts/content/pagination' );
		} else {
			get_template_part( 'template-parts/content/error' );
		}
		?>
	</main><!-- #primary -->
<?php
get_footer();
