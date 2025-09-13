<?php

function akb_plugin_menus() {
    add_menu_page(
        "AKB Plugin",
        "AKB",
        'manage_options',
        'akbplugin',
        'akb_options_page',
        'dashicons-superhero',
        20
    );
}
add_action('admin_menu', 'akb_plugin_menus');