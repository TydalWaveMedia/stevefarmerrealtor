<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage GOOD_HOMES
 * @since GOOD_HOMES 1.0.1
 */
?>
<div class="update-nag" id="good_homes_admin_notice">
	<h3 class="good_homes_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'good-homes'), wp_get_theme()->name); ?></h3>
	<?php
	if (!good_homes_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'good-homes')); ?></p><?php
	}
	?><p><?php
		if (good_homes_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'good-homes'); ?></a>
			<?php
		}
		if (function_exists('good_homes_exists_trx_addons') && good_homes_exists_trx_addons()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'good-homes'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'good-homes'); ?></a>
        <a href="#" class="button good_homes_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'good-homes'); ?></a>
	</p>
</div>