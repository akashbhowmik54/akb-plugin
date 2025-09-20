<?php

/**
 * Project Meta Information
 */
function akb_project_meta_shortcode($atts) {

    $attrs = shortcode_atts(
		array(
			'id' => get_the_ID(),
		), $atts, 'PROJECT_META'
	);

    // Sanitize 'id' to make sure it's numeric (safe integer)
    $post_id = intval($attrs['id']);

    // Validate that the provided post ID actually exists.
    if( !get_post_status( $post_id )) {
        return 'Invalid project ID.';
    }
    $project_url = get_post_meta( $post_id, 'project_url', true );
    $project_completion = get_post_meta( $post_id, 'project_completion_duration', true );
    $project_cost = get_post_meta( $post_id, 'project_estimated_cost', true );

    $html = '<div class="project-meta">';
        $html .= '<span><a href="'.esc_url($project_url).'" target="_blank">Visit Project</a></span>';
        $html .= '<span>'.esc_html($project_completion).'</span>';
        $html .= '<span>'.esc_html($project_cost).'</span>';
    $html .= '</div>';

    return $html;

}
add_shortcode( 'PROJECT_META', 'akb_project_meta_shortcode' );

/**
 * Post Voting Buttons
 */
function akb_post_voting_buttons($atts) {
    
    $attrs = shortcode_atts(
		array(
			'like' => 'Like',
			'dislike' => 'Dislike',
		), $atts, 'PROJECT_META'
	);

    $post_id = get_the_ID();
    $user_id = get_current_user_id();

    $html = '<div class="akb-voting-buttons">';
        $html .= sprintf(
            '<button class="akb-like" data-post-id="%s">%s</button>',
            esc_attr( $post_id ),
            esc_html( $attrs['like'] )
        );
        $html .= sprintf(
            '<button class="akb-dislike" data-post-id="%s">%s</button>',
            esc_attr( $post_id ),
            esc_html( $attrs['dislike'] )
        );

    $html .= '</div>';

    return $html;

}
add_shortcode( 'VOTING_BUTTONS', 'akb_post_voting_buttons' );

/**
 * Public API Testing Shortcode
 */
function akb_public_api_shortcode($atts) {

    $user = isset($atts['user']) ? sanitize_text_field($atts['user']) : 'akashbhowmik54';
    $url = 'https://api.github.com/users/'.$user;

    error_log(print_r($user, true)); 

    $response = wp_remote_get( $url, array( 'timeout' => 30 ) );
    $response_code = wp_remote_retrieve_response_code( $response );

    if ($response_code !== 200) {
        return 'Error: Unable to fetch data from GitHub API. Response code: ' . $response_code;

    }

    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body );

    if ( !$data ) {
        return 'Invalid Response';
    }

    $avatar_url = isset($data->avatar_url) ? sanitize_url($data->avatar_url) : '';
    $name = isset($data->avatar_url) ? sanitize_text_field($data->name) : '';
    $username = isset($data->avatar_url) ? sanitize_text_field($data->login) : '';
    $bio = isset($data->avatar_url) ? sanitize_text_field($data->bio) : '';
    $repos = isset($data->avatar_url) ? sanitize_text_field($data->public_repos) : '';
    $followers = isset($data->avatar_url) ? sanitize_text_field($data->followers) : '';
    $following = isset($data->avatar_url) ? sanitize_text_field($data->following) : '';
    ob_start();
    
    ?>
        
        <div class="github-card">
            <div class="card-header">
                <img 
                src="<?php echo esc_url( $avatar_url ); ?>" 
                alt="<?php echo esc_attr__( 'User avatar', 'akb-plugin' ); ?>"
                >
                <h2><?php echo esc_html( $name ); ?></h2>
                <p class="username">@<?php echo esc_html( $username ); ?></p>
            </div>
            <div class="card-body">
                <p class="bio"><?php echo esc_html( $bio ); ?></p>
                <div class="stats">
                <div class="stat">
                    <strong><?php echo esc_html__( 'Repos', 'akb-plugin' ); ?></strong>
                    <span><?php echo esc_html( $repos ); ?></span>
                </div>
                <div class="stat">
                    <strong><?php echo esc_html__( 'Followers', 'akb-plugin' ); ?></strong>
                    <span><?php echo esc_html( $followers ); ?></span>
                </div>
                <div class="stat">
                    <strong><?php echo esc_html__( 'Following', 'akb-plugin' ); ?></strong>
                    <span><?php echo esc_html( $following ); ?></span>
                </div>
                </div>
            </div>
        </div>
    <?php
    return ob_get_clean();

    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
}
add_shortcode( 'AKB_GITHUB_API', 'akb_public_api_shortcode' );

/**
 * API with Authentication
 */
function akb_rapidapi_shortcode() {

    $cache_key = 'akb_random_quote';
    $data = get_transient($cache_key);

    if( false === $data) {
        $url = 'https://quotes-api15.p.rapidapi.com/quotes/random';

        $response = wp_remote_get( 
            $url, [
                'timeout'=>30,
                'httpversion' => '1.1',
                'headers' => [
                    'x-rapidapi-host' => 'quotes-api15.p.rapidapi.com',
                    'x-rapidapi-key' => 'f898883b1emsh2086180ebb3ae20p1d4465jsn7fe7af50ab8c'
                ]
            ]
        );
        $res_code = wp_remote_retrieve_response_code($response);

        if($res_code !== 200) {
            return 'API Error '.$res_code;
        }

        $body = wp_remote_retrieve_body($response);

        $data = json_decode($body);

        if(! $data ) {
            return 'Invalid Response';
        }
        set_transient( $cache_key, $data, 3600 );

    }
    // delete_transient( $cache_key );

    $html = '<aside class="quote-block">';
        $html .= '<blockquote>';
            $html .= esc_html($data->quote);
        $html .= '</blockquote>';
        $html .= '<cite>'.esc_html($data->author).'</cite>';
    $html .= '</aside>';

    return $html;
}
add_shortcode( 'AKB_RAPIDAPI', 'akb_rapidapi_shortcode' );