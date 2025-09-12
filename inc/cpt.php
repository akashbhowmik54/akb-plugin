<?php

// Register Custom Post Type
function register_projects_post_type() {
    $labels = array(
        'name'                  => _x('Projects', 'Post Type General Name', 'akb-plugin'),
        'singular_name'         => _x('Project', 'Post Type Singular Name', 'akb-plugin'),
        'menu_name'            => __('Projects', 'akb-plugin'),
        'all_items'            => __('All Projects', 'akb-plugin'),
        'add_new_item'         => __('Add New Project', 'akb-plugin'),
        'add_new'              => __('Add New', 'akb-plugin'),
        'edit_item'            => __('Edit Project', 'akb-plugin'),
        'update_item'          => __('Update Project', 'akb-plugin'),
        'search_items'         => __('Search Project', 'akb-plugin'),
    );

    $args = array(
        'label'                 => __('Project', 'akb-plugin'),
        'labels'                => $labels,
        'supports'              => ["title","editor","thumbnail","excerpt","author","comments"],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-open-folder',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => false,
    );

    register_post_type('projects', $args);
}
add_action('init', 'register_projects_post_type', 0);