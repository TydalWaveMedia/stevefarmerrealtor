<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

good_homes_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'classie', good_homes_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'good_homes-gallery-script', good_homes_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$good_homes_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$good_homes_sticky_out = good_homes_get_theme_option('sticky_style')=='columns' 
							&& is_array($good_homes_stickies) && count($good_homes_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$good_homes_cat = good_homes_get_theme_option('parent_cat');
	$good_homes_post_type = good_homes_get_theme_option('post_type');
	$good_homes_taxonomy = good_homes_get_post_type_taxonomy($good_homes_post_type);
	$good_homes_show_filters = good_homes_get_theme_option('show_filters');
	$good_homes_tabs = array();
	if (!good_homes_is_off($good_homes_show_filters)) {
		$good_homes_args = array(
			'type'			=> $good_homes_post_type,
			'child_of'		=> $good_homes_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $good_homes_taxonomy,
			'pad_counts'	=> false
		);
		$good_homes_portfolio_list = get_terms($good_homes_args);
		if (is_array($good_homes_portfolio_list) && count($good_homes_portfolio_list) > 0) {
			$good_homes_tabs[$good_homes_cat] = esc_html__('All', 'good-homes');
			foreach ($good_homes_portfolio_list as $good_homes_term) {
				if (isset($good_homes_term->term_id)) $good_homes_tabs[$good_homes_term->term_id] = $good_homes_term->name;
			}
		}
	}
	if (count($good_homes_tabs) > 0) {
		$good_homes_portfolio_filters_ajax = true;
		$good_homes_portfolio_filters_active = $good_homes_cat;
		$good_homes_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters good_homes_tabs good_homes_tabs_ajax">
			<ul class="portfolio_titles good_homes_tabs_titles">
				<?php
				foreach ($good_homes_tabs as $good_homes_id=>$good_homes_title) {
					?><li><a href="<?php echo esc_url(good_homes_get_hash_link(sprintf('#%s_%s_content', $good_homes_portfolio_filters_id, $good_homes_id))); ?>" data-tab="<?php echo esc_attr($good_homes_id); ?>"><?php echo esc_html($good_homes_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$good_homes_ppp = good_homes_get_theme_option('posts_per_page');
			if (good_homes_is_inherit($good_homes_ppp)) $good_homes_ppp = '';
			foreach ($good_homes_tabs as $good_homes_id=>$good_homes_title) {
				$good_homes_portfolio_need_content = $good_homes_id==$good_homes_portfolio_filters_active || !$good_homes_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $good_homes_portfolio_filters_id, $good_homes_id)); ?>"
					class="portfolio_content good_homes_tabs_content"
					data-blog-template="<?php echo esc_attr(good_homes_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(good_homes_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($good_homes_ppp); ?>"
					data-post-type="<?php echo esc_attr($good_homes_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($good_homes_taxonomy); ?>"
					data-cat="<?php echo esc_attr($good_homes_id); ?>"
					data-parent-cat="<?php echo esc_attr($good_homes_cat); ?>"
					data-need-content="<?php echo (false===$good_homes_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($good_homes_portfolio_need_content) 
						good_homes_show_portfolio_posts(array(
							'cat' => $good_homes_id,
							'parent_cat' => $good_homes_cat,
							'taxonomy' => $good_homes_taxonomy,
							'post_type' => $good_homes_post_type,
							'page' => 1,
							'sticky' => $good_homes_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		good_homes_show_portfolio_posts(array(
			'cat' => $good_homes_cat,
			'parent_cat' => $good_homes_cat,
			'taxonomy' => $good_homes_taxonomy,
			'post_type' => $good_homes_post_type,
			'page' => 1,
			'sticky' => $good_homes_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>