<?php
/**
 * The template to display the main menu
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

$good_homes_header_text_text_phone_mail = good_homes_get_theme_option('header_title_text_phone_mail');
$good_homes_header_text_address = good_homes_get_theme_option('header_title_text_address');
$good_homes_header_title_top_panel_default_left = good_homes_get_theme_option('header_title_top_panel_default_left');
$good_homes_header_title_top_panel_default_right = good_homes_get_theme_option('header_title_top_panel_default_right');

?>
<div class="top_panel_default_top">
	<div class="content_wrap top_panel_default_header">
		<div class="columns_wrap">
			<div class="top_panel_default_left sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left column-1_2">
				<?php
				good_homes_show_layout($good_homes_header_title_top_panel_default_left)
				?>
			</div>
			<div class="top_panel_default_right sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left column-1_2">
				<?php
				good_homes_show_layout($good_homes_header_title_top_panel_default_right)
				?>
			</div>
		</div>
	</div>
</div>
<div class="top_panel_navi sc_layouts_row sc_layouts_row_type_compact sc_layouts_row_fixed
			scheme_<?php echo esc_attr(good_homes_is_inherit(good_homes_get_theme_option('menu_scheme')) 
												? (good_homes_is_inherit(good_homes_get_theme_option('header_scheme')) 
													? good_homes_get_theme_option('color_scheme') 
													: good_homes_get_theme_option('header_scheme')) 
												: good_homes_get_theme_option('menu_scheme')); ?>">



	<div class="content_wrap logo_content">
		<div class="columns_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left column-1_4">
				<?php
				// Logo
				?><div class="sc_layouts_item"><?php
					get_template_part( 'templates/header-logo' );
				?></div>
			</div>
			<div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left column-3_4">
				<div class="sc_layouts_item">
					<?php
					if (!empty($good_homes_header_text_text_phone_mail)) { ?>
					<span class="address_header_icon icon-location-outline"></span>
						<div class="address_header">
						<?php
						 echo str_replace('|', "<br><span>", $good_homes_header_text_address);

						?></span>
						</div><?php
					}

					?>
				</div>
				<div class="sc_layouts_item">
					<?php
					if (!empty($good_homes_header_text_address)) { ?>
						<span class="address_phone_icon icon-phone-outline"></span>
						<div class="address_phone">
						<?php
						echo str_replace('|', "<br><span>", $good_homes_header_text_text_phone_mail);

						?></span>
						</div><?php
					}

					?>
				</div>
			</div>
		</div>
	</div>

	<div class="content_wrap menu_content">
		<div class="columns_wrap">
			<?php

			// Attention! Don't place any spaces between columns!
			?><div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left column-3_4">
				<div class="sc_layouts_item">
					<?php
					// Main menu
					$good_homes_menu_main = good_homes_get_nav_menu(array(
						'location' => 'menu_main', 
						'class' => 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile'
						)
					);
					if (empty($good_homes_menu_main)) {
						$good_homes_menu_main = good_homes_get_nav_menu(array(
							'class' => 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile'
							)
						);
					}
					good_homes_show_layout($good_homes_menu_main);
					// Mobile menu button
					?>
					<div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
						<a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
							<span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
						</a>
					</div>
				</div>
			</div><?php
			
				// Attention! Don't place any spaces between layouts items!
				?>
				<div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left column-1_4">
					<div class="sc_layouts_item">
						<?php
						// Display search field
						do_action('good_homes_action_search', 'normal', 'header_search', false);
						?>
					</div>
				</div>			

		</div><!-- /.sc_layouts_row -->
	</div><!-- /.content_wrap -->
</div><!-- /.top_panel_navi -->