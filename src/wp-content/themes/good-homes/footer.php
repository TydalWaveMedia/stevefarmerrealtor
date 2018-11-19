<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

						// Widgets area inside page content
						good_homes_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					good_homes_create_widgets_area('widgets_below_page');

					$good_homes_body_style = good_homes_get_theme_option('body_style');
					if ($good_homes_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$good_homes_footer_style = good_homes_get_theme_option("footer_style");
			if (strpos($good_homes_footer_style, 'footer-custom-')===0) $good_homes_footer_style = 'footer-custom';
			get_template_part( "templates/{$good_homes_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (good_homes_is_on(good_homes_get_theme_option('debug_mode')) && good_homes_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(good_homes_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>