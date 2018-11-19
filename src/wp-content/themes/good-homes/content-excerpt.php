<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

$good_homes_post_format = get_post_format();
$good_homes_post_format = empty($good_homes_post_format) ? 'standard' : str_replace('post-format-', '', $good_homes_post_format);
$good_homes_animation = good_homes_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($good_homes_post_format) ); ?>
	<?php echo (!good_homes_is_off($good_homes_animation) ? ' data-animation="'.esc_attr(good_homes_get_animation_classes($good_homes_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	good_homes_show_post_featured(array( 'thumb_size' => good_homes_get_thumb_size( strpos(good_homes_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('good_homes_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			do_action('good_homes_action_before_post_meta'); 

			// Post meta
			$good_homes_components = good_homes_is_inherit(good_homes_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date,counters,edit'
										: good_homes_array_get_keys_by_value(good_homes_get_theme_option('meta_parts'));
			$good_homes_counters = good_homes_is_inherit(good_homes_get_theme_option_from_meta('counters')) 
										? 'views,likes,comments'
										: good_homes_array_get_keys_by_value(good_homes_get_theme_option('counters'));

			if (!empty($good_homes_components))
				good_homes_show_post_meta(apply_filters('good_homes_filter_post_meta_args', array(
					'components' => $good_homes_components,
					'counters' => $good_homes_counters,
					'seo' => false
					), 'excerpt', 1)
				);
			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if (good_homes_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'good-homes' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'good-homes' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$good_homes_show_learn_more = !in_array($good_homes_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($good_homes_post_format, array('link', 'aside', 'status'))) {
					the_content();
				} else if ($good_homes_post_format == 'quote') {
					if (($quote = good_homes_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
						good_homes_show_layout(wpautop($quote));
					else
						the_excerpt();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $good_homes_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'good-homes'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article><span class="blog_separator"></span>