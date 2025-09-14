<?php
/*
 * Plugin Name:       AKB Plugin
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Akash Kumar Bhowmik
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       akb-plugin
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
if ( ! defined( 'AKB_PLUGIN_VERSION' ) ) {
    define( 'AKB_PLUGIN_VERSION', '1.0.0' );
}
if ( ! defined( 'AKB_PLUGIN_DIR_PATH' ) ) {
    define( 'AKB_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'AKB_PLUGIN_DIR_URL' ) ) {
    define( 'AKB_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'AKB_PLUGIN_DB_VERSION' ) ) {
    define( 'AKB_PLUGIN_DB_VERSION', '1.0.3' );
}

// Main Plugin Class 
require_once AKB_PLUGIN_DIR_PATH . 'inc/plugin.php';

// Database
register_activation_hook( __FILE__, 'akb_database_table' );