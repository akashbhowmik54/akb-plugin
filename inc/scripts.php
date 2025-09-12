<?php
function akb_plugin_admin_scripts() {
    wp_enqueue_style( 'akb-plugin-admin-css', AKB_PLUGIN_DIR_URL .'admin/css/admin.css', '', AKB_PLUGIN_VERSION );
    wp_enqueue_script( 'akb-plugin-admin-js', AKB_PLUGIN_DIR_URL .'admin/js/admin.js', '', AKB_PLUGIN_VERSION , true );
}
add_action('admin_enqueue_scripts', 'akb_plugin_admin_scripts');

function AKB_plugin_public_scripts() {
    wp_enqueue_style( 'akb-plugin-public-css', AKB_PLUGIN_DIR_URL .'public/css/public.css', '', AKB_PLUGIN_VERSION );
    wp_enqueue_script( 'akb-plugin-public-js', AKB_PLUGIN_DIR_URL .'public/js/public.js', '', AKB_PLUGIN_VERSION , true );
}
add_action('wp_enqueue_scripts', 'akb_plugin_public_scripts');