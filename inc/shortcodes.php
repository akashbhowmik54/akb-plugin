<?php

// Basic Shortcode
function akb_test_shortcode() {
    return 'This is a TEST shortcode';
}
add_shortcode('AKB_TEST', 'akb_test_shortcode');
//Usage
//[AKB_TEST]

// Enclosing Shortcode
function akb_enclosing_shortcode($atts = array(), $conetnt) {
    $html = '<a href="https://wp-plugin.test/projects/e-commerce-website-development/">';
    $html .= $conetnt;
    $html .= '</a>';
    return $html;
}
add_shortcode('AKB_TEST_ENCLOSING', 'akb_enclosing_shortcode');
// Usage
// [AKB_TEST_ENCLOSING] Hello Public [/AKB_TEST_ENCLOSING]


// Shortcodes with Parameters
function akb_parameters_shortcode($atts = array()) {

    $attrs = shortcode_atts(
		array(
			'label' => 'Button Label',
            'link'  => 'https://wp-plugin.test/projects/e-commerce-website-development/'
		), $atts
	);

    $html = '<a href="'.$attrs['link'].'">';
    $html .= $attrs['label'];
    $html .= '</a>';
    return $html;
}
add_shortcode('AKB_TEST_PARAM', 'akb_parameters_shortcode');
// Usage
// [AKB_TEST_PARAM label="My Button" link="https://wp-plugin.test/"]


// Shortcodes with Parameters from MagicWP
function akb_test_params_magicwp_shortcode($atts) {
    if(!empty($atts)) {
        // Extract and merge attributes with defaults
        $atts = shortcode_atts(array(
            'label' => 'Button Label',
            'link' => 'https://wp-plugin.test/projects/e-commerce-website-development/'
        ), $atts, 'AKB_TEST_PARAM_MAGICWP');
    } else {
        $atts = NULL;
    }
    

    // Start output buffering
    ob_start();

    // Your shortcode logic here
    ?>
    <div class="akb-button-shortcode">
        <?php if(!empty($atts)) { ?>
        <a href="<?php echo $atts['link'] ?>" style="padding: 10px; background-color: blue; color: white"><?php echo $atts['label'] ?></a>
        <?php } else { ?>
            Please assign link and label 
        <?php } ?>
    </div>
    <?php

    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('AKB_TEST_PARAM_MAGICWP', 'akb_test_params_magicwp_shortcode');
// Usage
// [AKB_TEST_PARAM_MAGICWP label="Extended Button" link="https://wp-plugin.test/"]

/**
 * Project Meta Information
 */
function akb_project_meta_shortcode($atts) {

    $attrs = shortcode_atts(
		array(
			'id' => get_the_ID(),
		), $atts, 'PROJECT_META'
	);

    $project_url = get_post_meta( $attrs['id'], 'project_url', true );
    $project_completion = get_post_meta( $attrs['id'], 'project_completion_duration', true );
    $project_cost = get_post_meta( $attrs['id'], 'project_estimated_cost', true );

    $html = '<div class="project-meta">';
        $html .= '<span><a href="'.$project_url.'" target="_blank">Visit Project</a></span>';
        $html .= '<span>'.$project_completion.'</span>';
        $html .= '<span>'.$project_cost.'</span>';
    $html .= '</div>';

    return $html;


}
add_shortcode( 'PROJECT_META', 'akb_project_meta_shortcode' );