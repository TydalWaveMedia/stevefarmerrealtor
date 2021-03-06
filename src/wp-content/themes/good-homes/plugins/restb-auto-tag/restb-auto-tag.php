<?php
/* Restb.ai Auto Tag support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('good_homes_restb-auto-tag_theme_setup9')) {
	add_action( 'after_setup_theme', 'good_homes_restb_auto_tag_theme_setup9', 9 );
	function good_homes_restb_auto_tag_theme_setup9() {
		if (is_admin()) {
			add_filter( 'good_homes_filter_tgmpa_required_plugins',		'good_homes_restb_auto_tag_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'good_homes_exists_restb_auto_tag' ) ) {
	function good_homes_exists_restb_auto_tag() {
		return function_exists('REautotag_dashboard_notice') ;
	}
}


// Filter to add in the required plugins list
if ( !function_exists( 'good_homes_restb_auto_tag_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('good_homes_filter_tgmpa_required_plugins',	'good_homes_restb_auto_tag_tgmpa_required_plugins');
	function good_homes_restb_auto_tag_tgmpa_required_plugins($list=array()) {
		if (in_array('restb-auto-tag', good_homes_storage_get('required_plugins'))) {
			$path = good_homes_get_file_dir('plugins/restb-auto-tag/restb-auto-tag.zip');
			$list[] = array(
				'name' 		=> esc_html__('RealEstate Auto Tag', 'good-homes'),
				'slug' 		=> 'restb-auto-tag',
				'source'	=> !empty($path) ? $path : 'upload://restb-auto-tag.php',
				'required' 	=> false
			);
		}
		return $list;
	}
}




?>