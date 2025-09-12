<?php

// Register Custom Taxonomy
function register_project_industry_taxonomy() {
    $labels = array(
        'name'                       => _x('Industries', 'Taxonomy General Name', 'akb-plugin'),
        'singular_name'              => _x('Industry', 'Taxonomy Singular Name', 'akb-plugin'),
        'menu_name'                  => __('Industries', 'akb-plugin'),
        'all_items'                  => __('All Industries', 'akb-plugin'),
        'parent_item'                => __('Parent Industry', 'akb-plugin'),
        'parent_item_colon'          => __('Parent Industry:', 'akb-plugin'),
        'new_item_name'              => __('New Industry Name', 'akb-plugin'),
        'add_new_item'               => __('Add New Industry', 'akb-plugin'),
        'edit_item'                  => __('Edit Industry', 'akb-plugin'),
        'update_item'                => __('Update Industry', 'akb-plugin'),
        'view_item'                  => __('View Industry', 'akb-plugin'),
        'search_items'               => __('Search Industries', 'akb-plugin'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'publicly_queryable'         => true,
        'show_ui'                    => true,
        'show_in_menu'               => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
        'rest_base'                  => 'project_industry',
        'show_tagcloud'              => true,
        'show_in_quick_edit'         => true,
        'show_admin_column'          => true,
    );

    register_taxonomy('project_industry', ["projects"], $args);
}
add_action('init', 'register_project_industry_taxonomy', 0);


// Register Custom Taxonomy
function register_project_technology_taxonomy() {
    $labels = array(
        'name'                       => _x('Technologies', 'Taxonomy General Name', 'akb-plugin'),
        'singular_name'              => _x('Technology', 'Taxonomy Singular Name', 'akb-plugin'),
        'menu_name'                  => __('Technologies', 'akb-plugin'),
        'all_items'                  => __('All Technologies', 'akb-plugin'),
        'parent_item'                => __('Parent Technology', 'akb-plugin'),
        'parent_item_colon'          => __('Parent Technology:', 'akb-plugin'),
        'new_item_name'              => __('New Technology Name', 'akb-plugin'),
        'add_new_item'               => __('Add New Technology', 'akb-plugin'),
        'edit_item'                  => __('Edit Technology', 'akb-plugin'),
        'update_item'                => __('Update Technology', 'akb-plugin'),
        'view_item'                  => __('View Technology', 'akb-plugin'),
        'search_items'               => __('Search Technologies', 'akb-plugin'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'publicly_queryable'         => true,
        'show_ui'                    => true,
        'show_in_menu'               => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
        'rest_base'                  => 'project_technology',
        'show_tagcloud'              => true,
        'show_in_quick_edit'         => true,
        'show_admin_column'          => true,
    );

    register_taxonomy('project_technology', ["projects"], $args);
}
add_action('init', 'register_project_technology_taxonomy', 0);