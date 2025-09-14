<?php

class AKB_Plugin {
    public function __construct() {

        $this->load_dependencies();

        add_action('admin_menu', array( $this, 'akb_plugin_menus' ));
        add_action('init', array( $this, 'register_projects_post_type' ), 0);
        add_action('admin_enqueue_scripts', array( $this, 'akb_plugin_admin_scripts' ));
        add_action('wp_enqueue_scripts', array( $this, 'akb_plugin_public_scripts' ));
    }

    private function load_dependencies() {
        require_once AKB_PLUGIN_DIR_PATH . 'inc/db.php';
        require_once AKB_PLUGIN_DIR_PATH . 'inc/taxonomy.php';
        require_once AKB_PLUGIN_DIR_PATH . 'inc/metaboxes.php';
        require_once AKB_PLUGIN_DIR_PATH . 'inc/admin-page.php';
        require_once AKB_PLUGIN_DIR_PATH . 'inc/admin-settings.php';
        require_once AKB_PLUGIN_DIR_PATH . 'inc/shortcodes.php';
        require_once AKB_PLUGIN_DIR_PATH . 'inc/voting.php';
    }

    /**
     * Enqueue Admin Scripts and Styles
     */
    function akb_plugin_admin_scripts() {
        wp_enqueue_style( 'akb-plugin-admin-css', AKB_PLUGIN_DIR_URL .'assets/css/admin.css', '', AKB_PLUGIN_VERSION );
        wp_enqueue_script( 'akb-plugin-admin-js', AKB_PLUGIN_DIR_URL .'assets/js/admin.js', '', AKB_PLUGIN_VERSION , true );
    }

    /**
     * Enqueue Public Scripts and Styles
     */
    function AKB_plugin_public_scripts() {
        wp_enqueue_style( 'akb-plugin-public-css', AKB_PLUGIN_DIR_URL .'assets/css/public.css', '', AKB_PLUGIN_VERSION );
        wp_enqueue_script( 'akb-plugin-public-js', AKB_PLUGIN_DIR_URL .'assets/js/public.js', '', AKB_PLUGIN_VERSION , true );
        wp_enqueue_script( 'akb-plugin-ajax-js', AKB_PLUGIN_DIR_URL .'assets/js/ajax.js', array('jquery'), AKB_PLUGIN_VERSION , true );
        wp_localize_script( 'akb-plugin-ajax-js', 
        'akb_ajax', 
        array( 
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce('akb_vote_nonce') 
            ) 
        );
    }

    /**
     * Register Plugin Admin Menu
     */
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

    /**
     * Register Post Type
     */
    public function register_projects_post_type() {
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
}
new AKB_Plugin();