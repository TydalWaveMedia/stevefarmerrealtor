<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

$good_homes_post_id    = get_the_ID();
$good_homes_post_date  = good_homes_get_date();
$good_homes_post_title = get_the_title();
$good_homes_post_link  = get_permalink();
$good_homes_post_author_id   = get_the_author_meta('ID');
$good_homes_post_author_name = get_the_author_meta('display_name');
$good_homes_post_author_url  = get_author_posts_url($good_homes_post_author_id, '');

$good_homes_args = get_query_var('good_homes_args_widgets_posts');
$good_homes_show_date = isset($good_homes_args['show_date']) ? (int) $good_homes_args['show_date'] : 1;
$good_homes_show_image = isset($good_homes_args['show_image']) ? (int) $good_homes_args['show_image'] : 1;
$good_homes_show_author = isset($good_homes_args['show_author']) ? (int) $good_homes_args['show_author'] : 1;
$good_homes_show_counters = isset($good_homes_args['show_counters']) ? (int) $good_homes_args['show_counters'] : 1;
$good_homes_show_categories = isset($good_homes_args['show_categories']) ? (int) $good_homes_args['show_categories'] : 1;

$good_homes_output = good_homes_storage_get('good_homes_output_widgets_posts');

$good_homes_post_counters_output = '';
if ( $good_homes_show_counters ) {
	$good_homes_post_counters_output = '<span class="post_info_item post_info_counters">'
								. good_homes_get_post_counters('comments')
							. '</span>';
}


$good_homes_output .= '<article class="post_item with_thumb">';

if ($good_homes_show_image) {
	$good_homes_post_thumb = get_the_post_thumbnail($good_homes_post_id, good_homes_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($good_homes_post_thumb) $good_homes_output .= '<div class="post_thumb">' . ($good_homes_post_link ? '<a href="' . esc_url($good_homes_post_link) . '">' : '') . ($good_homes_post_thumb) . ($good_homes_post_link ? '</a>' : '') . '</div>';
}

$good_homes_output .= '<div class="post_content">'
			. ($good_homes_show_categories 
					? '<div class="post_categories">'
						. good_homes_get_post_categories()
						. $good_homes_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($good_homes_post_link ? '<a href="' . esc_url($good_homes_post_link) . '">' : '') . ($good_homes_post_title) . ($good_homes_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('good_homes_filter_get_post_info', 
								'<div class="post_info">'
									. ($good_homes_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($good_homes_post_link ? '<a href="' . esc_url($good_homes_post_link) . '" class="post_info_date">' : '') 
											. esc_html($good_homes_post_date) 
											. ($good_homes_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($good_homes_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'good-homes') . ' ' 
											. ($good_homes_post_link ? '<a href="' . esc_url($good_homes_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($good_homes_post_author_name) 
											. ($good_homes_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$good_homes_show_categories && $good_homes_post_counters_output
										? $good_homes_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
good_homes_storage_set('good_homes_output_widgets_posts', $good_homes_output);
?>