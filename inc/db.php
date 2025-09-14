<?php
function akb_database_table() {
    global $wpdb;
	$db_version = AKB_PLUGIN_DB_VERSION;

	$table_reactions = $wpdb->prefix . 'post_reactions';
    $table_votes = $wpdb->prefix . 'post_votes';
	
	$charset_collate = $wpdb->get_charset_collate();

	// Post Reactions Table
    
    $sql_reactions = "CREATE TABLE IF NOT EXISTS $table_reactions (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        post_id bigint(20) NOT NULL,
        user_id bigint(20) NOT NULL,
        reaction_type varchar(50) NOT NULL,
        reacted_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        KEY post_id (post_id),
        KEY user_id (user_id),
        KEY reacted_at (reacted_at)
    ) $charset_collate;";

    // Post Voting Table
    
    $sql_votes = "CREATE TABLE IF NOT EXISTS $table_votes (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        post_id bigint(20) NOT NULL,
        user_id bigint(20) NOT NULL,
        vote_type varchar(50) NOT NULL,
        voted_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        KEY post_id (post_id),
        KEY user_id (user_id),
        KEY voted_at (voted_at)
    ) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql_reactions );
    dbDelta( $sql_votes );

	add_option( 'akb_db_version', $db_version );
}