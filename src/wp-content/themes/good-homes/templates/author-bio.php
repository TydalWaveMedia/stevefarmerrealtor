<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0
 */
?>

<div class="author_info scheme_default author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$good_homes_mult = good_homes_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 200*$good_homes_mult );
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<h5 class="author_title" itemprop="name"><?php echo wp_kses_data('About ', 'good_homes'); echo('<span class="fn">'.get_the_author().'</span>'); ?></h5>

		<div class="author_bio" itemprop="description">
			<?php echo wp_kses_post(wpautop(get_the_author_meta( 'description' ))); ?>

			<?php do_action('good_homes_action_user_meta'); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
