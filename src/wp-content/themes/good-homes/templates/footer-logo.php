<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.10
 */

// Logo
if (good_homes_is_on(good_homes_get_theme_option('logo_in_footer'))) {
	$good_homes_logo_image = '';
	if (good_homes_get_retina_multiplier(2) > 1)
		$good_homes_logo_image = good_homes_get_theme_option( 'logo_footer_retina' );
	if (empty($good_homes_logo_image)) 
		$good_homes_logo_image = good_homes_get_theme_option( 'logo_footer' );
	$good_homes_logo_text   = get_bloginfo( 'name' );
	if (!empty($good_homes_logo_image) || !empty($good_homes_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($good_homes_logo_image)) {
					$good_homes_attr = good_homes_getimagesize($good_homes_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($good_homes_logo_image).'" class="logo_footer_image" alt=""'.(!empty($good_homes_attr[3]) ? sprintf(' %s', $good_homes_attr[3]) : '').'></a>' ;
				} else if (!empty($good_homes_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($good_homes_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>