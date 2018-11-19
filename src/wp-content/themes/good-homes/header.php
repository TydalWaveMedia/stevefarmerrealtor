<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js scheme_<?php
										 // Class scheme_xxx need in the <html> as context for the <body>!
										 echo esc_attr(good_homes_get_theme_option('color_scheme'));
										 ?>">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php do_action( 'good_homes_action_before' ); ?>

	<div class="body_wrap">

		<div class="page_wrap">

			<?php
			// Desktop header
			$good_homes_header_style = good_homes_get_theme_option("header_style");
			if (strpos($good_homes_header_style, 'header-custom-')===0) $good_homes_header_style = 'header-custom';
			get_template_part( "templates/{$good_homes_header_style}");

			// Side menu
			if (in_array(good_homes_get_theme_option('menu_style'), array('left', 'right'))) {
				get_template_part( 'templates/header-navi-side' );
			}

			// Mobile header
			get_template_part( 'templates/header-mobile');
			?>

			<div class="page_content_wrap scheme_<?php echo esc_attr(good_homes_get_theme_option('color_scheme')); ?>">

				<?php if (good_homes_get_theme_option('body_style') != 'fullscreen') { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					good_homes_create_widgets_area('widgets_above_page');
					?>				

					<div class="content">
						<?php
						// Widgets area inside page content
						good_homes_create_widgets_area('widgets_above_content');
						?>				
