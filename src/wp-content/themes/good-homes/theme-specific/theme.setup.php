<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.22
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
if ( !function_exists('good_homes_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'good_homes_customizer_theme_setup1', 1 );
	function good_homes_customizer_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		good_homes_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Roboto',
				'family' => 'sans-serif',
				'styles' => '300,300italic,400,400italic,500,700,700italic,900'		// Parameter 'style' used only for the Google fonts
				),

		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		good_homes_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		good_homes_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'good-homes'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.4em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '2.5em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.543em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '0.9583em',
				'margin-bottom'		=> '0.44em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '2.07em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.79em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '0.85em',
				'margin-bottom'		=> '0.5em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '1.857em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.307em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '1.3em',
				'margin-bottom'		=> '0.87em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '1.571em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.545em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '1.45em',
				'margin-bottom'		=> '0.95em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '1.4286em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.545em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.6em',
				'margin-bottom'		=> '1.1em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '1.143em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.9em',
				'margin-bottom'		=> '1.2em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'good-homes'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'good-homes'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'good-homes'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'good-homes'),
				'description'		=> esc_html__('Font settings of the main menu items', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '900',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'good-homes'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'good-homes'),
				'font-family'		=> 'Roboto, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		good_homes_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'good-homes'),
							'description'	=> __('Colors of the main content area', 'good-homes')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'good-homes'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'good-homes')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'good-homes'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'good-homes')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'good-homes'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'good-homes')
							),
			'input'	=> array(
							'title'			=> __('Input', 'good-homes'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'good-homes')
							),
			)
		);
		good_homes_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'good-homes'),
							'description'	=> __('Background color of this block in the normal state', 'good-homes')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'good-homes'),
							'description'	=> __('Background color of this block in the hovered state', 'good-homes')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'good-homes'),
							'description'	=> __('Border color of this block in the normal state', 'good-homes')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'good-homes'),
							'description'	=> __('Border color of this block in the hovered state', 'good-homes')
							),
			'text'		=> array(
							'title'			=> __('Text', 'good-homes'),
							'description'	=> __('Color of the plain text inside this block', 'good-homes')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'good-homes'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'good-homes')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'good-homes'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'good-homes')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'good-homes'),
							'description'	=> __('Color of the links inside this block', 'good-homes')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'good-homes'),
							'description'	=> __('Color of the hovered state of links inside this block', 'good-homes')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'good-homes'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'good-homes')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'good-homes'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'good-homes')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'good-homes'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'good-homes')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'good-homes'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'good-homes')
							)
			)
		);
		good_homes_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'good-homes'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',//+
					'bd_color'			=> '#e5e7e7',//+
		
					// Text and links colors
					'text'				=> '#949494',//+
					'text_light'		=> '#b7b7b7',
					'text_dark'			=> '#262626',//+
					'text_link'			=> '#f7505c',//+
					'text_hover'		=> '#1d1f1f',//+
					'text_link2'		=> '#80d572',
					'text_hover2'		=> '#8be77c',
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#edf1f2',//+
					'alter_bg_hover'	=> '#dce2e3',//+
					'alter_bd_color'	=> '#d6dbdb',//+
					'alter_bd_hover'	=> '#d0d7d8',//+
					'alter_text'		=> '#8f9699',//+
					'alter_light'		=> '#b5babc',//+
					'alter_dark'		=> '#1c1e1e',//+
					'alter_link'		=> '#f7505c',//+
					'alter_hover'		=> '#72cfd5',
					'alter_link2'		=> '#80d572',
					'alter_hover2'		=> '#8be77c',
					'alter_link3'		=> '#ddb837',
					'alter_hover3'		=> '#eec432',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#edf1f2',//+
					'extra_bg_hover'	=> '#737271',//+
					'extra_bd_color'	=> '#dadddd',//+
					'extra_bd_hover'	=> '#c2c2c2',//++++++++++
					'extra_text'		=> '#262828',//+
					'extra_light'		=> '#d9dddd',//+
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#72cfd5',
					'extra_hover'		=> '#f7505c',//+
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#edf1f2',//+
					'input_bg_hover'	=> '#e7eaed',
					'input_bd_color'	=> '#dde2e3',//+
					'input_bd_hover'	=> '#e6ebec',//+
					'input_text'		=> '#959b9c',//+
					'input_light'		=> '#d0d0d0',
					'input_dark'		=> '#1d1d1d',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#f7505c',//+
					'inverse_bd_hover'	=> '#2b2e2e',//+
					'inverse_text'		=> '#ffffff',//+
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#262626',//+
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'good-homes'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#0e0d12',
					'bd_color'			=> '#ffffff',//+
		
					// Text and links colors
					'text'				=> '#b7b7b7',
					'text_light'		=> '#5f5f5f',
					'text_dark'			=> '#ffffff',//+
					'text_link'			=> '#f7505c',//+
					'text_hover'		=> '#f7505c',
					'text_link2'		=> '#80d572',
					'text_hover2'		=> '#8be77c',
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#1d1f1f',//+
					'alter_bg_hover'	=> '#edf1f2',//+
					'alter_bd_color'	=> '#4a5052',//+
					'alter_bd_hover'	=> '#3d3d3d',
					'alter_text'		=> '#8f9699',//+
					'alter_light'		=> '#6a7275',//+
					'alter_dark'		=> '#ffffff',//+
					'alter_link'		=> '#f7505c',
					'alter_hover'		=> '#fe7259',
					'alter_link2'		=> '#80d572',
					'alter_hover2'		=> '#8be77c',
					'alter_link3'		=> '#ddb837',
					'alter_hover3'		=> '#eec432',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#737271',//+
					'extra_bd_color'	=> '#2c2f30',//+
					'extra_bd_hover'	=> '#ffffff',//+++++
					'extra_text'		=> '#a6a6a6',
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#181a1b',//+
					'extra_link'		=> '#f7505c',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#2e2d32',
					'input_bg_hover'	=> '#2e2d32',
					'input_bd_color'	=> '#2e2d32',
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#1d1d1d',//+
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#ffffff',//+
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',//+
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',//+
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('good_homes_customizer_add_theme_colors')) {
	function good_homes_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = good_homes_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = good_homes_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = good_homes_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bd_color_05']  = good_homes_hex2rgba( $colors['bd_color'], 0.5 );
			$colors['bg_color_08']  = good_homes_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = good_homes_hex2rgba( $colors['bg_color'], 0.9 );
            $colors['bd_color_01']  = good_homes_hex2rgba( $colors['bd_color'], 0.1 );
			$colors['alter_bg_color_07']  = good_homes_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = good_homes_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = good_homes_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = good_homes_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = good_homes_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['extra_bd_hover_05']  = good_homes_hex2rgba( $colors['extra_bd_color'], 0.5 );
			$colors['text_dark_07']  = good_homes_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_dark_06']  = good_homes_hex2rgba( $colors['text_dark'], 0.6 );
			$colors['text_link_02']  = good_homes_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = good_homes_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = good_homes_hsb2hex(good_homes_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = good_homes_hsb2hex(good_homes_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
            $colors['inverse_link_07']  = good_homes_hex2rgba( $colors['inverse_link'], 0.7 );
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bd_color_05'] = '{{ data.bd_color_05 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
            $colors['bd_color_01'] = '{{ data.bd_color_01 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['extra_bd_hover_05'] = '{{ data.extra_bd_hover_05 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_dark_06'] = '{{ data.text_dark_06 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
            $colors['inverse_link_07'] = '{{ data.inverse_link_07 }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('good_homes_customizer_add_theme_fonts')) {
	function good_homes_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			//$rez[$tag] = $font;
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !good_homes_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !good_homes_is_inherit($font['font-size'])
														? 'font-size:' . good_homes_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !good_homes_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !good_homes_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !good_homes_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !good_homes_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !good_homes_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !good_homes_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !good_homes_is_inherit($font['margin-top'])
														? 'margin-top:' . good_homes_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !good_homes_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . good_homes_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('good_homes_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'good_homes_customizer_theme_setup' );
	function good_homes_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('good_homes_filter_add_thumb_sizes', array(
			'good_homes-thumb-huge'		=> array(1170, 658, true),
			'good_homes-thumb-big' 		=> array( 760, 428, true),
			'good_homes-thumb-big-avatar' 	=> array( 760, 620, true),
			'good_homes-thumb-avatar' 		=> array( 428, 428, true),
			'good_homes-thumb-med' 		=> array( 370, 208, true),
			'good_homes-thumb-tiny' 		=> array(  90,  90, true),
			'good_homes-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'good_homes-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = good_homes_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'good_homes_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('good_homes_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'good_homes_customizer_image_sizes' );
	function good_homes_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('good_homes_filter_add_thumb_sizes', array(
			'good_homes-thumb-huge'		=> esc_html__( 'Fullsize image', 'good-homes' ),
			'good_homes-thumb-big'			=> esc_html__( 'Large image', 'good-homes' ),
			'good_homes-thumb-big-avatar'	=> esc_html__( 'Large image avatar', 'good-homes' ),
			'good_homes-thumb-avatar'		=> esc_html__( 'Avatar image', 'good-homes' ),
			'good_homes-thumb-med'			=> esc_html__( 'Medium image', 'good-homes' ),
			'good_homes-thumb-tiny'		=> esc_html__( 'Small square avatar', 'good-homes' ),
			'good_homes-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'good-homes' ),
			'good_homes-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'good-homes' ),
			)
		);
		$mult = good_homes_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'good-homes' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'good_homes_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'good_homes_customizer_trx_addons_add_thumb_sizes');
	function good_homes_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-big-avatar',
								'trx_addons-thumb-avatar',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'good_homes_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'good_homes_customizer_trx_addons_get_thumb_size');
	function good_homes_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
                            'trx_addons-thumb-big-avatar',
							'trx_addons-thumb-big-avatar-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'good_homes-thumb-huge',
							'good_homes-thumb-huge-@retina',
							'good_homes-thumb-big',
							'good_homes-thumb-big-@retina',
                            'good_homes-thumb-big-avatar',
							'good_homes-thumb-big-avatar-@retina',
							'good_homes-thumb-med',
							'good_homes-thumb-med-@retina',
							'good_homes-thumb-tiny',
							'good_homes-thumb-tiny-@retina',
							'good_homes-thumb-masonry-big',
							'good_homes-thumb-masonry-big-@retina',
							'good_homes-thumb-masonry',
							'good_homes-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}
?>