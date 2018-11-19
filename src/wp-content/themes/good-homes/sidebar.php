<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

$good_homes_sidebar_position = good_homes_get_theme_option('sidebar_position');
if (good_homes_sidebar_present()) {
	ob_start();
	$good_homes_sidebar_name = good_homes_get_theme_option('sidebar_widgets');
	good_homes_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($good_homes_sidebar_name) ) {
		dynamic_sidebar($good_homes_sidebar_name);
	}
	$good_homes_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($good_homes_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($good_homes_sidebar_position); ?> widget_area<?php if (!good_homes_is_inherit(good_homes_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(good_homes_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'good_homes_action_before_sidebar' );
				good_homes_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $good_homes_out));
				do_action( 'good_homes_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>