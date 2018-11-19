<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.10
 */

// Copyright area
$good_homes_footer_scheme =  good_homes_is_inherit(good_homes_get_theme_option('footer_scheme')) ? good_homes_get_theme_option('color_scheme') : good_homes_get_theme_option('footer_scheme');
$good_homes_copyright_scheme = good_homes_is_inherit(good_homes_get_theme_option('copyright_scheme')) ? $good_homes_footer_scheme : good_homes_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($good_homes_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$good_homes_copyright = good_homes_prepare_macros(good_homes_get_theme_option('copyright'));
				if (!empty($good_homes_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $good_homes_copyright, $good_homes_matches)) {
						$good_homes_copyright = str_replace($good_homes_matches[1], date(str_replace(array('{', '}'), '', $good_homes_matches[1])), $good_homes_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($good_homes_copyright));
				}
			?></div>
		</div>
	</div>
</div>
