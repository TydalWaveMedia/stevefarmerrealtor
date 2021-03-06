<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */

$good_homes_link = get_permalink();
$good_homes_post_format = get_post_format();
$good_homes_post_format = empty($good_homes_post_format) ? 'standard' : str_replace('post-format-', '', $good_homes_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($good_homes_post_format) ); ?>><?php
	good_homes_show_post_featured(array(
		'thumb_size' => good_homes_get_thumb_size( (int) good_homes_get_theme_option('related_posts') == 1 ? 'huge' : 'big' ),
		'show_no_image' => false,
		'singular' => false
		)
	);
	?><div class="post_header entry-header"><?php
		if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
			?><span class="post_date"><a href="<?php echo esc_url($good_homes_link); ?>"><?php echo good_homes_get_date(); ?></a></span><?php
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url($good_homes_link); ?>"><?php echo the_title(); ?></a></h6>
	</div>
</div>