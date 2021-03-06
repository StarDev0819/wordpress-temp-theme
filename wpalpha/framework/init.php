<?php
/**
 * Entrypoint of framework.
 *
 * Framework has many addons and admin functions. And also has plugin
 * compatibility. Please look below.
 *
 * 1. Define Constants
 * 2. Load the theme base
 * 3. Analyse the current request
 * 4. Load the plugin functions
 * 5. Load addons
 * 6. Load admin
 *
 * @author     FunnyWP
 * @package    WP Alpha Framework
 * @subpackage Theme
 * @since      1.0
 */
defined( 'ABSPATH' ) || die;


/**************************************/
/* 1. Define Constants                */
/**************************************/
global $pagenow;

define( 'ALPHA_FRAMEWORK_PLUGINS', ALPHA_FRAMEWORK_PATH . '/plugins' );
define( 'ALPHA_FRAMEWORK_PLUGINS_URI', ALPHA_FRAMEWORK_URI . '/plugins' );

/**************************************/
/* 2. Load the theme base             */
/**************************************/

if ( ! class_exists( 'Alpha_Base' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PATH . '/class-alpha-base.php' );
}
require_once alpha_framework_path( ALPHA_FRAMEWORK_PATH . '/class-alpha-support.php' );
require_once alpha_framework_path( ALPHA_FRAMEWORK_PATH . '/class-alpha-assets.php' );
if ( ! defined( 'ALPHA_CORE_VERSION' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PATH . '/common-functions.php' );
}
require_once alpha_framework_path( ALPHA_FRAMEWORK_PATH . '/theme-functions.php' );
require_once alpha_framework_path( ALPHA_FRAMEWORK_PATH . '/theme-actions.php' );


/**************************************/
/* 3. Analyse the current request     */
/**************************************/

$request = array(
	'doing_ajax'        => alpha_doing_ajax(),
	'customize_preview' => is_customize_preview(),
	'can_manage'        => current_user_can( 'manage_options' ),
	'is_admin'          => is_admin(),
	'is_preview'        => function_exists( 'alpha_is_elementor_preview' ) && alpha_is_elementor_preview() ||
							function_exists( 'alpha_is_wpb_preview' ) && alpha_is_wpb_preview(),
	'product_edit_page' => ( 'post-new.php' == $GLOBALS['pagenow'] && isset( $_GET['post_type'] ) && 'product' == $_GET['post_type'] ) ||
							( 'post.php' == $GLOBALS['pagenow'] && isset( $_GET['post'] ) && 'product' == get_post_type( $_GET['post'] ) ) ||
							( 'edit.php' == $GLOBALS['pagenow'] && isset( $_GET['post_type'] ) && 'product' == $_GET['post_type'] ) ||
							( 'term.php' == $GLOBALS['pagenow'] && isset( $_GET['post_type'] ) && 'product' == $_GET['post_type'] ),
);


/**
 * Fires after framework init
 *
 * @since 1.0
 */
do_action( 'alpha_after_framework_init', $request );


/**************************************/
/* 4. Load the plugin functions       */
/**************************************/

// @start feature: fs_plugin_woocommerce
if ( ( 'widgets.php' == $pagenow || 'admin-ajax.php' == $pagenow || 'post.php' == $pagenow || 'index.php' == $pagenow ) && alpha_get_feature( 'fs_plugin_woocommerce' ) && class_exists( 'WooCommerce' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/woocommerce/class-alpha-woocommerce.php' );
}
// @end feature: fs_plugin_woocommerce

// @start feature: fs_pb_elementor
if ( alpha_get_feature( 'fs_pb_elementor' ) && defined( 'ELEMENTOR_VERSION' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/elementor/elementor.php' );
	if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
		require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/elementor/elementor-pro.php' );
	}
}
// @end feature: fs_pb_elementor

// @start feature: fs_pb_wpb
if ( alpha_get_feature( 'fs_pb_wpb' ) && defined( 'WPB_VC_VERSION' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/wpb/wpb.php' );
}
// @end feature: fs_pb_wpb

// @start feature: fs_pb_gutenberg
if ( alpha_get_feature( 'fs_pb_gutenberg' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/gutenberg/gutenberg.php' );
}
// @end feature: fs_pb_gutenberg

// Multi-Vendor Functions
if ( class_exists( 'WeDevs_Dokan' ) || class_exists( 'WCFM' ) || class_exists( 'WCMp' ) || class_exists( 'WC_Vendors' ) ) {
	define( 'ALPHA_FRAMEWORK_VENDORS', ALPHA_FRAMEWORK_PLUGINS );
}

// @start feature: fs_plugin_dokan
if ( alpha_get_feature( 'fs_plugin_dokan' ) && class_exists( 'WeDevs_Dokan' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/dokan/class-alpha-dokan.php' );
}
// @end feature: fs_plugin_dokan

// @start feature: fs_plugin_wcfm
if ( alpha_get_feature( 'fs_plugin_wcfm' ) && class_exists( 'WCFM' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/wcfm/class-alpha-wcfm.php' );
}
// @end feature: fs_plugin_wcfm

// @start feature: fs_plugin_wcmp
if ( alpha_get_feature( 'fs_plugin_wcmp' ) && class_exists( 'WCMp' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/wcmp/class-alpha-wcmp.php' );
}
// @end feature: fs_plugin_wcmp

// @start feature: fs_plugin_wc-vendors
if ( alpha_get_feature( 'fs_plugin_wc-vendors' ) && class_exists( 'WC_Vendors' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/wc-vendors/class-alpha-wc-vendors.php' );
}

if ( alpha_get_feature( 'fs_plugin_wc-vendors' ) && class_exists( 'WC_Vendors' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/wc-vendors/class-alpha-wc-vendors.php' );
}
// @start feature: fs_plugin_wc-vendors
if ( alpha_get_feature( 'fs_plugin_wc-vendors' ) && class_exists( 'WC_Vendors' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/wc-vendors/class-alpha-wc-vendors.php' );
}
// @end feature: fs_plugin_wc-vendors

// @start feature: fs_plugin_woof
if ( alpha_get_feature( 'fs_plugin_woof' ) && class_exists( 'WOOF' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/woof/class-alpha-woof.php' );
}
// @end feature: fs_plugin_woof

// @start feature: fs_plugin_uni_cpo
if ( alpha_get_feature( 'fs_plugin_uni_cpo' ) && class_exists( 'Uni_Cpo' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/unicpo/class-alpha-unicpo.php' );
}
// @end feature: fs_plugin_uni_cpo

// @start feature: fs_plugin_wpforms
if ( alpha_get_feature( 'fs_plugin_wpforms' ) && class_exists( 'WPForms' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/wpforms/class-alpha-wpforms.php' );
}
// @end feature: fs_plugin_wpforms

// @start feature: fs_plugin_yith_featured_video
if ( alpha_get_feature( 'fs_plugin_yith_featured_video' ) && class_exists( 'YITH_WC_Audio_Video' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/yith-featured-video/class-alpha-yith-featured-video.php' );
}
// @end feature: fs_plugin_yith_featured_video

// @start feature: fs_plugin_yith_gift_card
if ( alpha_get_feature( 'fs_plugin_yith_gift_card' ) && class_exists( 'YITH_YWGC_Gift_Card' ) ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PLUGINS . '/yith-gift-card/class-alpha-yith-gift-card.php' );
}
// @end feature: fs_plugin_yith_gift_card

/**
 * Fires after loading framework plugin compatibility.
 *
 * @param array $request Request parameter for filter.
 * @since 1.0
 */
do_action( 'alpha_after_framework_plugins', $request );

/**************************************/
/* 5. Load addons                     */
/**************************************/

/**
 * Fires loading framework addons.
 *
 * @param array $request Request parameter for filter.
 * @since 1.0
 */
do_action( 'alpha_framework_addons', $request );

/**************************************/
/* 6. Load admin                      */
/**************************************/

// Layout Builder
require_once alpha_framework_path( ALPHA_FRAMEWORK_PATH . '/admin/layout-builder/class-alpha-layout-builder.php' );
if ( $request['can_manage'] && $request['is_admin'] ) {
	require_once alpha_framework_path( ALPHA_FRAMEWORK_PATH . '/admin/layout-builder/class-alpha-layout-builder-admin.php' );
}

if ( $request['can_manage'] ) {

	// Define Constants
	define( 'ALPHA_FRAMEWORK_ADMIN', ALPHA_FRAMEWORK_PATH . '/admin' );
	define( 'ALPHA_FRAMEWORK_ADMIN_URI', ALPHA_FRAMEWORK_URI . '/admin' );                         // Template plugins directory uri
	require_once alpha_framework_path( ALPHA_FRAMEWORK_ADMIN . '/admin/class-alpha-admin.php' ); // Load admin

	// Load Admin Functions
	if ( ! $request['customize_preview'] && ( 'admin.php' == $pagenow || 'admin-ajax.php' == $pagenow || $request['is_admin'] ) ) {
		require_once alpha_framework_path( ALPHA_FRAMEWORK_ADMIN . '/plugins/class-alpha-tgm-plugins.php' ); // Load admin plugins
	}
	if ( ! $request['customize_preview'] && $request['is_admin'] ) {
		require_once alpha_framework_path( ALPHA_FRAMEWORK_ADMIN . '/panel/class-alpha-admin-panel.php' );   // Load admin panel
		require_once alpha_framework_path( ALPHA_FRAMEWORK_ADMIN . '/setup-wizard/class-alpha-setup-wizard.php' );          // Load admin setup wizard
		require_once alpha_framework_path( ALPHA_FRAMEWORK_ADMIN . '/optimize-wizard/class-alpha-optimize-wizard.php' );    // Load admin optimize wizard
		require_once alpha_framework_path( ALPHA_FRAMEWORK_ADMIN . '/tools/class-alpha-tools.php' );                        // Load admin tools
	}

	// @start feature: fs_admin_customize
	if ( alpha_get_feature( 'fs_admin_customize' ) && $request['customize_preview'] ) {                                       // Load admin customizer
		require_once alpha_framework_path( ALPHA_FRAMEWORK_ADMIN . '/customizer/class-alpha-customizer.php' );
		require_once alpha_framework_path( ALPHA_FRAMEWORK_ADMIN . '/customizer/customizer-function.php' );
	}
	// @end feature: fs_admin_customize

	/**
	 * Fires after setting up framework admin.
	 *
	 * @param array $request Request parameter for filter.
	 * @since 1.0
	 */
	do_action( 'alpha_after_framework_admin', $request );
}


/**
 * Fires after setting up framework.
 *
 * @param array $request Request parameter for filter.
 * @since 1.0
 */
do_action( 'alpha_after_framework', $request );
