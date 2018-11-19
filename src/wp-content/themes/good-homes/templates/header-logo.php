<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

$good_homes_args = get_query_var('good_homes_logo_args');

// Site logo
$good_homes_logo_image  = good_homes_get_logo_image(isset($good_homes_args['type']) ? $good_homes_args['type'] : '');
$good_homes_logo_text   = good_homes_is_on(good_homes_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$good_homes_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($good_homes_logo_image) || !empty($good_homes_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($good_homes_logo_image)) {
			$good_homes_attr = good_homes_getimagesize($good_homes_logo_image);
			echo '<img src="'.esc_url($good_homes_logo_image).'" alt=""'.(!empty($good_homes_attr[3]) ? sprintf(' %s', $good_homes_attr[3]) : '').'>' ;
		} else {
			good_homes_show_layout(good_homes_prepare_macros($good_homes_logo_text), '<span class="logo_text">', '</span>');
			good_homes_show_layout(good_homes_prepare_macros($good_homes_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>