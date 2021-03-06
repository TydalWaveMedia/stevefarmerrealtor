<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('good_homes_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'good_homes_revslider_theme_setup9', 9 );
	function good_homes_revslider_theme_setup9() {
		if (good_homes_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'good_homes_revslider_frontend_scripts', 1100 );
			add_filter( 'good_homes_filter_merge_styles',			'good_homes_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'good_homes_filter_tgmpa_required_plugins','good_homes_revslider_tgmpa_required_plugins' );
		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'good_homes_exists_revslider' ) ) {
	function good_homes_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'good_homes_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('good_homes_filter_tgmpa_required_plugins',	'good_homes_revslider_tgmpa_required_plugins');
	function good_homes_revslider_tgmpa_required_plugins($list=array()) {
		if (in_array('revslider', good_homes_storage_get('required_plugins'))) {
			$path = good_homes_get_file_dir('plugins/revslider/revslider.zip');
			$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'good-homes'),
					'slug' 		=> 'revslider',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'good_homes_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'good_homes_revslider_frontend_scripts', 1100 );
	function good_homes_revslider_frontend_scripts() {
		if (good_homes_is_on(good_homes_get_theme_option('debug_mode')) && good_homes_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'good_homes-revslider',  good_homes_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'good_homes_revslider_merge_styles' ) ) {
	//Handler of the add_filter('good_homes_filter_merge_styles', 'good_homes_revslider_merge_styles');
	function good_homes_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>