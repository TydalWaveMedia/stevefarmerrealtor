<?php
/**
 * The style "default" of the Widget "Properties Search"
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.22
 */

$trx_addons_args = get_query_var('trx_addons_args_widget_properties_search');
extract($trx_addons_args);

$params = array_merge(array(
						'properties_keyword' => '',
						'properties_country' => '',
						'properties_state' => '',
						'properties_city' => '',
						'properties_neighborhood' => '',
						'properties_status' => '',
						'properties_type' => '',
						'properties_labels' => '',
						'properties_bedrooms' => '',
						'properties_bathrooms' => '',
						'properties_area' => '',
						'properties_price' => '',
						'properties_features' => array(),
						'properties_order' => sprintf("%s_%s", $orderby, $order)
						), trx_addons_cpt_properties_query_params());

// Before widget (defined by themes)
trx_addons_show_layout($before_widget);
			
// Widget title if one was input (before and after defined by themes)
trx_addons_show_layout($title, $before_title, $after_title);
	
// Widget body
$form_style = $trx_addons_args['style'] = empty($trx_addons_args['style']) || trx_addons_is_inherit($trx_addons_args['style']) 
			? trx_addons_get_option('input_hover') 
			: $trx_addons_args['style'];
?><div
	<?php if (!empty($trx_addons_args['id'])) echo ' id="'.esc_attr($trx_addons_args['id']).'"'; ?>
	class="sc_form properties_search_opened properties_search properties_search_<?php
		echo esc_attr($trx_addons_args['type']);
		if (!empty($trx_addons_args['class'])) echo ' '.esc_attr($trx_addons_args['class']);
		if (!empty($trx_addons_args['align']) && !trx_addons_is_off($trx_addons_args['align'])) echo ' sc_align_'.esc_attr($trx_addons_args['align']);
		?>"<?php
	if (!empty($trx_addons_args['css'])) echo ' style="'.esc_attr($trx_addons_args['css']).'"'; 
?>>
	<form class="properties_search_form sc_form_form sc_form_custom <?php if ($form_style != 'default') echo 'sc_input_hover_'.esc_attr($form_style); ?>" action="<?php echo esc_url(get_post_type_archive_link( TRX_ADDONS_CPT_PROPERTIES_PT )); ?>" method="get">
		<div class="properties_search_basic"><?php

			// Keywords
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
				'trx_addons_args_sc_form_field',
				array_merge($trx_addons_args, array(
					'labels'      => true,
					'field_name'  => 'properties_keyword',
					'field_type'  => 'text',
					'field_value' => $params['properties_keyword'],
					'field_req'   => false,
					'field_icon'  => 'trx_addons_icon-search',
					'field_title' => __('Enter an address', 'trx_addons'),
					'field_placeholder' => __('Enter an address, city, ZIP or property ID', 'trx_addons')
				))
			);

			// Country
			$tax_obj = get_taxonomy(TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_COUNTRY);
			$list = trx_addons_array_merge(array(0 => esc_html(sprintf(__('- %s -', 'trx_addons'), $tax_obj->label))),
				trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_COUNTRY));
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
				'trx_addons_args_sc_form_field',
				array_merge($trx_addons_args, array(
					'labels'      => true,
					'field_name'  => 'properties_country',
					'field_type'  => 'select',
					'field_value' => $params['properties_country'],
					'field_req'   => false,
					'field_options'  => $list,
					'field_title' => __('Location', 'trx_addons'),
					'field_class' => 'trx_addons_country_selector',
					'field_data'  => array('not-selected' => 'true')
				))
			);

			// State
			$tax_obj = get_taxonomy(TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_STATE);
			$list = trx_addons_array_merge(array(0 => esc_html(sprintf(__('- %s -', 'trx_addons'), $tax_obj->label))),
				$params['properties_country'] == 0
					? array()
					: trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_STATE, array(
					'meta_key' => 'country',
					'meta_value' => $params['properties_country']
				))
			);
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
				'trx_addons_args_sc_form_field',
				array_merge($trx_addons_args, array(
					'labels'      => true,
					'field_name'  => 'properties_state',
					'field_type'  => 'select',
					'field_value' => $params['properties_state'],
					'field_req'   => false,
					'field_options'  => $list,
					'field_title' => __('State', 'trx_addons'),
					'field_class' => 'trx_addons_state_selector',
					'field_data'  => array('not-selected' => 'true')
				))
			);

			// City
			$args = array();
			if ($params['properties_state'] > 0)
				$args = array(
					'meta_key' => 'state',
					'meta_value' => $params['properties_state']
				);
			else if ($params['properties_country'] > 0)
				$args = array(
					'meta_key' => 'country',
					'meta_value' => $params['properties_country']
				);
			$tax_obj = get_taxonomy(TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_CITY);
			$list = trx_addons_array_merge(array(0 => esc_html(sprintf(__('- %s -', 'trx_addons'), $tax_obj->label))),
				count($args) == 0
					? array()
					: trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_CITY, $args)
			);
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
				'trx_addons_args_sc_form_field',
				array_merge($trx_addons_args, array(
					'labels'      => true,
					'field_name'  => 'properties_city',
					'field_type'  => 'select',
					'field_value' => $params['properties_city'],
					'field_req'   => false,
					'field_options'  => $list,
					'field_title' => __('City', 'trx_addons'),
					'field_class' => 'trx_addons_city_selector',
					'field_data'  => array('not-selected' => 'true')
				))
			);

			// Neighborhood
			$tax_obj = get_taxonomy(TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_NEIGHBORHOOD);
			$list = trx_addons_array_merge(array(0 => esc_html(sprintf(__('- %s -', 'trx_addons'), $tax_obj->label))),
				$params['properties_city'] == 0
					? array()
					: trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_NEIGHBORHOOD, array(
					'meta_key' => 'city',
					'meta_value' => $params['properties_city']
				))
			);
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
				'trx_addons_args_sc_form_field',
				array_merge($trx_addons_args, array(
					'labels'      => true,
					'field_name'  => 'properties_neighborhood',
					'field_type'  => 'select',
					'field_value' => $params['properties_neighborhood'],
					'field_req'   => false,
					'field_options'  => $list,
					'field_title' => __('Neighborhood', 'trx_addons'),
					'field_class' => 'trx_addons_neighborhood_selector',
					'field_data'  => array('not-selected' => 'true')
				))
			);
		


			// Basic Submit button
			?><button class="properties_search_button" title="<?php esc_attr_e('Start search', 'trx_addons'); ?>"><?php esc_attr_e('Search', 'trx_addons'); ?></button><?php
			
			
		?></div><!-- /.properties_search_basic -->

		<div class="properties_search_advanced"><?php



			// Status
			$tax_obj = get_taxonomy(TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_STATUS);
			$list = trx_addons_array_merge(array(0 => esc_html(sprintf(__('- %s -', 'trx_addons'), $tax_obj->label))),
											trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_STATUS));
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => false,
														'field_name'  => 'properties_status',
														'field_type'  => 'select',
														'field_value' => $params['properties_status'],
														'field_req'   => false,
														'field_options'  => $list
														))
										);

			// Type
			$tax_obj = get_taxonomy(TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_TYPE);
			$list = trx_addons_array_merge(array(0 => esc_html(sprintf(__('- %s -', 'trx_addons'), $tax_obj->label))),
											trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_TYPE));
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => false,
														'field_name'  => 'properties_type',
														'field_type'  => 'select',
														'field_value' => $params['properties_type'],
														'field_req'   => false,
														'field_options'  => $list
														))
										);

			// Label
			$tax_obj = get_taxonomy(TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_LABELS);
			$list = trx_addons_array_merge(array(0 => esc_html(sprintf(__('- %s -', 'trx_addons'), $tax_obj->label))),
											trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_LABELS));
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => false,
														'field_name'  => 'properties_labels',
														'field_type'  => 'select',
														'field_value' => $params['properties_labels'],
														'field_req'   => false,
														'field_options'  => $list
														))
										);

			// Results Order
			?><label class="sc_form_field sc_form_field_properties_order">
				<select name="properties_order">
					<option value="date_asc"<?php if ($params['properties_order']=='date_asc') echo ' selected="selected"'; ?>><?php
						esc_html_e('Date Ascending', 'trx_addons'); ?></option>
					<option value="date_desc"<?php if ($params['properties_order']=='date_desc') echo ' selected="selected"'; ?>><?php
						esc_html_e('Date Descending', 'trx_addons'); ?></option>
					<option value="price_asc"<?php if ($params['properties_order'] == 'price_asc') echo ' selected="selected"'; ?>><?php
						esc_html_e('Price Ascending', 'trx_addons'); ?></option>
					<option value="price_desc"<?php if ($params['properties_order'] == 'price_desc') echo ' selected="selected"'; ?>><?php
						esc_html_e('Price Descending', 'trx_addons'); ?></option>
					<option value="title_asc"<?php if ($params['properties_order'] == 'title_asc') echo ' selected="selected"'; ?>><?php
						esc_html_e('Title Ascending', 'trx_addons'); ?></option>
					<option value="title_desc"<?php if ($params['properties_order'] == 'title_desc') echo ' selected="selected"'; ?>><?php
						esc_html_e('Title Descending', 'trx_addons'); ?></option>
				</select>
			</label><?php
			?>
			<div class="separator"></div>
			<?php
			// Bedrooms
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => true,
														'field_title' => __('Bedrooms', 'trx_addons'),
														'field_name'  => 'properties_bedrooms',
														'field_type'  => 'range',
														'field_value' => $params['properties_bedrooms'],
														'field_req'   => false,
														'field_min'   => trx_addons_cpt_properties_get_min_max('bed_min'),
														'field_max'   => trx_addons_cpt_properties_get_min_max('bed_max'),
														'field_step'  => 1
														))
										);

			// Bathrooms
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => true,
														'field_title' => __('Bathrooms', 'trx_addons'),
														'field_name'  => 'properties_bathrooms',
														'field_type'  => 'range',
														'field_value' => $params['properties_bathrooms'],
														'field_req'   => false,
														'field_min'   => trx_addons_cpt_properties_get_min_max('bath_min'),
														'field_max'   => trx_addons_cpt_properties_get_min_max('bath_max'),
														'field_step'  => 1
														))
										);

			// Area size
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => true,
														'field_title' => __('Area size', 'trx_addons'),
														'field_name'  => 'properties_area',
														'field_type'  => 'range',
														'field_value' => $params['properties_area'],
														'field_req'   => false,
														'field_min'   => trx_addons_cpt_properties_get_min_max('area_min'),
														'field_max'   => trx_addons_cpt_properties_get_min_max('area_max'),
														'field_step'  => (trx_addons_cpt_properties_get_min_max('area_max') - trx_addons_cpt_properties_get_min_max('area_min')) / 20
														))
										);

			// Price
			trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => true,
														'field_title' => __('Price', 'trx_addons'),
														'field_name'  => 'properties_price',
														'field_type'  => 'range',
														'field_value' => $params['properties_price'],
														'field_req'   => false,
														'field_min'   => trx_addons_cpt_properties_get_min_max('price_min'),
														'field_max'   => trx_addons_cpt_properties_get_min_max('price_max'),
														'field_step'  => (trx_addons_cpt_properties_get_min_max('price_max') - trx_addons_cpt_properties_get_min_max('price_min')) / 20
														))
										);

			// Features
			$list = trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_FEATURES);
			if (is_array($list)) {
				foreach ($list as $id=>$title) {
					trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
											'trx_addons_args_sc_form_field',
											array_merge($trx_addons_args, array(
														'labels'      => true,
														'field_placeholder' => $title,
														'field_name'  => "properties_features_{$id}",
														'field_type'  => 'checkbox',
														'field_value' => $id,
														'field_checked' => in_array($id, $params['properties_features']),
														'field_req'   => false
														))
											);
				}
			}

		?></div><!-- /.properties_search_advanced -->

	</form>
</div><!-- /.sc_form --><?php

// After widget (defined by themes)
trx_addons_show_layout($after_widget);
?>