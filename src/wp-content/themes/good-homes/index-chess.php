<?php
/**
 * The template for homepage posts with "Chess" style
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

good_homes_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$good_homes_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$good_homes_sticky_out = good_homes_get_theme_option('sticky_style')=='columns' 
							&& is_array($good_homes_stickies) && count($good_homes_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($good_homes_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$good_homes_sticky_out) {
		?><div class="chess_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($good_homes_sticky_out && !is_sticky()) {
			$good_homes_sticky_out = false;
			?></div><div class="chess_wrap posts_container"><?php
		}
		get_template_part( 'content', $good_homes_sticky_out && is_sticky() ? 'sticky' :'chess' );
	}
	
	?></div><?php

	good_homes_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>