<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

$good_homes_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$good_homes_post_format = get_post_format();
$good_homes_post_format = empty($good_homes_post_format) ? 'standard' : str_replace('post-format-', '', $good_homes_post_format);
$good_homes_animation = good_homes_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($good_homes_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($good_homes_post_format) ); ?>
	<?php echo (!good_homes_is_off($good_homes_animation) ? ' data-animation="'.esc_attr(good_homes_get_animation_classes($good_homes_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	good_homes_show_post_featured(array(
		'thumb_size' => good_homes_get_thumb_size($good_homes_columns==1 ? 'big' : ($good_homes_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($good_homes_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			good_homes_show_post_meta(apply_filters('good_homes_filter_post_meta_args', array(), 'sticky', $good_homes_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>