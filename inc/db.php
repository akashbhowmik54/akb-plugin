<?php

function akb_reactions_table () {
    global $wpdb;
	$db_version = AKB_PLUGIN_DB_VERSION;

	$table_name = $wpdb->prefix . 'reactions';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        post_id BIGINT UNSIGNED NOT NULL,
        user_id BIGINT UNSIGNED DEFAULT NULL,
        reaction_type VARCHAR(50) NOT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        
        PRIMARY KEY (id),
        UNIQUE KEY unique_reaction (post_id, user_id, reaction_type),
        KEY idx_post (post_id),
        KEY idx_user (user_id),
        
        CONSTRAINT fk_post FOREIGN KEY (post_id) REFERENCES wp_posts(ID) ON DELETE CASCADE,
        CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES wp_users(ID) ON DELETE SET NULL
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	add_option( 'akb_db_version', $db_version );
}

function akb_db_upgrade() {
    global $wpdb;
    $installed_ver = get_option( "akb_db_version" );
    $current_version = AKB_PLUGIN_DB_VERSION;

    if ( $installed_ver != $current_version ) {

        $table_name = $wpdb->prefix . 'votes';

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            name tinytext NOT NULL,
            text text NOT NULL,
            url varchar(100) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
        );";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        update_option( "akb_db_version", $current_version );
    }
}

function akb_plugin_update_db_check() {
    $installed_ver = get_option( "akb_db_version" );
    $current_version = AKB_PLUGIN_DB_VERSION;
    if ( $installed_ver != $current_version ) {
        akb_db_upgrade();
    }
}
add_action( 'plugins_loaded', 'akb_plugin_update_db_check' );
