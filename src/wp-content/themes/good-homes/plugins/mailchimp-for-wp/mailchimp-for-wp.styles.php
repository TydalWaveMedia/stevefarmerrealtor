<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('good_homes_mailchimp_get_css')) {
	add_filter('good_homes_filter_get_css', 'good_homes_mailchimp_get_css', 10, 4);
	function good_homes_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = good_homes_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS



.mc4wp-form input[type="email"] {
	border-color: {$colors['bd_color']}!important;
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

.mc4wp-form input[type="submit"] {
	background-color: {$colors['inverse_bd_color']};
	color: {$colors['text_link']};
}
.mc4wp-form input[type="submit"]:hover {
	background-color: {$colors['bg_color']};
	color: {$colors['text_link']};
}


.mc4wp-form input[type="email"]::-webkit-input-placeholder {color:{$colors['alter_dark']}; opacity: 1;}
.mc4wp-form input[type="email"]::-moz-placeholder          {color:{$colors['alter_dark']}; opacity: 1;}/* Firefox 19+ */
.mc4wp-form input[type="email"]:-moz-placeholder           {color:{$colors['alter_dark']}; opacity: 1;}/* Firefox 18- */
.mc4wp-form input[type="email"]:-ms-input-placeholder      {color:{$colors['alter_dark']}; opacity: 1;}



.mc4wp-form .mc4wp-alert {
	background-color: {$colors['text_link']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
CSS;
		}

		return $css;
	}
}
?>