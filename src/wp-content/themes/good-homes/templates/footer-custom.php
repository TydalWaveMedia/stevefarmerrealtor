<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.10
 */

$good_homes_footer_scheme =  good_homes_is_inherit(good_homes_get_theme_option('footer_scheme')) ? good_homes_get_theme_option('color_scheme') : good_homes_get_theme_option('footer_scheme');
$good_homes_footer_id = str_replace('footer-custom-', '', good_homes_get_theme_option("footer_style"));
$good_homes_footer_meta = get_post_meta($good_homes_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($good_homes_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($good_homes_footer_id))); 
						if (!empty($good_homes_footer_meta['margin']) != '') 
							echo ' '.esc_attr(good_homes_add_inline_css_class('margin-top: '.esc_attr(good_homes_prepare_css_value($good_homes_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($good_homes_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('good_homes_action_show_layout', $good_homes_footer_id);
	?>
</footer><!-- /.footer_wrap -->
