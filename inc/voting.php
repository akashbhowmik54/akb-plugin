<?php
function akb_post_voting_callback() {

    global $wpdb;
    $table_votes = $wpdb->prefix . 'post_votes';

    // CSRF protection
    check_ajax_referer( 'akb_vote_nonce', 'nonce' );

    $post_id = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
    $user_id = get_current_user_id();
    $vote_type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';

    // Check user login status and capability
    if( !is_user_logged_in() || !current_user_can( 'read' )) {
        wp_send_json_error( [
            'message'    => esc_html__( 'You must be logged-in to vote', 'akb-plugin'),
        ] );
    }

    // Check if post exisst
    if( !get_post_status($post_id)) {
        wp_send_json_error( [
            'message'    => esc_html__('Invalid Post ID', 'akb-plugin'),
        ] );
    }

    // Check vote string
    if( ! in_array($vote_type, ['like', 'dislike'], true)) {
        wp_send_json_error( [
            'message'    => esc_html__('Invalid vote type', 'akb-plugin'),
        ] );
    }
    
    if(!empty($post_id) && !empty($user_id)) {

        // check for existing vote
        $existing_vote = $wpdb->get_row( $wpdb->prepare(
            "SELECT id, vote_type FROM {$table_votes} WHERE post_id = %d AND user_id = %d",
            $post_id,
            $user_id
        ) );

        if ( $existing_vote ) {

            if ( $existing_vote->vote_type === $vote_type ) {
                wp_send_json_error( [ 'message' => 'You have already voted' ] );
            } else {
                $updated = $wpdb->update(
                    $table_votes,
                    [ 'vote_type' => $vote_type ],
                    [ 'id' => $existing_vote->id ],
                    [ '%s' ],
                    [ '%d' ]
                );

                if ( false !== $updated ) {
                    wp_send_json_success( [ 'message' => 'Your vote has been updated' ] );
                } else {
                    wp_send_json_error( [ 'message' => 'Database error: ' . $wpdb->last_error ] );
                }
            }
        } else {
            $inserted = $wpdb->insert(
                $table_votes,
                [
                    'post_id'   => $post_id,
                    'user_id'   => $user_id,
                    'vote_type' => $vote_type,
                ],
                [ '%d', '%d', '%s' ]
            );

            if ( false !== $inserted ) {
                wp_send_json_success( [ 'message' => 'Your vote has been recorded' ] );
            } else {
                wp_send_json_error( [ 'message' => 'Database error: ' . $wpdb->last_error ] );
            }
        }

    }
}
add_action('wp_ajax_akb_post_voting', 'akb_post_voting_callback');
add_action('wp_ajax_nopriv_akb_post_voting', 'akb_post_voting_callback');