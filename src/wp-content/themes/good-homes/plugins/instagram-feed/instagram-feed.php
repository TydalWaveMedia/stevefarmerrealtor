<?php
/* Instagram Feed support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('good_homes_instagram_feed_theme_setup9')) {
	add_action( 'after_setup_theme', 'good_homes_instagram_feed_theme_setup9', 9 );
	function good_homes_instagram_feed_theme_setup9() {
		if (is_admin()) {
			add_filter( 'good_homes_filter_tgmpa_required_plugins',		'good_homes_instagram_feed_tgmpa_required_plugins' );
		}
	}
}

// Check if Instagram Feed installed and activated
if ( !function_exists( 'good_homes_exists_instagram_feed' ) ) {
	function good_homes_exists_instagram_feed() {
		return defined('SBIVER');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'good_homes_instagram_feed_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('good_homes_filter_tgmpa_required_plugins',	'good_homes_instagram_feed_tgmpa_required_plugins');
	function good_homes_instagram_feed_tgmpa_required_plugins($list=array()) {
		if (in_array('instagram-feed', good_homes_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> esc_html__('Instagram Feed', 'good-homes'),
					'slug' 		=> 'instagram-feed',
					'required' 	=> false
				);
		return $list;
	}
}
?>