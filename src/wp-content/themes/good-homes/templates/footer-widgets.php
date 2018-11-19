<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.10
 */

// Footer sidebar
$good_homes_footer_name = good_homes_get_theme_option('footer_widgets');
$good_homes_footer_present = !good_homes_is_off($good_homes_footer_name) && is_active_sidebar($good_homes_footer_name);
if ($good_homes_footer_present) { 
	good_homes_storage_set('current_sidebar', 'footer');
	$good_homes_footer_wide = good_homes_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($good_homes_footer_name) ) {
		dynamic_sidebar($good_homes_footer_name);
	}
	$good_homes_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($good_homes_out)) {
		$good_homes_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $good_homes_out);
		$good_homes_need_columns = true;	//or check: strpos($good_homes_out, 'columns_wrap')===false;
		if ($good_homes_need_columns) {
			$good_homes_columns = max(0, (int) good_homes_get_theme_option('footer_columns'));
			if ($good_homes_columns == 0) $good_homes_columns = min(4, max(1, substr_count($good_homes_out, '<aside ')));
			if ($good_homes_columns > 1)
				$good_homes_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($good_homes_columns).' widget ', $good_homes_out);
			else
				$good_homes_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($good_homes_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$good_homes_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($good_homes_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'good_homes_action_before_sidebar' );
				good_homes_show_layout($good_homes_out);
				do_action( 'good_homes_action_after_sidebar' );
				if ($good_homes_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$good_homes_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>