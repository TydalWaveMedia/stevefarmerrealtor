<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr(good_homes_get_theme_option('menu_mobile_fullscreen') > 0 ? 'fullscreen' : 'narrow'); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		set_query_var('good_homes_logo_args', array('type' => 'inverse'));
		get_template_part( 'templates/header-logo' );
		set_query_var('good_homes_logo_args', array());

		// Mobile menu
		$good_homes_menu_mobile = good_homes_get_nav_menu('menu_mobile');
		if (empty($good_homes_menu_mobile)) {
			$good_homes_menu_mobile = apply_filters('good_homes_filter_get_mobile_menu', '');
			if (empty($good_homes_menu_mobile)) $good_homes_menu_mobile = good_homes_get_nav_menu('menu_main');
			if (empty($good_homes_menu_mobile)) $good_homes_menu_mobile = good_homes_get_nav_menu();
		}
		if (!empty($good_homes_menu_mobile)) {
			if (!empty($good_homes_menu_mobile))
				$good_homes_menu_mobile = str_replace(
					array('menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile'),
					array('menu_mobile', 'id="menu_mobile-', '', '', ''),
					$good_homes_menu_mobile
					);
			if (strpos($good_homes_menu_mobile, '<nav ')===false)
				$good_homes_menu_mobile = sprintf('<nav class="menu_mobile_nav_area">%s</nav>', $good_homes_menu_mobile);
			good_homes_show_layout(apply_filters('good_homes_filter_menu_mobile_layout', $good_homes_menu_mobile));
		}

		// Search field
		do_action('good_homes_action_search', 'normal', 'search_mobile', false);
		
		// Social icons
		good_homes_show_layout(good_homes_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
