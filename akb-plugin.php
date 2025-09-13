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
	exit; // Exit if accessed directly
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

// Include scripts and styles
require_once AKB_PLUGIN_DIR_PATH . 'inc/scripts.php';

// Hooks: Actions & Filters
require_once AKB_PLUGIN_DIR_PATH . 'inc/hooks.php';

// Include CPT, Taxonomy, and Metaboxes
require_once AKB_PLUGIN_DIR_PATH . 'inc/cpt.php';
require_once AKB_PLUGIN_DIR_PATH . 'inc/taxonomy.php';
require_once AKB_PLUGIN_DIR_PATH . 'inc/metaboxes.php';

// Include Shortcodes
$shortcode_options = get_option('akb_enable_shortcodes');
if ( $shortcode_options === 'yes' ) {
    require_once AKB_PLUGIN_DIR_PATH . 'inc/shortcodes.php';
}
// Admin Menus and Pages
// require_once AKB_PLUGIN_DIR_PATH . 'inc/admin-menu.php';
// require_once AKB_PLUGIN_DIR_PATH . 'inc/admin-page.php';
// require_once AKB_PLUGIN_DIR_PATH . 'inc/admin-settings.php';

require_once AKB_PLUGIN_DIR_PATH . 'inc/prebuilt-admin-menu.php';
require_once AKB_PLUGIN_DIR_PATH . 'inc/prebuilt-admin-page.php';
require_once AKB_PLUGIN_DIR_PATH . 'inc/prebuilt-settings.php';

