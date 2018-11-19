<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );

	// Related posts
	$good_homes_related_posts = (int) good_homes_get_theme_option('related_posts');
	if ($good_homes_related_posts > 0) {
		good_homes_show_related_posts(array('orderby' => 'rand',
										'posts_per_page' => max(1, min(9, good_homes_get_theme_option('related_posts'))),
										'columns' => max(1, min(4, good_homes_get_theme_option('related_columns')))
										),
									good_homes_get_theme_option('related_style')
									);
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>