<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.06
 */

$good_homes_header_css = $good_homes_header_image = '';
$good_homes_header_video = good_homes_get_header_video();
if (true || empty($good_homes_header_video)) {
	$good_homes_header_image = get_header_image();
	if (good_homes_is_on(good_homes_get_theme_option('header_image_override')) && apply_filters('good_homes_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($good_homes_cat_img = good_homes_get_category_image()) != '')
				$good_homes_header_image = $good_homes_cat_img;
		} else if (is_singular() || good_homes_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$good_homes_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($good_homes_header_image)) $good_homes_header_image = $good_homes_header_image[0];
			} else
				$good_homes_header_image = '';
		}
	}
}

$good_homes_header_id = str_replace('header-custom-', '', good_homes_get_theme_option("header_style"));
$good_homes_header_meta = get_post_meta($good_homes_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($good_homes_header_id); 
						?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($good_homes_header_id)));
						echo !empty($good_homes_header_image) || !empty($good_homes_header_video) 
							? ' with_bg_image' 
							: ' without_bg_image';
						if ($good_homes_header_video!='') 
							echo ' with_bg_video';
						if ($good_homes_header_image!='') 
							echo ' '.esc_attr(good_homes_add_inline_css_class('background-image: url('.esc_url($good_homes_header_image).');'));
						if (!empty($good_homes_header_meta['margin']) != '') 
							echo ' '.esc_attr(good_homes_add_inline_css_class('margin-bottom: '.esc_attr(good_homes_prepare_css_value($good_homes_header_meta['margin'])).';'));
						if (is_single() && has_post_thumbnail()) 
							echo ' with_featured_image';
						if (good_homes_is_on(good_homes_get_theme_option('header_fullheight'))) 
							echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(good_homes_is_inherit(good_homes_get_theme_option('header_scheme')) 
														? good_homes_get_theme_option('color_scheme') 
														: good_homes_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($good_homes_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('good_homes_action_show_layout', $good_homes_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>