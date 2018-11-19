<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$good_homes_content = '';
$good_homes_blog_archive_mask = '%%CONTENT%%';
$good_homes_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $good_homes_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($good_homes_content = apply_filters('the_content', get_the_content())) != '') {
		if (($good_homes_pos = strpos($good_homes_content, $good_homes_blog_archive_mask)) !== false) {
			$good_homes_content = preg_replace('/(\<p\>\s*)?'.$good_homes_blog_archive_mask.'(\s*\<\/p\>)/i', $good_homes_blog_archive_subst, $good_homes_content);
		} else
			$good_homes_content .= $good_homes_blog_archive_subst;
		$good_homes_content = explode($good_homes_blog_archive_mask, $good_homes_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) good_homes_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$good_homes_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$good_homes_args = good_homes_query_add_posts_and_cats($good_homes_args, '', good_homes_get_theme_option('post_type'), good_homes_get_theme_option('parent_cat'));
$good_homes_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($good_homes_page_number > 1) {
	$good_homes_args['paged'] = $good_homes_page_number;
	$good_homes_args['ignore_sticky_posts'] = true;
}
$good_homes_ppp = good_homes_get_theme_option('posts_per_page');
if ((int) $good_homes_ppp != 0)
	$good_homes_args['posts_per_page'] = (int) $good_homes_ppp;
// Make a new query
query_posts( $good_homes_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($good_homes_content) && count($good_homes_content) == 2) {
	set_query_var('blog_archive_start', $good_homes_content[0]);
	set_query_var('blog_archive_end', $good_homes_content[1]);
}

get_template_part('index');
?>