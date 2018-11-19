<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

good_homes_storage_set('blog_archive', true);

// Load scripts for 'Masonry' layout
if (substr(good_homes_get_theme_option('blog_style'), 0, 7) == 'masonry') {
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'classie', good_homes_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
	wp_enqueue_script( 'good_homes-gallery-script', good_homes_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );
}

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$good_homes_classes = 'posts_container '
						. (substr(good_homes_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap' : 'masonry_wrap');
	$good_homes_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$good_homes_sticky_out = good_homes_get_theme_option('sticky_style')=='columns' 
							&& is_array($good_homes_stickies) && count($good_homes_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($good_homes_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$good_homes_sticky_out) {
		if (good_homes_get_theme_option('first_post_large') && !is_paged() && !in_array(good_homes_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($good_homes_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($good_homes_sticky_out && !is_sticky()) {
			$good_homes_sticky_out = false;
			?></div><div class="<?php echo esc_attr($good_homes_classes); ?>"><?php
		}
		get_template_part( 'content', $good_homes_sticky_out && is_sticky() ? 'sticky' : 'classic' );
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