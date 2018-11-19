<?php
/**
 * Template of the custom slide content with Property's data for the Swiper
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.23
 */

$args = get_query_var('trx_addons_args_properties_slider_slide');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();

?><div class="sc_properties_slider_columns <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?>"><?php



    // Second column with image
    ?><div class="sc_properties_slider_column <?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?>">
        <figure class="sc_properties_slider_image">
            <?php the_post_thumbnail(trx_addons_get_thumb_size('big-avatar'), array('alt' => get_the_title())); ?>
        </figure>
    </div><?php
	
	// First column with data
	?><div class="sc_properties_slider_column <?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?>">

        <div class="sc_properties_item_row sc_properties_item_row_address"><?php
            // Address
            ?><span class="sc_properties_item_option sc_properties_item_address" title="<?php esc_html_e('Address', 'trx_addons'); ?>">
					<span class="sc_properties_item_option_data"><?php
                        trx_addons_get_template_part('cpt/properties/tpl.properties.parts.address.php',
                            'trx_addons_args_properties_address',
                            array(
                                'meta' => array(
                                    'address' => $meta['address'],
                                    'neighborhood' => $meta['neighborhood'],
                                    'city' => $meta['city']
                                )
                            ));
                        ?></span>
				</span><?php
            ?></div><?php

        // Type
        ?><div class="sc_properties_item_type"><?php
            trx_addons_show_layout(trx_addons_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_TYPE));
            ?>
        </div>

        <div class="sc_properties_item_price"><?php  echo(trx_addons_get_template_part_as_string(
                'cpt/properties/tpl.properties.parts.price.php',
                'trx_addons_args_properties_price',
                array(
                    'meta' => $meta
                )
            ))?>
        </div>


        <div class="sc_properties_slider_content_column <?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?> first">
            <span><?php echo esc_html($meta['bedrooms']); ?></span>
            <span><?php esc_html_e('bedrooms, ', 'trx_addons'); ?></span>

            <?php
            // Bathrooms
            if (!empty($meta['bathrooms'])) {
            ?><span class="sc_properties_item_option sc_properties_item_bathrooms" title="<?php esc_html_e('Bathrooms number', 'trx_addons'); ?>">
                        <span class="sc_properties_item_option_data"><?php echo esc_html($meta['bathrooms']); ?></span>
						<span class="sc_properties_item_option_label">
							<span class="sc_properties_item_option_label_text"><?php esc_html_e('baths', 'trx_addons'); ?></span>
						</span>

					</span><?php
            }?>

                <?php   if (!empty($meta['area_size'])) {
                ?>  <div class="sc_properties_item_option_data_area_size"><span class="sc_properties_item_option_label_text"><?php esc_html_e('Home size:', 'trx_addons'); ?></span>
                <span class="sc_properties_item_option_data"><?php
                    trx_addons_show_layout($meta['area_size']
                        . ($meta['area_size_prefix']
                            ? ' ' . trx_addons_prepare_macros($meta['area_size_prefix'])
                            : ''
                        )
                    );
                    ?></span></div>
                <?php
                }


            // Agent
            if ($meta['agent_type']!='none' && ($meta['agent_type']=='author' || $meta['agent']!=0)) {
                ?><div><span class="sc_properties_item_option sc_properties_item_author" title="<?php esc_html_e('Agent or post author', 'trx_addons'); ?>">
                <span class="sc_properties_item_option_label">
							<span class="sc_properties_item_option_label_icon trx_addons_icon-user-alt"></span>
							<span class="sc_properties_item_option_label_text"><?php esc_html_e('Agent:', 'trx_addons'); ?></span>
						</span>
						<span class="sc_properties_item_option_data"><?php
                            $trx_addons_agent = trx_addons_properties_get_agent_data($meta);
                            echo (!empty($trx_addons_agent['posts_link'])
                                    ? '<a href="'.esc_url($trx_addons_agent['posts_link']).'">'
                                    : ''
                                )
                                . esc_html($trx_addons_agent['name'])
                                . (!empty($trx_addons_agent['posts_link'])
                                    ? '</a>'
                                    : ''
                                );
                            ?></span>
                </span></div><?php
            }?>
        </div>


        <div class="sc_properties_slider_content_column <?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?> second"><?php
            // Year built
            if (!empty($meta['built'])) {
            ?><div><span class="sc_properties_item_option sc_properties_item_built" title="<?php esc_html_e('Year built', 'trx_addons'); ?>">
						<span class="sc_properties_item_option_label">
							<span class="sc_properties_item_option_label_text"><?php esc_html_e('Built:', 'trx_addons'); ?></span>
						</span>
						<span class="sc_properties_item_option_data"><?php trx_addons_show_layout($meta['built']); ?></span>
					</span></div><?php
            }

            // Garages
            if (!empty($meta['garages'])) {
            ?><div class="sc_properties_item_option_data_garage_size"><span class="sc_properties_item_option sc_properties_item_garages" title="<?php esc_html_e('Garages number and size', 'trx_addons'); ?>">
						<span class="sc_properties_item_option_label">
							<span class="sc_properties_item_option_label_text"><?php esc_html_e('Garages:', 'trx_addons'); ?></span>
						</span>
						<span class="sc_properties_item_option_data"><?php
                            trx_addons_show_layout($meta['garages']
                                . ($meta['garage_size']
                                    ? ' (' . trx_addons_prepare_macros($meta['garage_size']) . ')'
                                    : ''
                                )
                            );
                            ?></span>
					</span></div><?php
            }

            // Publish date
            ?><div><span class="sc_properties_item_option sc_properties_item_date" title="<?php esc_html_e('Publish date', 'trx_addons'); ?>">
					<span class="sc_properties_item_option_label">
						<span class="sc_properties_item_option_label_icon trx_addons_icon-calendar"></span>
						<span class="sc_properties_item_option_label_text"><?php esc_html_e('Added:', 'trx_addons'); ?></span>
					</span>
					<span class="sc_properties_item_option_data"><?php
                        echo apply_filters('trx_addons_filter_get_post_date', date('d.m.y', get_the_date('U')));
                        ?></span>
				</span></div>

        </div>

		<?php
		trx_addons_show_layout(trx_addons_sc_button(array(
										'link' => $link,
										'title' => esc_html__('View Offer', 'trx_addons'),
										'class' => 'sc_properties_slider_data_button'
										)
								));
		?>
	</div>
</div>