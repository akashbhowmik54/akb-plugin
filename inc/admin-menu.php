<?php

function akb_plugin_menus() {
    add_menu_page(
        "AKB Plugin",
        "AKB",
        'manage_options',
        'akbplugin',
        'akb_plugin_page',
        'dashicons-superhero',
        20
    );
    add_submenu_page(
        'akbplugin',
        'AKB Plugin Sub-Page',
        'Sub-Menu',
        'manage_options',
        'akbplugin_sub',
        'akb_plugin_sub_page'
    );
}
add_action('admin_menu', 'akb_plugin_menus');