<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.14
 */
$good_homes_header_video = good_homes_get_header_video();
$good_homes_embed_video = '';
if (!empty($good_homes_header_video) && !good_homes_is_from_uploads($good_homes_header_video)) {
	if (good_homes_is_youtube_url($good_homes_header_video) && preg_match('/[=\/]([^=\/]*)$/', $good_homes_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$good_homes_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($good_homes_header_video) . '[/embed]' ));
			$good_homes_embed_video = good_homes_make_video_autoplay($good_homes_embed_video);
		} else {
			$good_homes_header_video = str_replace('/watch?v=', '/embed/', $good_homes_header_video);
			$good_homes_header_video = good_homes_add_to_url($good_homes_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$good_homes_embed_video = '<iframe src="' . esc_url($good_homes_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php good_homes_show_layout($good_homes_embed_video); ?></div><?php
	}
}
?>