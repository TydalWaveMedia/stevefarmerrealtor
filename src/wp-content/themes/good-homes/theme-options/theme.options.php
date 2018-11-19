<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)


if ( !function_exists('good_homes_options_theme_setup1') ) {
	add_action( 'after_setup_theme', 'good_homes_options_theme_setup1', 1 );
	function good_homes_options_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		good_homes_storage_set('settings', array(
			
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'max_load_fonts'		=> 3,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
		
			'max_excerpt_length'	=> 50,			// Max words number for the excerpt in the blog style 'Excerpt'.
													// For style 'Classic' - get half from this value

			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use fontello icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use fontello icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal'	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
		));
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('good_homes_options_create')) {

	function good_homes_options_create() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'good-homes');

		good_homes_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'good-homes'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'good-homes') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'good-homes') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'good-homes'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'good-homes'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"std" => 'header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'good-homes'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"std" => 'default',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'good-homes'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'good-homes') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'good-homes'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"dependency" => array(
					'header_style' => array('header-default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => good_homes_get_list_range(0,6),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'good-homes'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'good-homes'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'good-homes'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"dependency" => array(
					'header_style' => array('header-default')
				),
				"std" => 1,
				"type" => "checkbox"
				),

			'menu_info' => array(
				"title" => esc_html__('Menu settings', 'good-homes'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'good-homes') ),
				"type" => "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'good-homes'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'good-homes'),
					'left'	=> esc_html__('Left',	'good-homes'),
					'right'	=> esc_html__('Right',	'good-homes')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'good-homes'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'good-homes'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'good-homes') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'good-homes'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'good-homes') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'good-homes'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'good-homes') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'good-homes'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'good-homes') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'good-homes') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'good-homes') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'good-homes') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'good-homes') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'good-homes') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'good-homes') ),
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'good-homes'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'good-homes') ),
				"std" => 1,
				"type" => "checkbox"
				),
			'header_title_text_address' => array(
				"title" => esc_html__('Address on header', 'good-homes'),
				"desc" => wp_kses_data( __('Put here text to insert into the Header(Attention only for style "Default Header") Use "|" to split this string on two parts', 'good-homes') ),
				"std" => '123 Homes Street | Chicago, IL 60606',
				"type" => "text"
			),
			'header_title_text_phone_mail' => array(
				"title" => esc_html__('Phone and mail on header', 'good-homes'),
				"desc" => wp_kses_data( __('Put here text to insert into the Header(Attention only for style "Default Header") Use "|" to split this string on two parts', 'good-homes') ),
				"std" => '123-456-7890 | info@goodhomes.com',
				"type" => "text"
			),
			'header_title_top_panel_default_left' => array(
				"title" => esc_html__('Text on top panel left', 'good-homes'),
				"desc" => wp_kses_data( __('Put here text to insert into top panel on the left side(Attention only for style "Default Header")', 'good-homes') ),
				"std" => 'The Ultimate Insider"s Guide to City Real Estate',
				"type" => "text"
			),
			'header_title_top_panel_default_right' => array(
				"title" => esc_html__('Text on top panel right', 'good-homes'),
				"desc" => wp_kses_data( __('Put here text to insert into top panel on the right side(Attention only for style "Default Header")', 'good-homes') ),
				"std" => 'Open Hours:Mn - St, 8:00 a.m. - 9:00 p.m',
				"type" => "text"
			),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'good-homes'),
				"desc" => wp_kses_data( __('Options of the content area.', 'good-homes') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'good-homes'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'good-homes'),
				"desc" => wp_kses_data( __('Select width of the body content', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'good-homes'),
					'wide'		=> esc_html__('Wide',		'good-homes'),
					'fullwide'	=> esc_html__('Fullwide',	'good-homes'),
					'fullscreen'=> esc_html__('Fullscreen',	'good-homes')
				),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'good-homes') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"std" => '',
				"type" => "image"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'good-homes'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'good-homes') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'good-homes')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'good-homes'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'good-homes') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'good-homes')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'good-homes'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'good-homes') ),
				"std" => 0,
				"type" => "text"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'good-homes') ),
				"std" => '',
				"type" => "image"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'good-homes'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'good-homes') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'author_info' => array(
				"title" => esc_html__('Author info', 'good-homes'),
				"desc" => wp_kses_data( __("Display block with information about post's author", 'good-homes') ),
				"std" => 1,
				"type" => "checkbox"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'good-homes'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts showed.', 'good-homes') ),
				"std" => 2,
				"options" => good_homes_get_list_range(0,9),
				"type" => "select"
				),
			'related_columns' => array(
				"title" => esc_html__('Related columns', 'good-homes'),
				"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'good-homes') ),
				"std" => 2,
				"options" => good_homes_get_list_range(1,4),
				"type" => "select"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'good-homes'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'good-homes') ),
				"std" => 2,
				"options" => good_homes_get_list_styles(1,2),
				"type" => "select"
				),
			
		
		
			// Section 'Content'
			'sidebar' => array(
				"title" => esc_html__('Sidebar', 'good-homes'),
				"desc" => wp_kses_data( __('Options of the sidebar area.', 'good-homes') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section",
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'good-homes'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'good-homes') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'good-homes')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'good-homes'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'good-homes') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'good-homes')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'good-homes'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'good-homes') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'good-homes')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'good-homes'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'good-homes') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'good-homes')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'good-homes')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'good-homes')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'good-homes')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'good-homes'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number in the site footer', 'good-homes') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'good-homes'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'good-homes')
				),
				"std" => 'footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'good-homes'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'good-homes') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'good-homes')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'good-homes'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'good-homes') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'good-homes')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'good-homes'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'good-homes') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'good-homes')
				),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => good_homes_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'good-homes'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'good-homes') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'good-homes')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'good-homes'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'good-homes') ),
				'refresh' => false,
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'good-homes') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'good-homes'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'good-homes') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'good-homes'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'good-homes') ),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'good-homes'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'good-homes') ),
				"std" => esc_html__('ThemeREX &copy; {Y}. All rights reserved. Terms of use and Privacy Policy', 'good-homes'),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'good-homes'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'good-homes') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'good-homes'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'good-homes') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'good-homes'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'good-homes') ),
				"std" => 'masonry',
				"options" => array(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'good-homes'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'good-homes') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style_home' => array(
				"title" => esc_html__('Header style', 'good-homes'),
				"desc" => wp_kses_data( __('Select style to display the site header on the homepage', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_home' => array(
				"title" => esc_html__('Header position', 'good-homes'),
				"desc" => wp_kses_data( __('Select position to display the site header on the homepage', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'good-homes'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'good-homes') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'good-homes'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'good-homes'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'good-homes') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'good-homes') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'good-homes') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'good-homes') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'good-homes') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'good-homes'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'good-homes') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'good-homes'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'good-homes') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'good-homes'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'good-homes'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'good-homes') ),
				"std" => 2,
				"options" => good_homes_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'good-homes'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => array(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'good-homes'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => array(),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'good-homes'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'meta_parts' => array(
				"title" => esc_html__('Post meta', 'good-homes'),
				"desc" => wp_kses_data( __("Select elements to show in the post meta area on default blog archive and search results. If your blog archive created by page with parameter 'Page template' equal to 'Blog archive' - please set up parameter 'Post meta' in the 'Theme Options' section of this page. Attention! You can drag items to change their order", 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"dir" => 'vertical',
				"sortable" => true,
				"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
				"options" => array(
					'categories' => esc_html__('Categories', 'good-homes'),
					'date'		 => esc_html__('Post date', 'good-homes'),
					'author'	 => esc_html__('Post author', 'good-homes'),
					'counters'	 => esc_html__('Post counters', 'good-homes'),
					'share'		 => esc_html__('Share links', 'good-homes'),
					'edit'		 => esc_html__('Edit link', 'good-homes')
				),
				"type" => "checklist"
			),
			'counters' => array(
				"title" => esc_html__('Counters', 'good-homes'),
				"desc" => wp_kses_data( __("Select counters to show in the post meta area on default blog archive and search results. If your blog archive created by page with parameter 'Page template' equal to 'Blog archive' - please set up parameter 'Counters' in the 'Theme Options' section of this page. Attention! You can drag items to change their order. Likes and Views available only if ThemeREX Addons is active", 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"dir" => 'vertical',
				"sortable" => true,
				"std" => 'views=1|likes=1|comments=1',
				"options" => array(
					'views' => esc_html__('Views', 'good-homes'),
					'likes' => esc_html__('Likes', 'good-homes'),
					'comments' => esc_html__('Comments', 'good-homes')
				),
				"type" => "checklist"
			),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'good-homes'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"std" => "links",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'good-homes'),
					'links'	=> esc_html__("Older/Newest", 'good-homes'),
					'more'	=> esc_html__("Load more", 'good-homes'),
					'infinite' => esc_html__("Infinite scroll", 'good-homes')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'good-homes'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"dependency" => array(
					'#page_template' => array('blog.php'),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'good-homes'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'good-homes') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'good-homes'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'good-homes') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'good-homes'),
					'fullpost'	=> esc_html__('Full post',	'good-homes')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'good-homes'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'good-homes') ),
				"std" => 5,
				"type" => "text"
				),
			'sticky_style' => array(
				"title" => esc_html__('Sticky posts style', 'good-homes'),
				"desc" => wp_kses_data( __('Select style of the sticky posts output', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(
					'inherit' => esc_html__('Decorated posts', 'good-homes'),
					'columns' => esc_html__('Mini-cards',	'good-homes')
				),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'good-homes'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'good-homes')
				),
				"dependency" => array(
					'#page_template' => array('blog.php')
				),
				"std" => "none",
				"options" => array(),
				"type" => "select"
				),
			'header_style_blog' => array(
				"title" => esc_html__('Header style', 'good-homes'),
				"desc" => wp_kses_data( __('Select style to display the site header on the blog archive', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_blog' => array(
				"title" => esc_html__('Header position', 'good-homes'),
				"desc" => wp_kses_data( __('Select position to display the site header on the blog archive', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'good-homes'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'good-homes'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'good-homes'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'good-homes') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single_blog' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'good-homes'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post", 'good-homes') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'good-homes'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'good-homes') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'good-homes'),
				"desc" => esc_html__("Modify colors and preview changes on your site", 'good-homes'),
				"priority" => 1000,
				"type" => "section"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Color schemes', 'good-homes'),
				"desc" => esc_html__('Select color scheme to modify. Attention! Only those sections will be changed which this scheme was assigned to', 'good-homes'),
				"std" => '$good_homes_get_scheme_storage',
				"refresh" => false,
				"type" => "scheme_editor"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'good-homes'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'good-homes') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'good-homes')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'good-homes'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'good-homes') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'good-homes')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'good-homes'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'good-homes'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'good-homes') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'good-homes') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'good-homes'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'good-homes') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'good-homes') ),
				"refresh" => false,
				"std" => '$good_homes_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=good_homes_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(__('Font %s', 'good-homes'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'good-homes'),
				"desc" => '',
				"refresh" => false,
				"std" => '$good_homes_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'good-homes'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'good-homes') )
							: '',
				"refresh" => false,
				"std" => '$good_homes_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'good-homes'),
					'serif' => esc_html__('serif', 'good-homes'),
					'sans-serif' => esc_html__('sans-serif', 'good-homes'),
					'monospace' => esc_html__('monospace', 'good-homes'),
					'cursive' => esc_html__('cursive', 'good-homes'),
					'fantasy' => esc_html__('fantasy', 'good-homes')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'good-homes'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'good-homes') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'good-homes') )
							: '',
				"refresh" => false,
				"std" => '$good_homes_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = good_homes_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'good-homes'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'good-homes'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'good-homes'),
						'100' => esc_html__('100 (Light)', 'good-homes'), 
						'200' => esc_html__('200 (Light)', 'good-homes'), 
						'300' => esc_html__('300 (Thin)',  'good-homes'),
						'400' => esc_html__('400 (Normal)', 'good-homes'),
						'500' => esc_html__('500 (Semibold)', 'good-homes'),
						'600' => esc_html__('600 (Semibold)', 'good-homes'),
						'700' => esc_html__('700 (Bold)', 'good-homes'),
						'800' => esc_html__('800 (Black)', 'good-homes'),
						'900' => esc_html__('900 (Black)', 'good-homes')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'good-homes'),
						'normal' => esc_html__('Normal', 'good-homes'), 
						'italic' => esc_html__('Italic', 'good-homes')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'good-homes'),
						'none' => esc_html__('None', 'good-homes'), 
						'underline' => esc_html__('Underline', 'good-homes'),
						'overline' => esc_html__('Overline', 'good-homes'),
						'line-through' => esc_html__('Line-through', 'good-homes')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'good-homes'),
						'none' => esc_html__('None', 'good-homes'), 
						'uppercase' => esc_html__('Uppercase', 'good-homes'),
						'lowercase' => esc_html__('Lowercase', 'good-homes'),
						'capitalize' => esc_html__('Capitalize', 'good-homes')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$good_homes_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		good_homes_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			good_homes_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'good-homes'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'good-homes') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'good-homes')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('good_homes_options_get_list_choises')) {
	add_filter('good_homes_filter_options_get_list_choises', 'good_homes_options_get_list_choises', 10, 2);
	function good_homes_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = good_homes_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = good_homes_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = good_homes_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, 'header_scheme')===0 
					|| strpos($id, 'menu_scheme')===0
					|| strpos($id, 'color_scheme')===0
					|| strpos($id, 'sidebar_scheme')===0
					|| strpos($id, 'footer_scheme')===0)
				$list = good_homes_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = good_homes_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = good_homes_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = good_homes_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = good_homes_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = good_homes_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = good_homes_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = good_homes_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = good_homes_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = good_homes_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = good_homes_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = good_homes_array_merge(array(0 => esc_html__('- Select category -', 'good-homes')), good_homes_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = good_homes_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = good_homes_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = good_homes_get_list_load_fonts(true);
		}
		return $list;
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('good_homes_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'good_homes_options_theme_setup2', 2 );
	function good_homes_options_theme_setup2() {
		good_homes_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('good_homes_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'good_homes_options_theme_setup5', 5 );
	function good_homes_options_theme_setup5() {
		good_homes_storage_set('options_reloaded', false);
		good_homes_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('good_homes_load_custom_options')) {
		add_action( 'wp_loaded', 'good_homes_load_custom_options' );
		function good_homes_load_custom_options() {
			if (!good_homes_storage_get('options_reloaded')) {
				good_homes_storage_set('options_reloaded', true);
				good_homes_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('good_homes_load_theme_options') ) {
	function good_homes_load_theme_options() {
		$options = good_homes_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$good_homes_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = $_GET[$k];
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				good_homes_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			good_homes_customizer_save_css();
		} else {
			do_action('good_homes_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('good_homes_override_theme_options') ) {
	add_action( 'wp', 'good_homes_override_theme_options', 1 );
	function good_homes_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			good_homes_storage_set('blog_archive', true);
			good_homes_storage_set('blog_template', get_the_ID());
		}
		good_homes_storage_set('blog_mode', good_homes_detect_blog_mode());
		if (is_singular()) {
			good_homes_storage_set('options_meta', get_post_meta(get_the_ID(), 'good_homes_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('good_homes_get_theme_option')) {
	function good_homes_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!good_homes_storage_isset('post_options_meta', $post_id))
				good_homes_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'good_homes_options', true));
			if (good_homes_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = good_homes_storage_get_array('post_options_meta', $post_id, $name);
				if (!good_homes_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && good_homes_storage_isset('options')) {
			$blog_mode = good_homes_storage_get('blog_mode');
			if ( !good_homes_storage_isset('options', $name) && (empty($blog_mode) || !good_homes_storage_isset('options', $name.'_'.$blog_mode)) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						//array_shift($s);
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'good-homes'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
						die();
					} else
						$rez = $defa;
				}
			} else {
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = $_REQUEST[$name . '_' . $blog_mode];
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = $_REQUEST[$name];
				// Override option from current page settings (if exists)
				} else if (good_homes_storage_isset('options_meta', $name) && !good_homes_is_inherit(good_homes_storage_get_array('options_meta', $name))) {
					$rez = good_homes_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && good_homes_storage_isset('options', $name . '_' . $blog_mode, 'val') && !good_homes_is_inherit(good_homes_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = good_homes_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (good_homes_storage_isset('options', $name, 'val')) {
					$rez = good_homes_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('good_homes_check_theme_option')) {
	function good_homes_check_theme_option($name) {
		return good_homes_storage_isset('options', $name);
	}
}


// Return customizable option value, stored in the posts meta
if (!function_exists('good_homes_get_theme_option_from_meta')) {
	function good_homes_get_theme_option_from_meta($name, $defa='') {
		$rez = $defa;
		if (good_homes_storage_isset('options_meta')) {
			if (good_homes_storage_isset('options_meta', $name))
				$rez = good_homes_storage_get_array('options_meta', $name);
			else
				$rez = 'inherit';
		}
		return $rez;
	}
}


// Get dependencies list from the Theme Options
if ( !function_exists('good_homes_get_theme_dependencies') ) {
	function good_homes_get_theme_dependencies() {
		$options = good_homes_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('good_homes_get_theme_setting')) {
	function good_homes_get_theme_setting($name) {
		if ( !good_homes_storage_isset('settings', $name) ) {
			$s = debug_backtrace();
			//array_shift($s);
			$s = array_shift($s);
			echo '<pre>' . sprintf(esc_html__('Undefined setting "%s" called from:', 'good-homes'), $name);
			if (function_exists('dco')) dco($s);
			else print_r($s);
			echo '</pre>';
			die();
		} else
			return good_homes_storage_get_array('settings', $name);
	}
}

// Set theme setting
if ( !function_exists( 'good_homes_set_theme_setting' ) ) {
	function good_homes_set_theme_setting($option_name, $value) {
		if (good_homes_storage_isset('settings', $option_name))
			good_homes_storage_set_array('settings', $option_name, $value);
	}
}
?>