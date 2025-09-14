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
