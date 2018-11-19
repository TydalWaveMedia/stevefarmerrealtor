<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

// Header sidebar
$good_homes_header_name = good_homes_get_theme_option('header_widgets');
$good_homes_header_present = !good_homes_is_off($good_homes_header_name) && is_active_sidebar($good_homes_header_name);
if ($good_homes_header_present) { 
	good_homes_storage_set('current_sidebar', 'header');
	$good_homes_header_wide = good_homes_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($good_homes_header_name) ) {
		dynamic_sidebar($good_homes_header_name);
	}
	$good_homes_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($good_homes_widgets_output)) {
		$good_homes_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $good_homes_widgets_output);
		$good_homes_need_columns = strpos($good_homes_widgets_output, 'columns_wrap')===false;
		if ($good_homes_need_columns) {
			$good_homes_columns = max(0, (int) good_homes_get_theme_option('header_columns'));
			if ($good_homes_columns == 0) $good_homes_columns = min(6, max(1, substr_count($good_homes_widgets_output, '<aside ')));
			if ($good_homes_columns > 1)
				$good_homes_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($good_homes_columns).' widget ', $good_homes_widgets_output);
			else
				$good_homes_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($good_homes_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$good_homes_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($good_homes_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'good_homes_action_before_sidebar' );
				good_homes_show_layout($good_homes_widgets_output);
				do_action( 'good_homes_action_after_sidebar' );
				if ($good_homes_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$good_homes_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>