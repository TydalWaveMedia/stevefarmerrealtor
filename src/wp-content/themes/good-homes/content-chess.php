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
$good_homes_columns = empty($good_homes_blog_style[1]) ? 1 : max(1, $good_homes_blog_style[1]);
$good_homes_expanded = !good_homes_sidebar_present() && good_homes_is_on(good_homes_get_theme_option('expand_content'));
$good_homes_post_format = get_post_format();
$good_homes_post_format = empty($good_homes_post_format) ? 'standard' : str_replace('post-format-', '', $good_homes_post_format);
$good_homes_animation = good_homes_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($good_homes_columns).' post_format_'.esc_attr($good_homes_post_format) ); ?>
	<?php echo (!good_homes_is_off($good_homes_animation) ? ' data-animation="'.esc_attr(good_homes_get_animation_classes($good_homes_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($good_homes_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	good_homes_show_post_featured( array(
											'class' => $good_homes_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => good_homes_get_thumb_size(
																	strpos(good_homes_get_theme_option('body_style'), 'full')!==false
																		? ( $good_homes_columns > 1 ? 'huge' : 'original' )
																		: (	$good_homes_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('good_homes_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('good_homes_action_before_post_meta'); 

			// Post meta
			$good_homes_components = good_homes_is_inherit(good_homes_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date'.($good_homes_columns < 3 ? ',counters' : '').($good_homes_columns == 1 ? ',edit' : '')
										: good_homes_array_get_keys_by_value(good_homes_get_theme_option('meta_parts'));
			$good_homes_counters = good_homes_is_inherit(good_homes_get_theme_option_from_meta('counters')) 
										? 'views,likes,comments'
										: good_homes_array_get_keys_by_value(good_homes_get_theme_option('counters'));
			$good_homes_post_meta = empty($good_homes_components) 
										? '' 
										: good_homes_show_post_meta(apply_filters('good_homes_filter_post_meta_args', array(
												'components' => $good_homes_components,
												'counters' => $good_homes_counters,
												'seo' => false,
												'echo' => false
												), $good_homes_blog_style[0], $good_homes_columns)
											);
			good_homes_show_layout($good_homes_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$good_homes_show_learn_more = !in_array($good_homes_post_format, array('link', 'aside', 'status', 'quote'));
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
				good_homes_show_layout($good_homes_post_meta);
			}
			// More button
			if ( $good_homes_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'good-homes'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>