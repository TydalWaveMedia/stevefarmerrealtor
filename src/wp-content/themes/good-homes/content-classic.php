<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

$good_homes_blog_style = explode('_', good_homes_get_theme_option('blog_style'));
$good_homes_columns = empty($good_homes_blog_style[1]) ? 2 : max(2, $good_homes_blog_style[1]);
$good_homes_expanded = !good_homes_sidebar_present() && good_homes_is_on(good_homes_get_theme_option('expand_content'));
$good_homes_post_format = get_post_format();
$good_homes_post_format = empty($good_homes_post_format) ? 'standard' : str_replace('post-format-', '', $good_homes_post_format);
$good_homes_animation = good_homes_get_theme_option('blog_animation');
$good_homes_components = good_homes_is_inherit(good_homes_get_theme_option_from_meta('meta_parts')) 
							? 'categories,date,counters'.($good_homes_columns < 3 ? ',edit' : '')
							: good_homes_array_get_keys_by_value(good_homes_get_theme_option('meta_parts'));
$good_homes_counters = good_homes_is_inherit(good_homes_get_theme_option_from_meta('counters')) 
							? 'views,likes,comments'
							: good_homes_array_get_keys_by_value(good_homes_get_theme_option('counters'));

?><div class="<?php echo $good_homes_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($good_homes_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($good_homes_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($good_homes_columns)
					. ' post_layout_'.esc_attr($good_homes_blog_style[0]) 
					. ' post_layout_'.esc_attr($good_homes_blog_style[0]).'_'.esc_attr($good_homes_columns)
					); ?>
	<?php echo (!good_homes_is_off($good_homes_animation) ? ' data-animation="'.esc_attr(good_homes_get_animation_classes($good_homes_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	good_homes_show_post_featured( array( 'thumb_size' => good_homes_get_thumb_size($good_homes_blog_style[0] == 'classic'
													? (strpos(good_homes_get_theme_option('body_style'), 'full')!==false 
															? ( $good_homes_columns > 2 ? 'big' : 'huge' )
															: (	$good_homes_columns > 2
																? ($good_homes_expanded ? 'med' : 'small')
																: ($good_homes_expanded ? 'big' : 'med')
																)
														)
													: (strpos(good_homes_get_theme_option('body_style'), 'full')!==false 
															? ( $good_homes_columns > 2 ? 'masonry-big' : 'full' )
															: (	$good_homes_columns <= 2 && $good_homes_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($good_homes_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('good_homes_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('good_homes_action_before_post_meta'); 

			// Post meta
			if (!empty($good_homes_components))
				good_homes_show_post_meta(apply_filters('good_homes_filter_post_meta_args', array(
					'components' => $good_homes_components,
					'counters' => $good_homes_counters,
					'seo' => false
					), $good_homes_blog_style[0], $good_homes_columns)
				);

			do_action('good_homes_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$good_homes_show_learn_more = false; //!in_array($good_homes_post_format, array('link', 'aside', 'status', 'quote'));
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
			?>
		</div>
		<?php
		// Post meta
		if (in_array($good_homes_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($good_homes_components))
				good_homes_show_post_meta(apply_filters('good_homes_filter_post_meta_args', array(
					'components' => $good_homes_components,
					'counters' => $good_homes_counters
					), $good_homes_blog_style[0], $good_homes_columns)
				);
		}
		// More button
		if ( $good_homes_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'good-homes'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>