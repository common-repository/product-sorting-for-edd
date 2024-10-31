<?php
/*
Plugin Name: Product Sorting for EDD
Plugin URI: https://catapultthemes.com/
Description: Sort products on Easy Digital Downloads pages
Version: 1.0.1
Author: Catapult Themes
Author URI: https://catapultthemes.com/
Text Domain: sort-products-for-edd
Domain Path: /languages
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sp_edd_load_plugin_textdomain() {
    load_plugin_textdomain( 'sort-products-for-edd', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'sp_edd_load_plugin_textdomain' );

// EDD must be activated for this plugin to work
function sp_edd_is_edd_active() {
    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  ! is_plugin_active( 'easy-digital-downloads/easy-digital-downloads.php' ) ) {
        add_action( 'admin_notices', 'sp_edd_not_active_notice' );
    }
}
add_action( 'admin_init', 'sp_edd_is_edd_active' );

function sp_edd_not_active_notice() { ?>
	<div class="notice notice-warning"><p><?php _e( 'Product Sorting for EDD needs Easy Digital Downloads to work. Please activate Easy Digital Downloads.', 'sp-for-edd' ); ?></p></div>
	<?php
}

/**
 * Define constants
 **/
if ( ! defined( 'SP_EDD_PLUGIN_URL' ) ) {
	define( 'SP_EDD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'SP_EDD_PLUGIN_VERSION' ) ) {
	define( 'SP_EDD_PLUGIN_VERSION', '1.0.1' );
}

if ( is_admin() ) {
//	require_once dirname( __FILE__ ) . '/admin/admin-settings-callbacks.php';
//	require_once dirname( __FILE__ ) . '/admin/admin-settings.php';
//	require_once dirname( __FILE__ ) . '/admin/class-sp-edd-admin.php';
}

/**
 * Functions.
 **/
require_once dirname( __FILE__ ) . '/inc/functions-sp-edd.php';