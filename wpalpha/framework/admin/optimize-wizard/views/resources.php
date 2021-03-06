<?php
/**
 * Resource template
 *
 * @author     FunnyWP
 * @package    WP Alpha Framework
 * @subpackage Theme
 * @since      1.0
 *
 */
defined( 'ABSPATH' ) || die;
?>
<h2><?php esc_html_e( 'Optimize Resources', 'alpha' ); ?></h2>

<form method="post" class="alpha-used-elements-form">
	<p><?php esc_html_e( 'This will help you to optimize theme styles.', 'alpha' ); ?></p>
	<p class="descripion">
		<?php echo ALPHA_DISPLAY_NAME . esc_html( ' comes with powerful optimization wizard for theme styles. Detailed options for used components and helper classes will optimize your site perfectly.', 'alpha' ); ?>
		<br>
		<?php esc_html_e( 'All options you have been checked will be saved for next use. After you have finished development, please run this wizard.', 'alpha' ); ?>
	</p>

	<?php if ( alpha_get_feature( 'fs_pb_wpb' ) && defined( 'WPB_VC_VERSION' ) ) { ?>
		<p style="margin-bottom: 30px;"><?php esc_html_e( 'Please check used resources.', 'alpha' ); ?></p>
		<div class="alpha-used-resources">
			<div class="alpha-loading"><i></i></div>
		</div>
	<?php } ?>

	<label class="checkbox checkbox-inline" style="margin-bottom: 15px;">
		<input type="checkbox" name="resource_disable_gutenberg" <?php checked( alpha_get_option( 'resource_disable_gutenberg' ) ); ?>>
		<strong><?php esc_html_e( 'Gutenberg', 'alpha' ); ?></strong> - <span><?php esc_html_e( 'If any gutenberg block doesn\'t be used in site, check me.', 'alpha' ); ?></span>
	</label>

	<label class="checkbox checkbox-inline" style="margin-bottom: 15px;">
		<input type="checkbox" name="resource_disable_wc_blocks" <?php checked( alpha_get_option( 'resource_disable_wc_blocks' ) ); ?>>
		<strong><?php esc_html_e( 'WooCommerce blocks for Gutenberg', 'alpha' ); ?></strong> - <span><?php esc_html_e( 'If any WooCommerce blocks for Gutenberg doesn\'t be used in sites, check me.', 'alpha' ); ?></span>
	</label>

	<?php if ( alpha_get_feature( 'fs_pb_elementor' ) && defined( 'ELEMENTOR_VERSION' ) ) { ?>
		<label class="checkbox checkbox-inline" style="margin-bottom: 15px;">
			<input type="checkbox" name="resource_disable_elementor" <?php checked( alpha_get_option( 'resource_disable_elementor' ) ); ?>>
			<strong><?php esc_html_e( 'Elementor Resources', 'alpha' ); ?></strong> - <span><?php esc_html_e( 'Check this to speed up your elementor site remarkably, if your site has no compatibility issue.', 'alpha' ); ?></span>
		</label>
	<?php } ?>
	<!-- // @start feature: fs_plugin_dokan -->
	<?php if ( alpha_get_feature( 'fs_plugin_dokan' ) && class_exists( 'WeDevs_Dokan' ) ) { ?>
		<label class="checkbox checkbox-inline" style="margin-bottom: 15px;">
			<input type="checkbox" name="resource_disable_dokan" <?php checked( alpha_get_option( 'resource_disable_dokan' ) ); ?>>
			<strong><?php esc_html_e( 'Dokan Resources', 'alpha' ); ?></strong> - <span><?php esc_html_e( 'Check this to speed up your dokan site for not logged in users, if your site has no compatibility issue.', 'alpha' ); ?></span>
		</label>
	<?php } ?>
	<!-- // @end feature: fs_plugin_dokan -->
	<?php
		/**
		 * Fires after resources main content.
		 *
		 * @since 1.0
		 */
		do_action( 'alpha_after_resource_main_content' );
	?>
	<p class="alpha-admin-panel-actions">
		<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-large button-light"><?php esc_html_e( 'Skip this step', 'alpha' ); ?></a>
		<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button-dark button button-large button-next" data-callback="optimize_resources"><?php esc_html_e( 'Compile & Continue', 'alpha' ); ?></a>
		<?php wp_nonce_field( 'alpha-setup-wizard' ); ?>
	</p>
</form>
