<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.10
 */


// Socials
if ( good_homes_is_on(good_homes_get_theme_option('socials_in_footer')) && ($good_homes_output = good_homes_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php good_homes_show_layout($good_homes_output); ?>
		</div>
	</div>
	<?php
}
?>