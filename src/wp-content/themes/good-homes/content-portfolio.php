<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($good_homes_columns).' post_format_'.esc_attr($good_homes_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!good_homes_is_off($good_homes_animation) ? ' data-animation="'.esc_attr(good_homes_get_animation_classes($good_homes_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$good_homes_image_hover = good_homes_get_theme_option('image_hover');
	// Featured image
	good_homes_show_post_featured(array(
		'thumb_size' => good_homes_get_thumb_size(strpos(good_homes_get_theme_option('body_style'), 'full')!==false || $good_homes_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $good_homes_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $good_homes_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>