<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.10
 */

// Footer menu
$good_homes_menu_footer = good_homes_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($good_homes_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php good_homes_show_layout($good_homes_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>