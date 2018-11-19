<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

// Page (category, tag, archive, author) title

if ( good_homes_need_page_title() ) {
	good_homes_sc_layouts_showed('title', true);
	good_homes_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								good_homes_show_post_meta(apply_filters('good_homes_filter_post_meta_args', array(
									'components' => 'categories,date,counters,edit',
									'counters' => 'views,comments,likes',
									'seo' => true
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$good_homes_blog_title = good_homes_get_blog_title();
							$good_homes_blog_title_text = $good_homes_blog_title_class = $good_homes_blog_title_link = $good_homes_blog_title_link_text = '';
							if (is_array($good_homes_blog_title)) {
								$good_homes_blog_title_text = $good_homes_blog_title['text'];
								$good_homes_blog_title_class = !empty($good_homes_blog_title['class']) ? ' '.$good_homes_blog_title['class'] : '';
								$good_homes_blog_title_link = !empty($good_homes_blog_title['link']) ? $good_homes_blog_title['link'] : '';
								$good_homes_blog_title_link_text = !empty($good_homes_blog_title['link_text']) ? $good_homes_blog_title['link_text'] : '';
							} else
								$good_homes_blog_title_text = $good_homes_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($good_homes_blog_title_class); ?>"><?php
								$good_homes_top_icon = good_homes_get_category_icon();
								if (!empty($good_homes_top_icon)) {
									$good_homes_attr = good_homes_getimagesize($good_homes_top_icon);
									?><img src="<?php echo esc_url($good_homes_top_icon); ?>" alt="" <?php if (!empty($good_homes_attr[3])) good_homes_show_layout($good_homes_attr[3]);?>><?php
								}
								echo wp_kses_data($good_homes_blog_title_text);
							?></h1>
							<?php
							if (!empty($good_homes_blog_title_link) && !empty($good_homes_blog_title_link_text)) {
								?><a href="<?php echo esc_url($good_homes_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($good_homes_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'good_homes_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>