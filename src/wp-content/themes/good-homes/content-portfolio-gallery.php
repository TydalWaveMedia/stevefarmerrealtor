<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

$good_homes_blog_style = explode('_', good_homes_get_theme_option('blog_style'));
$good_homes_columns = empty($good_homes_blog_style[1]) ? 2 : max(2, $good_homes_blog_style[1]);
$good_homes_post_format = get_post_format();
$good_homes_post_format = empty($good_homes_post_format) ? 'standard' : str_replace('post-format-', '', $good_homes_post_format);
$good_homes_animation = good_homes_get_theme_option('blog_animation');
$good_homes_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($good_homes_columns).' post_format_'.esc_attr($good_homes_post_format) ); ?>
	<?php echo (!good_homes_is_off($good_homes_animation) ? ' data-animation="'.esc_attr(good_homes_get_animation_classes($good_homes_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($good_homes_image[1]) && !empty($good_homes_image[2])) echo intval($good_homes_image[1]) .'x' . intval($good_homes_image[2]); ?>"
	data-src="<?php if (!empty($good_homes_image[0])) echo esc_url($good_homes_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$good_homes_image_hover = 'icon';	//good_homes_get_theme_option('image_hover');
	if (in_array($good_homes_image_hover, array('icons', 'zoom'))) $good_homes_image_hover = 'dots';
	$good_homes_components = good_homes_is_inherit(good_homes_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: good_homes_array_get_keys_by_value(good_homes_get_theme_option('meta_parts'));
	$good_homes_counters = good_homes_is_inherit(good_homes_get_theme_option_from_meta('counters')) 
								? 'comments'
								: good_homes_array_get_keys_by_value(good_homes_get_theme_option('counters'));
	good_homes_show_post_featured(array(
		'hover' => $good_homes_image_hover,
		'thumb_size' => good_homes_get_thumb_size( strpos(good_homes_get_theme_option('body_style'), 'full')!==false || $good_homes_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($good_homes_components)
										? good_homes_show_post_meta(apply_filters('good_homes_filter_post_meta_args', array(
											'components' => $good_homes_components,
											'counters' => $good_homes_counters,
											'seo' => false,
											'echo' => false
											), $good_homes_blog_style[0], $good_homes_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'good-homes') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>